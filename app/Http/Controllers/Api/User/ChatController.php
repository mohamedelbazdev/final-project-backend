<?php

namespace App\Http\Controllers\Api\User;

use App\Events\chatRooms;
use App\Events\roomMessages;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    // Use Trait To Design API's.
    use ApiResponseTrait;

    /**
     * Group of model as vars
     */
    protected $chat_room_model;

    /**
     * @var ChatMessage
     */
    protected $chat_msg_model;

    /**
     * @var User
     */
    protected $userModel;

    /**
     * @param ChatRoom $chat_room
     * @param ChatMessage $chat_msg
     * @param User $user
     */
    public function __construct(ChatRoom $chat_room, ChatMessage $chat_msg, User $user)
    {
        $this->chat_msg_model  = $chat_msg;
        $this->chat_room_model = $chat_room;
        $this->userModel = $user;
    }

    /** @noinspection PhpUndefinedMethodInspection */
    public function createRoom(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_1' => 'required|exists:users,id',
            'user_2' => 'required|exists:users,id',
        ]);

        if($validator->fails()){
            return $this->apiResponse('Validation Errors', null, 422, $validator->errors());
        }

        $roomExistOne = $this->chat_room_model::where([['user_1', $request->user_1], ['user_2', $request->user_2]])->first();
        $roomExistTwo = $this->chat_room_model::where([['user_1', $request->user_2], ['user_2', $request->user_1]])->first();

        if(!is_null($roomExistOne)){
            return $this->apiResponse( 'This Room Exist', $roomExistOne);
        }elseif(!is_null($roomExistTwo)){
            return $this->apiResponse( 'This Room Exist', $roomExistTwo);
        }

        $room = $this->chat_room_model->create($request->all());

//      $room_data = $this->chat_room_model::where('id', $room->id)->with('chat')->with('chat_post')->with('user1_data:id,name,email,phone')->with('user2_data:id,name,email,phone')->with('unread_chat')->first();
        $room_data = $this->chat_room_model->where('id', $room->id)->with('chat')->with('user1_data:id,name,email')->with('user2_data:id,name,email')->with('unread_chat')->first();
        event(new chatRooms($room->user_1 , $room->id , $room_data));
        return $this->apiResponse('created', $room);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function myRooms()
    {
        $user_data = Auth::user();
        /** @noinspection PhpUndefinedMethodInspection */
        $data = $this->chat_room_model->where('user_1', $user_data->id)
            ->orwhere('user_2', $user_data->id)
            ->with('user1_data:id,name,email')
            ->with('user2_data:id,name,email')
            ->with('last_msg:body,room_id,created_at')
            ->with('unread_chat')
            ->orderBy('updated_at', 'DESC')
            ->get();

        if($data){
            return $this->apiResponse('Successfully', $data);
        }else{
            return $this->apiResponse('notfound',null, 422, 'not found');
        }
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function userRooms($userId)
    {
        $data = $this->chat_room_model->where('user_1', $userId)
            ->orwhere('user_2', $userId)
            ->with('user1_data:id,name,email,image')
            ->with('user2_data:id,name,email,image')
            ->with('last_msg:body,room_id')
            ->with('unread_chat')
            ->orderBy('updated_at', 'DESC')
            ->get();

        if($data){
            return $this->apiResponse('Successfully', $data);
        }else{
            return $this->apiResponse('notfound',null, 422, 'not found');
        }
    }

    /**
     * @param $room_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function specific_room($room_id)
    {
        $data = $this->chat_msg_model::where('room_id', $room_id)->orderBy('id', 'DESC')->get();
        if($data){
            $this->mark_as_all_read($room_id);
            return $this->apiResponse('Successfully', $data);
        }else{
            return $this->apiResponse('notfound', null, 422, 'not found');
        }
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request)
    {
        $message = $this->chat_msg_model->create($request->all());
        if($message){
            $message_data = $this->chat_msg_model->where('id', $message->id)->first();
            $room = $this->chat_room_model->find($message_data->room_id);
            $room->touch();
            $notificationUserId = $room['user_1'] == $message_data['sender_id'] ? $room['user_2'] : $room['user_1'];
            event(new roomMessages($message_data->body , $message_data->room_id , $message_data->sender_id , $message_data->created_at));

//            $userReceived = $this->userModel->whereId($notificationUserId)->first();
            $userSender = $this->userModel->whereId($message_data['sender_id'])->first();

//            $notification_data = [
//                'id' => $userSender->id,
//                'status' => 1,
//                'title' => 'رسالة جديده من ' . $userSender->name,
//                'date' => date('d-m-Y'),
//                // 'payed_id' => $order->payed,
//                'link' => $userSender->id,
//            ];

            // $notification_user->notify(new messageNotification($notification_data));  // save notification
//            $device_id = $this->deviceModel->whereUserId($userReceived->id)->pluck('device_id')->all();
//            $this->sendTo($device_id,$notification_data['title'], $message_data['body'], $notification_data);

            return $this->apiResponse('Successfully', $message_data);
        }else{
            return $this->apiResponse('unknown error',null, 400,'unknown error');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function mark_as_read($id)
    {
        $read_chat = $this->chat_msg_model->whereId($id)->first();
        if($read_chat){
            $read_chat->readed_at = Carbon::now();
            $read_chat->save();
            return $this->apiResponse('Done');
        }else{
            return $this->apiResponse('unknown error',null,400,'unknown error');
        }
    }

    /**
     * @param $room_id
     */
    private function mark_as_all_read($room_id)
    {
        $readMessages = $this->chat_msg_model->whereRoomId($room_id);
        $readMessages->update([
            'readed_at' => Carbon::now()
        ]);
    }

    /* Delete chat message*/
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete_msg($id){
        //  $delete_chat = $this->chat_msg_model::where('room_id',$id)->delete();
        $delete_chat = $this->chat_room_model->find($id)->delete();
        if($delete_chat){
            return $this->apiResponse('Successfully');
        }else{
            return $this->apiResponse('Successfully', null , 400, 'unknown error');
        }
    }
}

<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Category;
use App\Models\Provider;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use ApiResponseTrait;

    /**
     * @var Order
     */
    protected $orderModel;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->orderModel = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function myOrders(Request $request)
    {
        $orders = $this->orderModel->whereSenderId(Auth::id())->with('user:id,name,image')->with('provider')->get();

        return $this->apiResponse('successfully', $orders);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resivedOrders(Request $request)
    {
        $orders = $this->orderModel->whereReceivedId(Auth::id())->with('user:id,name,image')->with('provider')->get();

        return $this->apiResponse('successfully', $orders);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function showOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = validator::make($request->all(), [
            'order_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponseValidation($validator);
        }

        $orders = $this->orderModel->find($request->post('order_id'))->with('user:id,name')->get();

        return $this->apiResponse('successfully', $orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = validator::make($request->all(), [

            'provider_id' => 'required',
            'received_id' => 'required',
            'description' => 'required',
            'hours' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'executed_at' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponseValidation($validator);
        }

        $provider = Provider::whereUserId($request->provider_id)->with('users:id,name,image')->first();
        $user=User::where('id', auth()->id())->get();
        $price =$provider->price;
        $order = $this->orderModel->create([

            'user_id' => Auth::id(),
            'provider_id' => $request->post('provider_id'),
            'sender_id' => Auth::id(),
            'received_id' => $request->post('received_id'),
            'description' => $request->post('description'),
            'amount' => $price,
            'total_amount'=>$request->post('hours')*$price,
            'hours' => $request->post('hours'),
            'lat' => $request->post('lat'),
            'lng' => $request->post('lat'),
            'executed_at' => $request->post('executed_at'),

        ]);
        $data=[
            'provider'=>$provider,
            'order'=>$order,
            'user' => $user,
        ];

        return $this->apiResponse('successfully', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        //

        $validator = validator::make( $request->all(), [
            'order_id' => 'required|exists:orders,id',
            'status' => 'required',
        ] );
        if ( $validator->fails() ) {
            return $this->apiResponseValidation( $validator );
        }
        $order = Order::find( $request->post( 'order_id' ) );
        $order->update( [
            'status' => $request->post( 'status' ),
        ] );

        return $this->apiResponse( 'successfully', $order );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
   


}

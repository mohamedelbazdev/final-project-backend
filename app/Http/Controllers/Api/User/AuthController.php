<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\FileUploaderTrait;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponseTrait;

    /**
     * @var User
     */
    protected $userModel;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            return $this->apiResponseValidation($validator);
        }

        $user = $this->userModel->whereEmail($request->post('email'))->withCount('order')->withCount('favourite')->first();

        if ($user) {
            if (!Hash::check($request->post('password'), $user->password)) {
                $message = 'Wrong password';
                return $this->apiResponse($message, null,403, 'not authorized');
            }

           if($user->status == 0){
               return $this->apiResponse('please active account', '',403,  'please active account');
           }

            $token = $user->createToken('token')->plainTextToken;

            return $this->apiResponse('successfully', $user, 200 , null, $token);
        }

        return $this->apiResponse('not found user', '',403,  'not found user');
    }

    /**
     * @return JsonResponse
     */
    public function profile(): JsonResponse
    {
        $user = $this->userModel->find(Auth::id());

        return $this->apiResponse('successfully', $user);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storeUser(Request $request): JsonResponse
    {

        $validator = validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
            'name' => 'required|string',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiResponseValidation($validator);
        }

        $user = $this->userModel->create([
            'email' => $request->post('email'),
            'password' => $request->post('password'),
            'name' => $request->post('name'),
            'lat' => $request->post('lat'),
            'lng' => $request->post('lng'),
            'mobile' => $request->post('phone')
        ]);

        return $this->apiResponse('successfully', $user);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateProfile(Request $request): JsonResponse
    {
        $validator = validator::make($request->all(), [
            'name' => 'required|string',
            'lat' => 'required',
            'lng' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiResponseValidation($validator);
        }
        $user = $this->userModel->find(Auth::id());

        $user->update([
            'name' => $request->post('name'),
            'lat' => $request->post('lat'),
            'lng' => $request->post('lng'),
            'email' => $request->post('email'),
        ]);

        return $this->apiResponse('successfully', $user);
    }

}

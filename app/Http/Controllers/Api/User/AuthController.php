<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\FileUploaderTrait;
use App\Models\User;
use App\Rules\CheckSamePassword;
use App\Rules\MatchOldPassword;
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

        $user = $this->userModel->whereEmail($request->post('email'))->first();

        if ($user) {
            if (!Hash::check($request->post('password'), $user->password)) {
                $message = 'Wrong password';
                return $this->apiResponse($message, null,403, 'not authorized');
            }

           if($user->status == 0){
               return $this->apiResponse('please active account', '',403,  'please active account');
           }

           if($user->role_id == 1){
               return $this->apiResponse('please join as user', '',403,  'please join as user');
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
            'password' => Hash::make($request->post('password')),
            'name' => $request->post('name'),
            'lat' => $request->post('lat'),
            'lng' => $request->post('lng'),
            'mobile' => $request->post('phone'),
            'role_id' => 3
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
            'email' => 'required',
            'mobile' => 'required'
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
            'mobile' => $request->post('mobile'),
        ]);

        return $this->apiResponse('successfully', $user);
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function changePassword($request): JsonResponse
    {
        $validator = validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required','min:8', new CheckSamePassword],
            'password_confirmation' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->apiResponse('Validation Errors' ,null, 422, $validator->errors());
        }

        $user = $this->userModel->find(Auth::id());
        if($user){
            $user->update(
                [ 'password' => Hash::make($request->password)]
            );
            return $this->apiResponse('Successfully Updated');
        }else{
            return $this->apiResponse('not found',null,422,'not found');
        }
    }
}

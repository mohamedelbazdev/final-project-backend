<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
    use ApiResponseTrait;

    /**
    * @var Category
    */
    protected $userModel;

    /**
    * @param User $user
    */

    public function __construct( User $user ) {
        $this->userModel = $user;
    }

    /**
    * @return \Illuminate\Http\JsonResponse
    */

    public function providers(): \Illuminate\Http\JsonResponse {
        $providers = $this->userModel ->with( ['providers' => function($querey){
            $querey->with('categories');
        }] ) ->provider()->get();

        return $this->apiResponse( 'successfully', $providers );
    }

    /**
    * @param Request $request
    * @return \Illuminate\Http\JsonResponse
    */

    public function getProviderDetails( Request $request ): \Illuminate\Http\JsonResponse
    {
        $validator = validator::make( $request->all(), [
            'user_id' => 'required|exists:users,id',
        ] );

        if ( $validator->fails() ) {
            return $this->apiResponseValidation( $validator );
        }

        $provider = $this->userModel
        ->with('providers' )->provider()
        ->withCount('rateprovider')
        ->whereId($request->post('user_id'))
        ->first();

        return $this->apiResponse( 'successfully', $provider);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\JsonResponse
    */

    public function store( Request $request ) {
        $validator = validator::make( $request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'map' => 'required|string',
        ] );

        if ( $validator->fails() ) {
            return $this->apiResponseValidation( $validator );
        }

        $coords = explode( ',', $request->post( 'map' ) );

        $lat = $coords[ 0 ];
        $lng = $coords[ 1 ];

        $user = $this->userModel->create( [
            'name' => $request->post( 'name' ),
            'email' => $request->post( 'email' ),
            'password' => Hash::make( $request->post( 'password' ) ),
            'lat' => $lat,
            'lng' => $lng,
            'role_id' => 3
        ] );

        //        if ( $request->hasFile( 'avatar' ) && $request->file( 'avatar' )->isValid() ) {
        //            $category->addMediaFromRequest( 'avatar' )->toMediaCollection( 'avatar' );
        //        }

        return $this->apiResponse( 'successfully', $user );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        //
    }
}

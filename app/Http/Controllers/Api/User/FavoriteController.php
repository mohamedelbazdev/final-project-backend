<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller {
    use ApiResponseTrait;

    /**
    * @var Category
    */
    protected $favoriteModel;

    /**
    * @param Favorite $favorite
    */

    public function __construct( Favorite $favorite ) {
        $this->favoriteModel = $favorite;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\JsonResponse
    */

    public function index() {
        $favorites = $this->favoriteModel->with( 'providers' )->get();

        return $this->apiResponse( 'successfully', $favorites );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\JsonResponse
    */

    public function store( Request $request ) {
        $validator = validator::make( $request->all(), [
            'provider_id' => 'required|exists:users,id',
        ] );

        if ( $validator->fails() ) {
            return $this->apiResponseValidation( $validator );
        }

        $provider = User::find( $request->post( 'provider_id' ) );

        if ( $provider->role_id != 2 ) {
            return $this->apiResponse( 'not allow add it', null, 422 );
        }

        $isExist = $this->favoriteModel->whereProviderIdAndUserId( $request->post( 'provider_id' ), Auth::id() )->count();

        if ( $isExist ) {
            $isExist->delete();
            //  return $this->apiResponse( 'not allow add it because is exits', null, 422 );
        }

        $category = $this->favoriteModel->create( [
            'provider_id' => $request->post( 'provider_id' ),
            'user_id' => Auth::id(),
        ] );

        return $this->apiResponse( 'successfully', $category );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param Request $request
    * @return \Illuminate\Http\JsonResponse
    */

    public function destroy( Request $request ) {
        $validator = validator::make( $request->all(), [
            'provider_id' => 'required|exists:users,id',
        ] );

        if ( $validator->fails() ) {
            return $this->apiResponseValidation( $validator );
        }

        $provider = $this->favoriteModel->whereProviderId( $request->post( 'provider_id' ) )
        ->whereUserId( Auth::id() )->first();

        if ( $provider ) {
            $provider->delete();
            return $this->apiResponse( 'successfully' );
        }

        return $this->apiResponse( 'not found it', null, 422 );
    }
}

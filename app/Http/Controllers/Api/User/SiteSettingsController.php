<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteSettingsController extends Controller {
    //
    use ApiResponseTrait;

    public function index() {
        $setting = DB::table( 'sitesetting' )->first();
        return $this->apiResponse( 'sitesetting fetched successfully', $setting );

    }

    public function UpdateSiteSetting( Request $request ) {
        $id = $request->id;
        $validatedData = $this->validate( $request, [
            'phone ' => 'required|numeric|min:10',
            'mobile ' => 'required|numeric|min:11',
            'email ' => 'required|email',
            'company_name ' =>'required|string',
            'facebook ' => 'required|url',
            'youtube ' => 'required|url',
            'instagram ' => 'required|url',
            'twitter ' => 'required|url',
        ] );

        DB::table( 'sitesetting' )->where( 'id', $id )->update( $validatedData );
        return $this->apiResponse( 'successfully', $validatedData );
    }
}

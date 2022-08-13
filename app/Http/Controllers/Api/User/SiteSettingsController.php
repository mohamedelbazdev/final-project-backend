<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteSettingsController extends Controller {
    //

    public function index() {
        $setting = DB::table( 'sitesetting' )->first();
        return response()->json( 'sitesetting fetched successfully', $setting, );
    }

    public function UpdateSiteSetting( Request $request ) {
        $id = $request->id;

        $data = array();
        $data[ 'phone' ] = $request->phone;
        $data[ 'mobile' ] = $request->mobile;
        $data[ 'email' ] = $request->email;
        $data[ 'company_name' ] = $request->company_name;
        $data[ 'company_address' ] = $request->company_address;
        $data[ 'facebook' ] = $request->facebook;
        $data[ 'youtube' ] = $request->youtube;
        $data[ 'instagram' ] = $request->instagram;
        $data[ 'twitter' ] = $request->twitter;
        DB::table( 'sitesetting' )->where( 'id', $id )->update( $data );
        return $this->apiResponse( 'successfully', $data );
    }
}

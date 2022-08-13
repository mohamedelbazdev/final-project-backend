<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class SettingController extends Controller {
    //

    public function SiteSetting() {
        $setting = DB::table( 'sitesetting' )->first();
        return view( 'settings.website', compact( 'setting' ) );
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
        $notification = array(
            'messege'=>'Site Setting Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with( $notification );
    }
}

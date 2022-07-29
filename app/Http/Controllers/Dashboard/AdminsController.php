<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as Image;
use App\Models\User;

class AdminsController extends Controller
{
    //
    
    public function index() {

        //
        $users = User::Admin()->latest()->get();
        return view( 'admins.index', compact( 'users' ) );
    }


    public function create() {
        //
        return view( 'admins.create' );
      

    }

    public function store( Request $request ) {
        //
        $data[ 'name' ] = $request->name;
        $data[ 'email' ] =  $request->email;
        $data[ 'mobile' ] =  $request->mobile;
        $data[ 'password' ] = Hash::make( $request->password );
        $data[ 'role_id' ] = 1;
        $position = $request->map;
        $mycoords = explode( ',', $position );
        $data[ 'lat' ] = $mycoords[ 0 ];
        $data[ 'lng' ] = $mycoords[ 1 ];

        $image = $request->image;
        if ( $image ) {
            $image_one = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 500, 300 )->save( 'images/Usrimg/' . $image_one );
            $data[ 'image' ] = 'images/Usrimg/' . $image_one;
            // image/postimg/343434.png
            DB::table( 'users' )->insert( $data );

            $notification = array(
                'message' => 'Admin Data Inserted Successfully',
                'alert-type' => 'success'
            );

            return Redirect()->route( 'admins.index' )->with( $notification );
        } else {
            return Redirect()->back();
        }
        // End Condition

    }

    public function show( $id ) {
        //
    }


    public function edit( $id ) {
        //
        $user = DB::table( 'users' )->where( 'id', $id )->first();
        return view( 'admins.edit', compact( 'user' ) );
    }


    public function update( Request $request, $id ) {
        //
        $data[ 'name' ] = $request->name;
        $data[ 'email' ] =  $request->email;
        $data[ 'mobile' ] =  $request->mobile;
        $data[ 'password' ] = Hash::make( $request->password );
        $data[ 'role_id' ] = 1;
        $position = $request->map;
        $mycoords = explode( ',', $position );
        $data[ 'lat' ] = $mycoords[ 0 ];
        $data[ 'lng' ] = $mycoords[ 1 ];
        $oldimage = $request->oldimage;
        $image = $request->image;
        if ( $image ) {
            $image_one = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 500, 300 )->save( 'images/Usrimg/' . $image_one );
            $data[ 'image' ] = 'images/Usrimg/' . $image_one;
            // image/postimg/343434.png
            DB::table( 'users' )->where( 'id', $id )->update( $data );
            unlink( $oldimage );

            $notification = array(
                'message' => 'Admin Data  Updated Successfully',
                'alert-type' => 'success'
            );

            return Redirect()->route( 'admins.index' )->with( $notification );
        } else {
            $data[ 'image' ] = $oldimage;
            DB::table( 'users' )->where( 'id', $id )->update( $data );

            $notification = array(
                'message' => 'Users Data Updated Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route( 'admins.index' )->with( $notification );
        }
        // End Condition

    }


    public function destroy( $id ) {
        //
        $User = DB::table( 'users' )->where( 'id', $id )->first();
        unlink( $User->image );

        DB::table( 'users' )->where( 'id', $id )->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route( 'admins.index' )->with( $notification );
    }
}

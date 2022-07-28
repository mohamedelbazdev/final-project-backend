<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as Image;
use App\Models\User;

class UserController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {

        //
        $users = User::all();
        return view( 'users.index', compact( 'users' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        //
        return view( 'users.addUser' );

    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        //
        $data[ 'name' ] = $request->name;
        $data[ 'email' ] =  $request->email;
        $data[ 'mobile' ] =  $request->mobile;
        $data[ 'password' ] = Hash::make( $request->password );
        $data[ 'role_id' ] = $request->roles;
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
                'message' => 'Users Data Inserted Successfully',
                'alert-type' => 'success'
            );

            return Redirect()->route( 'user.index' )->with( $notification );
        } else {
            return Redirect()->back();
        }
        // End Condition

    }
    // END Method

    // END Method

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
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        //
        $user = DB::table( 'users' )->where( 'id', $id )->first();
        return view( 'users.edit', compact( 'user' ) );
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
        $data[ 'name' ] = $request->name;
        $data[ 'email' ] =  $request->email;
        $data[ 'mobile' ] =  $request->mobile;
        $data[ 'password' ] = Hash::make( $request->password );
        $data[ 'role_id' ] = $request->roles;
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
                'message' => 'Users Data  Updated Successfully',
                'alert-type' => 'success'
            );

            return Redirect()->route( 'user.index' )->with( $notification );
        } else {
            $data[ 'image' ] = $oldimage;
            DB::table( 'users' )->where( 'id', $id )->update( $data );

            $notification = array(
                'message' => 'Users Data Updated Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route( 'user.index' )->with( $notification );
        }
        // End Condition

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        //
        $User = DB::table( 'users' )->where( 'id', $id )->first();
        unlink( $User->image );

        DB::table( 'users' )->where( 'id', $id )->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route( 'user.index' )->with( $notification );
    }

    public function Inactive( $id ) {
        Provider::find( $id )->update( [ 'status' => 0 ] );
        return redirect()->back()->with( 'rmv', 'User has been Inactive' );
    }

    public function Active( $id ) {
        Provider::find( $id )->update( [ 'status' => 1 ] );
        return redirect()->back()->with( 'msg', 'User has been Active' );
    }

}

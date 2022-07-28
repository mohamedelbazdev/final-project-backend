<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;

class AuthController extends Controller {
    //

    public function index() {
        return view( 'admin.index' );
    }

    public function AccountSetting() {
        $id = Auth::user()->id;
        $editData = User::find( $id );
        return view( 'account.profile', compact( 'editData' ) );
    }

    public function ProfileEdit() {
        $id = Auth::user()->id;
        $editData = User::find( $id );
        return view( 'account.profile_edit', compact( 'editData' ) );
    }

    public function ProfileStore( Request $request ) {

        $id = Auth::user()->id;
        $data[ 'name' ] = $request->name;
        $data[ 'email' ] = $request->email;
        $oldimage = $request->oldimage;
        // dd( $oldimage );
        $image = $request->image;

        if ( $request->file( 'image' ) ) {
            $image_one = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 500, 300 )->save( 'images/Usrimg/' . $image_one );
            $data[ 'image' ] = 'images/Usrimg/' . $image_one;

            if ( File::exists( $oldimage ) ) {
                File::delete( $oldimage );
                // unlink( $oldimage );

            }

        }
        DB::table( 'users' )->where( 'id', $id )->update( $data );
        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route( 'account.setting' )->with( $notification );
    }

    public function ShowPassword() {
        return view( 'account.show_password' );
    }

    public function ChangePassword( Request $request ) {

        $validatedData = $request->validate( [
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ] );

        $hashedPassword = Auth::user()->password;
        if ( Hash::check( $request->oldpassword, $hashedPassword ) ) {
            $user = User::find( Auth::id() );
            $user->password = Hash::make( $request->password );
            $user->save();
            Auth::logout();

            $notification = array(
                'message' => 'Password Change Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route( 'auth.login' )->with( $notification );
        } else {
            return Redirect()->back();
        }
        // End Else

    }
    // End Method

    public function showLoginForm() {
        if ( Auth::id() ) {
            return redirect()->back();
        } else {
            return view( 'auth.login' );
        }

    }

    public function customLogin( Request $request ) {
        $request->validate( [
            'email' => 'required',
            'password' => 'required',
        ] );

        $credentials = $request->only( 'email', 'password' );
        if ( Auth::attempt( $credentials ) ) {
            return redirect( 'admin/home' )
            ->withSuccess( 'Signed in' );
        }

        return redirect( 'admin/login' )->withSuccess( 'Login details are not valid' );
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect( 'admin/login' );
    }
}

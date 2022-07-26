<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

        $data = User::find( Auth::user()->id );
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->position = $request->position;

        if ( $request->file( 'image' ) ) {
            $file = $request->file( 'image' );
            @unlink( public_path( 'upload/user_images/' . $data->image ) );
            $filename = date( 'YmdHi' ) . $file->getClientOriginalName();
            $file_path =  public_path( 'upload/user_images' );
            $file->move( $file_path, $filename );
            $data[ 'image' ] = $filename;
        }
        $data->profile_photo_path = $file_path;
        $data->save();
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
            return Redirect()->route( 'login' )->with( $notification );
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

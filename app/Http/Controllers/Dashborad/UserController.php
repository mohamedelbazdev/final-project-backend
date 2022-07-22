<?php

namespace App\Http\Controllers\Dashborad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {
    //

    public function addUser() {
        return view( 'users.addUser' );
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactControler extends Controller {
    //

    public function index() {
        return view( 'Contacts.contactForm' );
    }

    /**
    * Write code on Method
    *
    * @return response()
    */

    public function store( Request $request ) {
        $request->validate( [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:11|numeric',
            'subject' => 'required',
            'message' => 'required'
        ] );

        Contact::create( $request->all() );

        return redirect()->back()
        ->with( [ 'success' => 'Thank you for contact us. we will contact you shortly.' ] );
    }

    public function allContactMessages() {
        $data = Contact::all();
        return view( 'Contacts.index', compact( 'data' ) );

    }
}

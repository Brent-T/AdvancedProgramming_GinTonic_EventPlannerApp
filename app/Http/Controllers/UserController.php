<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile($id) {
    	return view('user.profile', ['id' => $id]);
    }

    /**
	 *  Route for updating user's name
	 */
    public function updateName(Request $request) {
	
	}
}

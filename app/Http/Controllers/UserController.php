<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	public function showLogin() {
    	return view('login.login');
    }

    public function login(Request $request) {
    	$this->validate($request, [
			'email' => 'required',
			'password' => 'required'
		]);


    }

    public function showRegister() {
    	return view('register.register');
    }

    public function register(Request $request) {
    	$this->validate($request, [
			'firstname' => 'required',
			'surname' => 'required',
			'email' => 'required',
			'password' => 'required'
		]);

		
    }

    public function profile($id) {
    	return view('user.profile', ['id' => $id]);
    }

    /**
	 *  Route for updating user's name
	 */
    public function updateName(Request $request) {
	
	}
}

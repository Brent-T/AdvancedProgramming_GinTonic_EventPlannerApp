<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomUser;

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

    	$check = CustomUser::Login(new CustomUser(
			$request->email,
			$request->password
		));

		var_dump($check);
		var_dump(crypt($request->password, $request->email));
		var_dump(crypt($request->password, $request->email));
    }

    private static function createPostFields($event) {
		$json = 
			'email=' 
			. $event->name 
			. '&password=' 
			. $event->description;
		return $json; 
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

    	$check = CustomUser::Register(new CustomUser(
			$request->email,
			$request->password,
			$request->firstname,
			$request->surname
		));

		var_dump($check);
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

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

    	$user = CustomUser::Login(new CustomUser(
			$request->email,
			$request->password
		));

		if($user) {
			$request->session()->put('user', $user);
			return redirect()->action('EventsController@index');
		}
		else{
			return view('login.login');
		}    	
    }

	public function logout(Request $request) {
		$request->session()->forget('user');
		return view('home.index');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomUser;

class UserController extends Controller
{
	/**
	 *  Show login page
	 */
	public function showLogin() {
		return view('login.login');
	}

	/**
	 *  Login a user by credentials 
	 */
	public function login(Request $request) {
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required'
		]);

		// Try to login user if found in database
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

	/**
	 *  Logout current user
	 */
	public function logout(Request $request) {
		$request->session()->forget('user');
		return redirect()->action('HomeController@index');		
	}

	/**
	 *  Show registration page
	 */
	public function showRegister() {
		return view('register.register');
	}

	/**
	 *  Register a user
	 */
	public function register(Request $request) {
		$this->validate($request, [
			'firstname' => 'required',
			'surname' => 'required',
			'email' => 'required',
			'password' => 'required'
		]);

		// Try to register a user if no user with given email
		// already exists
		$user = CustomUser::Register(new CustomUser(
			$request->email,
			$request->password,
			$request->firstname,
			$request->surname
		));

		if($user) {
			$request->session()->put('user', $user);
			return redirect()->action('EventsController@index');
		}
		else{
			return view('register.register');
		}   
	}

	/**
	 *  Show profile page of logged in user
	 */
	public function profile() {
		return view('user.profile');
	}

	/**
	 *  Update user's name
	 */
	public function updateName(Request $request) {
		$this->validate($request, [
			'firstname' => 'required',
			'surname' => 'required',
		]);

		$user = CustomUser::postUpdateName($request->userId, $request->firstname, $request->surname);

		if($user) {
			$request->session()->put('user', $user);
			return redirect()->action('UserController@profile');
		}
		else{
			echo 'derp';
		}
	}

	/**
	 *  Update user's email address
	 */
	public function updateEmail(Request $request) {
		$this->validate($request, [
			'email' => 'required',
		]);

		$user = CustomUser::postUpdateEmail($request->userId, $request->email);

		if($user) {
			$request->session()->put('user', $user);
			return redirect()->action('UserController@profile');
		}
		else{
			echo 'derp';
		}
	}


	/**
	 *  Update user's profile picture
	 */
	public function updateProfilepicture(Request $request) {
		$image = $request->file('profile_picture');
		var_dump($image);

		$image->move('./img/profilepictures/',$request->userId . '.' . $image->getClientOriginalExtension());
	}

	/**
	 *  Update user's password
	 */
	public function updatePassword(Request $request) {
		$this->validate($request, [
			'currentpassword' => 'required',
			'newpassword' => 'required',
			'confirmpassword' => 'required',
		]);

		$result = CustomUser::postUpdatePassword($request->session()->get('user'), $request->currentpassword, $request->newpassword);

		if($result === true) {
			return redirect()->action('UserController@profile');
		} else {
			return redirect()->action('UserController@profile');
		}
	}
}

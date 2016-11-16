<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
    	return view('home.index');
    }

    public function login() {
    	return view('login.login');
    }

    public function signup() {
    	return view('signup.signup');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
	 *  Return tehe home page to the user
	 */
    public function index() {
    	return view('home.index');
    }
}

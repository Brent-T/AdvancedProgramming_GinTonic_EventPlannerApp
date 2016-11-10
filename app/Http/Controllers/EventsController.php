<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index() {
    	$json = file_get_contents('http://gturnquist-quoters.cfapps.io/api/random');
    	$data = json_decode($json, TRUE);
    	return view('events.index', ['data' => $data]);
    }

    public function detail() {
    	return view('events.detail');
    }
}

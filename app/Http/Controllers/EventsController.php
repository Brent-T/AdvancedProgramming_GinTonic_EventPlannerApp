<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;

class EventsController extends Controller
{
    public function index() {
    	$events = Event::TestGetAllEvents();
    	return view('events.index', ['events' => $events]);
    }

    public function detail($id) {
    	return view('events.detail', ['id' => $id]);
    }
}

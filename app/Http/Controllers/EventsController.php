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

    public function addEvent(Request $request) {
		$this->validate($request, [
			'name' => 'required',
			'description' => 'required',
			'location' => 'required',
			'date_start' => 'required',
			'time_start' => 'required',
			'date_end' => 'required',
			'time_end' => 'required'
		]);

		Event::AddEvent(new Event(
			$request->name,
			$request->description,
			$request->location,
			($request->date_start . ' ' . $request->time_start),
			($request->date_end . ' ' . $request->time_end),
			1
		));
		
		return redirect()->action('EventsController@index');
	}
}

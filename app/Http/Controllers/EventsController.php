<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;

class EventsController extends Controller
{
    public function index() {
    	$events = Event::GetAllEvents();
    	return view('events.index', ['events' => $events]);
    }

    public function detail($id) {
    	return view('events.detail', ['id' => $id]);
    }

    public function addEvent(Request $request) {
		$this->validate($request, [
			'name' => 'required',
			'description' => '',
			'location' => '',
			'date_start' => '',
			'time_start' => '',
			'date_end' => '',
			'time_end' => ''
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

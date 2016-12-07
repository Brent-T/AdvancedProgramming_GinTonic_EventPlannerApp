<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;

class EventsController extends Controller
{
	public function __construct()
	{
		$this->middleware('authenticate');
	}

	/**
	 *  Index route returning an overview of 
	 *  all the events found by the webservice
	 */
	public function index(Request $request) {
		if ($request->session()->has('user')) {
			$events = Event::GetAllEventsForUser($request->session()->get('user')->id);
		}
		else {
			$events = Event::GetAllEvents();
		}
		return view('events.index', ['events' => $events]);
	}

	/**
	 *  Detail page of an event by id
	 */
	public function detail($id) {
		$event = Event::GetEventById($id);
		$items = Event::GetEventItems($id);
		// var_dump($items);
		return view('events.detail', ['event' => $event, 'items' => $items, ]);
	}

	/**
	 *  Route for handling post of an event
	 */
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
			$request->session()->get('user')->id
		));

		return redirect()->action('EventsController@index');
	}


	/**
	 *  Route for handling post of adding suggested date to event
	 */
	public function addSuggestedDateToEvent(Request $request) {
		$this->validate($request, [
			'date_start' => 'required',
			'time_start' => 'required',
			'date_end' => 'required',
			'time_end' => 'required'
		]);


		return redirect()->action('EventsController@detail', ['id' => $request->event_id]);
	}


	/**
	 *  Route for handling post of adding suggested location to event
	 */
	public function addSuggestedLocationToEvent(Request $request) {
		$this->validate($request, [
			'location' => 'required'
		]);

		return redirect()->action('EventsController@detail', ['id' => $request->event_id]);
	}

	/**
	 *  Route for handling post of adding people to this event
	 */
	public function addPeopleToEvent(Request $request) {


		var_dump($request->toBeAdded);

		$this->validate($request, [
			'toBeAdded' => 'required'
		]);

		return redirect()->action('EventsController@detail', ['id' => $request->event_id]);
	}

	public function addItemToEvent(Request $request) {
		$this->validate($request, [
			'item' => 'required'
		]);

		$result = Event::AddItemToEvent($request->item, $request->description, $request->event_id);

		return redirect()->action('EventsController@detail', ['id' => $request->event_id]);
	}
}

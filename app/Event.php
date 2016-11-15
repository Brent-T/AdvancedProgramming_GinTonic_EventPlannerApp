<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	// URL TO WEBSERVICE
    private static $url = 'http://localhost:9000'; 

    // Properties of Event
    public $name;
	public $description;			// PROPERTIES SHOULD BE PRIVATE WITH GETTERS
	public $location;
	public $datetime_start;
	public $datetime_end;
	public $id;

	public function __construct($name, $description, $location, $datetime_start, $datetime_end, $id = '1') {
		$this->name = $name;
		$this->description = $description;
		$this->location = $location;
		$this->datetime_start = $datetime_start;
		$this->datetime_end = $datetime_end;
		$this->id = $id;
	}

	// Return all events found by webservice
	public static function GetAllEvents() {
		$events = json_decode(file_get_contents(self::$url . '/events'), TRUE);
		return self::convertToEventList($events);
	}

	// Always returns an arrays of events
	private static function convertToEventList($data) {
		$events = array();
		foreach ($data as $event) {
			array_push($events, new Event(
				$event['name'], 
				$event['description'], 
				$event['location'], 
				$event['startDate'],
				$event['endDate'],
				$event['id']
			));
		}
		return $events;
	}

	public static function AddEvent($event) {

		$json_event = self::createPostFields($event);
		self::pushEventToWebservice($json_event);
	}

	private static function createPostFields($event) {
		$json = 
			'name=' 
			. $event->name 
			. '&description=' 
			. $event->description 
			. '&location=' 
			. $event->location 
			. '&startDate=' 
			. $event->datetime_start 
			. '&endDate=' 
			. $event->datetime_end;
		return $json; 

	}

	// SRC: http://stackoverflow.com/questions/15834164/sending-data-to-a-webservice-using-post
	private static function pushEventToWebservice($json_event) {
		$curl = curl_init(self::$url . '/addevent');
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json_event);

		curl_exec($curl);

		curl_close($curl);
	}
}

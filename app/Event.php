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
		$events = json_decode(file_get_contents(self::$url.'/events'), TRUE);
		return self::convertToEventList($events);
	}

	// Return all events found by webservice
	public static function TestGetAllEvents() {
		// Sample data that should represent data received from webservice
		$test_string = '[
			{
				"id" : 1,
				"name" : "test1",
				"description" : "Lorem ipsum dolor sit amet, dolore habemus inimicus quo no, mea eirmod nusquam repudiare te. Ex solum nullam fastidii quo, sit ea ubique semper persius. Usu diam omnesque indoctum et. Delenit sententiae voluptatum ei usu, no tamquam euripidis suscipiantur sit.",
				"location" : "gegeg",
				"datetime_start" : "tttt",
				"datetime_end" : "hhhrhrhr"
			},
			{
				"id" : 4,
				"name" : "test2",
				"description" : "Lorem ipsum dolor sit amet, dolore habemus inimicus quo no, mea eirmod nusquam repudiare te. Ex solum nullam fastidii quo, sit ea ubique semper persius. Usu diam omnesque indoctum et. Delenit sententiae voluptatum ei usu, no tamquam euripidis suscipiantur sit.",
				"location" : "gegeg",
				"datetime_start" : "tttt",
				"datetime_end" : "hhhrhrhr"
			}
		]';
		$test_data = json_decode($test_string, TRUE);
		return self::convertToEventList($test_data);
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

		$json_event = self::convertEventToJson($event);
		var_dump($json_event);
	}

	private static function convertEventToJson($event) {
		$json = '{ "name" : "' . $event->name . '", "description" : "' . $event->description . '", "location" : "' . $event->location . '", "datetime_start" : "' . $event->datetime_start . '", "datetime_end" : "' . $event->datetime_end . '" }';
		return $json; 

	}
}

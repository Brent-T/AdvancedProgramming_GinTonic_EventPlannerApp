<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	// Spring web service url
    private static $url = 'http://gturnquist-quoters.cfapps.io/api/random'; // ONLY FOR TESTING PURPOSE

    // Properties of Event
    public $name;
	public $description;			// PROPERTIES SHOULD BE PRIVATE WITH GETTERS
	public $location;
	public $datetime_start;
	public $datetime_end;

	public function __construct($name, $description, $location, $date_start, $date_end) {
		$this->name = $name;
		$this->description = $description;
		$this->location = $location;
	}

	// Return all events found by webservice
	public static function GetAllEvents() {
		$events = json_decode(file_get_contents(self::$url), TRUE);
		return self::convertToEventList($events);
	}

	// Return all events found by webservice
	public static function TestGetAllEvents() {
		// Sample data from webservice
		$test_string = '{
			"event1" : {
				"name" : "test1",
				"description" : "Lorem ipsum dolor sit amet, dolore habemus inimicus quo no, mea eirmod nusquam repudiare te. Ex solum nullam fastidii quo, sit ea ubique semper persius. Usu diam omnesque indoctum et. Delenit sententiae voluptatum ei usu, no tamquam euripidis suscipiantur sit.",
				"location" : "gegeg",
				"datetime_start" : "tttt",
				"datetime_end" : "hhhrhrhr"
			},
			"event2" : {
				"name" : "test2",
				"description" : "Lorem ipsum dolor sit amet, dolore habemus inimicus quo no, mea eirmod nusquam repudiare te. Ex solum nullam fastidii quo, sit ea ubique semper persius. Usu diam omnesque indoctum et. Delenit sententiae voluptatum ei usu, no tamquam euripidis suscipiantur sit.",
				"location" : "gegeg",
				"datetime_start" : "tttt",
				"datetime_end" : "hhhrhrhr"
			}
		}';
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
				$event['datetime_start'], 
				$event['datetime_end']
			));
		}
		return $events;
	}	
}

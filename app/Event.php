<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	// URL TO WEBSERVICE
    private static $url = 'http://localhost:9000'; 

    // Properties of Event
    protected $fillable = [
        'name', 'description', 'location', 'datetime_start', 'datetime_end', 'id'
    ];

	public function __construct($name, $description, $location, $datetime_start, $datetime_end, $id = '1') {
		$this->name = $name;
		$this->description = $description;
		$this->location = $location;
		$this->datetime_start = $datetime_start;
		$this->datetime_end = $datetime_end;
		$this->id = $id;
	}

	/**
	 *  Return all events found by webservice
	 */
	public static function GetAllEvents() {
		$events = json_decode(file_get_contents(self::$url . '/events'), TRUE);
		return self::convertToEventList($events);
	}

	/**
	 *  Return all events found by webservice
	 */
	public static function GetEventById($id) {
		$event = json_decode(file_get_contents(self::$url . '/event?id=' .urlencode($id) ), TRUE);
		return self::convertToEventObject($event);
	}


	/**
	 *  Convert json array to Event object
	 */
	private static function convertToEventObject($data) {
		$event = 
		new Event(
				$data['name'], 
				$data['description'], 
				$data['location'], 
				$data['startDate'],
				$data['endDate'],
				$data['id']
			);
		return $event;
	}

	/**
	 *  Convert json array to array of Event array
	 */
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

	/**
	 *  Add event using the web service
	 */
	public static function AddEvent($event) {

		$json_event = self::createPostFields($event);
		self::pushEventToWebservice($json_event);
	}

	/**
	 *  Convert Event object to post field string
	 */
	private static function createPostFields($event) {
		$json = 
			'name=' 
			. $event->name 
			. '&description=' 
			. nl2br($event->description)
			. '&location=' 
			. $event->location 
			. '&startDate=' 
			. $event->datetime_start 
			. '&endDate=' 
			. $event->datetime_end
			. '&userid='
			. 1;
		return $json; 
	}

	/**
	 *  Push event (post field string) to web service
	 * 
	 *  SRC: http://stackoverflow.com/questions/15834164/sending-data-to-a-webservice-using-post
	 */
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

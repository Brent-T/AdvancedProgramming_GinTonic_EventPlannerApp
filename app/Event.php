<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	// URL TO WEBSERVICE
	private static $url = 'http://localhost:9000'; 

	// Properties of Event
	protected $fillable = [
		'id', 'name', 'description', 'location', 'datetime_start', 'datetime_end'
	];

	public function __construct($name = "", $description = "", $location = "", $datetime_start = "", $datetime_end = "", $id = '1') {
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
		$events = json_decode(file_get_contents(self::$url . '/events'));
		return self::convertJsonToEventList($events);
	}

	/**
	 *  Convert json array to array of Event array
	 */
	private static function convertJsonToEventList($json_list) {
		$events = array();
		foreach ($json_list as $json_event) {
			array_push($events, self::convertJsonToEvent($json_event));
		}
		return $events;
	}

	/**
	 *  Convert json to Event object
	 */
	private static function convertJsonToEvent($json) {
		$event = new Event();
		if(isset($json->id)) $event->id = $json->id;
		if(isset($json->name)) $event->name = $json->name;
		if(isset($json->description)) $event->description = $json->description;
		if(isset($json->location)) $event->location = $json->location;
		if(isset($json->startDate)) $event->datetime_start = $json->startDate;
		if(isset($json->endDate)) $event->datetime_end = $json->endDate;
		return $event;
	}

	/**
	 *  Return all events for a user
	 */
	public static function GetAllEventsForUser($user_id) {
		$events = json_decode(file_get_contents(self::$url . '/eventbyuserid?userid=' . urlencode($user_id)));
		return self::convertJsonToEventList($events);
	}

	/**
	 *  Return all events found by webservice
	 */
	public static function GetEventById($id) {
		$event = json_decode(file_get_contents(self::$url . '/event?id=' .urlencode($id)));
		return self::convertJsonToEvent($event);
	}

	/**
	 *  Add event using the web service
	 */
	public static function AddEvent($event) {
		$json_event = self::createPostFieldsAddEvent($event);
		self::pushEventToWebservice($json_event);
	}

	/**
	 *  Convert Event object to post field string
	 */
	private static function createPostFieldsAddEvent($event) {
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
			. $event->id;
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

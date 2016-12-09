<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	// URL TO WEBSERVICE
	private static $url = 'http://localhost:9000'; 

	// Properties of Event
	protected $fillable = [
		'id', 'name', 'description', 'location', 'datetime_start', 'datetime_end', 'owner'
	];

	public function __construct($name = "", $description = "", $location = "", $datetime_start = "", $datetime_end = "", $id = '1', $owner = "") {
		$this->name = $name;
		$this->description = $description;
		$this->location = $location;
		$this->datetime_start = $datetime_start;
		$this->datetime_end = $datetime_end;
		$this->id = $id;
		$this->owner = $owner;
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
	 *  Convert json array to array of Items
	 */
	private static function convertJsonToItemList($json_list) {
		$items = array();
		foreach ($json_list as $json_item) {
			array_push($items, self::convertJsonToItem($json_item));
		}
		return $items;
	}

	/**
	 *  Convert json array to array of Users
	 */
	private static function convertJsonToInviteeList($json_list) {
		$invitees = array();
		foreach ($json_list as $json_item) {
			array_push($invitees, self::convertJsonToInvitee($json_item));
		}
		return $invitees;
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
		if(isset($json->ownerId)) $event->owner = $json->ownerId;
		return $event;
	}

	/**
	 *  Convert json to Item object
	 */
	private static function convertJsonToItem($json) {
		$item = new Item();
		if(isset($json->id)) $item->id = $json->id;
		if(isset($json->name)) $item->name = $json->name;
		if(isset($json->description)) $item->description = $json->description;
		if(isset($json->score)) $item->score = $json->score;
		if(isset($json->eventId)) $item->eventId = $json->eventId;
		return $item;
	}

	/**
	 *  Convert json to User object
	 */
	private static function convertJsonToInvitee($json) {
		$invitee = new Invitee();
		if(isset($json->userId)) $invitee->id = $json->userId;
		if(isset($json->firstName)) $invitee->firstname = $json->firstName;
		if(isset($json->surName)) $invitee->surname = $json->surName;
		if(isset($json->email)) $invitee->email = $json->email;
		return $invitee;
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
	 *  Return all events found by webservice
	 */
	public static function GetEventItems($id) {
		$items = json_decode(file_get_contents(self::$url . '/itemsforevent?eventid=' .urlencode($id)));
		return self::convertJsonToItemList($items);
	}

	/**
	 *  Return all invitees for an event found by webservice
	 */
	public static function GetInvitees($id) {
		$invitees = json_decode(file_get_contents(self::$url . '/usersforevent?eventid=' .urlencode($id)));
		return self::convertJsonToInviteeList($invitees);
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
			. $event->description
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


	/**
	 *  Add Item to event using the web service
	 */
	public static function AddItemToEvent($item, $description, $id) {
		$json = self::createPostFieldsAdditem($item, $description, $id);
		self::pushEventItemToWebservice($json);
	}

	/**
	 *  Convert Event object to post field string
	 */
	private static function createPostFieldsAdditem($item, $description, $id) {
		$json = 
			'name=' 
			. $item
			. '&description=' 
			. $description
			. '&eventid=' 
			. $id;
		return $json; 
	}

	/**
	 *  Push item (post field string) to web service
	 * 
	 *  SRC: http://stackoverflow.com/questions/15834164/sending-data-to-a-webservice-using-post
	 */
	private static function pushEventItemToWebservice($json) {
		$curl = curl_init(self::$url . '/additem');
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
		curl_exec($curl);
		curl_close($curl);
	}

	/**
	 *  Add event using the web service
	 */
	public static function AddPeopleToEvent($people, $eventid) {
		$succes = false;
		foreach ($people as $person) {
			$json = self::createPostFieldsAddPerson($person, $eventid);
			$success = self::pushInviteesToWebservice($json);
		}
		return $success;

	}

	/**
	 *  Convert userid to post field string
	 */
	private static function createPostFieldsAddPerson($userid, $eventid) {
		$json = 
			'eventid=' 
			. $eventid
			. '&userid=' 
			. $userid;
		return $json; 
	}

	/**
	 *  Push item (post field string) to web service
	 * 
	 *  SRC: http://stackoverflow.com/questions/15834164/sending-data-to-a-webservice-using-post
	 */
	private static function pushInviteesToWebservice($json) {
		$curl = curl_init(self::$url . '/linkusertoevent');
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
		$response = curl_exec($curl);
		curl_close($curl);

		return $response;
	}


	/**
	 *  Add event using the web service
	 */
	public static function DeleteEvent($eventid) {
		$json = self::createPostFieldsDeleteEvent($eventid);
		$result = self::pushDeleteEventToWebservice($json);
		return $result;
	}

	/**
	 *  Convert userid to post field string
	 */
	private static function createPostFieldsDeleteEvent($eventid) {
		$json = 
			'id=' 
			. $eventid;
		return $json; 
	}

	/**
	 *  Push delete event trigger (post field string) to web service
	 * 
	 *  SRC: http://stackoverflow.com/questions/15834164/sending-data-to-a-webservice-using-post
	 */
	private static function pushDeleteEventToWebservice($json) {
		$curl = curl_init(self::$url . '/deleteevent');
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
		$response = curl_exec($curl);
		curl_close($curl);

		return $response;
	}

	/**
	 *  Unsubscribe from event using the web service
	 */
	public static function UnsubscriveFromEvent($eventid, $userid) {
		$json = self::createPostFieldsUnsubscribeEvent($eventid, $userid);
		$result = self::pushUnsubscribeEventToWebservice($json);
		return $result;
	}

	/**
	 *  Convert eventid and userid to post field string
	 */
	private static function createPostFieldsUnsubscribeEvent($eventid, $userid) {
		$json = 
			'eventid=' 
			. $eventid
			.'&userid=' 
			. $userid;
		return $json; 
	}

	/**
	 *  Push unsubscribe from event trigger (post field string) to web service
	 * 
	 *  SRC: http://stackoverflow.com/questions/15834164/sending-data-to-a-webservice-using-post
	 */
	private static function pushUnsubscribeEventToWebservice($json) {
		$curl = curl_init(self::$url . '/unlinkuserfromevent');
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
		$response = curl_exec($curl);
		curl_close($curl);

		return $response;
	}
}

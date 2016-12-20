<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	// URL TO WEBSERVICE
	private static $url = 'http://localhost:9000'; 

	// Properties of Event
	protected $fillable = [
		'id', 'name', 'description', 'score', 'eventId'
	];

	public function __construct($name = "", $description = "", $score = "", $eventId = "", $id = "") {
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->score = $score;
		$this->eventId = $eventId;
	}

	/**
	 *  Vote for item of event
	 */
	public static function Vote($itemid, $vote) {
		$json = self::createPostFieldsVote($itemid, $vote);
		$result = self::pushVoteToWebservice($json);
		return $result;
	}

	/**
	 *  Create json string for item vote
	 */
	private static function createPostFieldsVote($itemid, $vote) {
		$json = 
			'itemid=' 
			. $itemid
			.'&vote='
			.$vote;
		return $json; 
	}

	/**
	 *  Push vote to webservice
	 */
	private static function pushVoteToWebservice($json) {
		$curl = curl_init(self::$url . '/voteitem');
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
		$response = curl_exec($curl);
		curl_close($curl);

		return $response;
	}

	/**
	 *  Delete item from event
	 */
	public static function DeleteItem($itemid) {
		$json = self::createPostFieldsDelete($itemid);
		$result = self::pushDeleteToWebservice($json);
		return $result;
	}

	/**
	 *  Create json string for item deletion
	 */
	private static function createPostFieldsDelete($itemid) {
		$json = 
			'itemid=' 
			. $itemid;
		return $json; 
	}

	/**
	 *  Push item delete to service
	 */
	private static function pushDeleteToWebservice($json) {
		$curl = curl_init(self::$url . '/deleteitem');
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
		$response = curl_exec($curl);
		curl_close($curl);

		return $response;
	}
}
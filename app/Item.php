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
	 *  Add event using the web service
	 */
	public static function Vote($itemid, $vote) {
		$json = self::createPostFieldsVote($itemid, $vote);
		$result = self::pushVoteToWebservice($json);
		return $result;
	}

	/**
	 *  Convert userid to post field string
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
	 *  Push delete event trigger (post field string) to web service
	 * 
	 *  SRC: http://stackoverflow.com/questions/15834164/sending-data-to-a-webservice-using-post
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
}
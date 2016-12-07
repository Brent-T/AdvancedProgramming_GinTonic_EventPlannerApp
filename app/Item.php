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
}
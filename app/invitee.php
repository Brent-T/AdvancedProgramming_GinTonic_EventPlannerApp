<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitee extends Model
{
	// URL TO WEBSERVICE
	private static $url = 'http://localhost:9000'; 

	// Properties of Event
	protected $fillable = [
		'id', 'firstname', 'surname', 'email'
	];

	public function __construct($id = "", $firstname = "", $surname = "", $email = "") {
		$this->id = $id;
		$this->firstname = $firstname;
		$this->surname = $surname;
		$this->email = $email;
	}
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Hash;

class CustomUser extends Model
{
	// URL TO WEBSERVICE
	private static $url = 'http://localhost:9000';

	private static $DEFAULT_HASH_ALGO = "SHA256";

	// Properties of CustomUser
	protected $fillable = [
		'firstname', 'surname', 'email', 'password'
	];

	// Hidden properties
	protected $hidden = [
		'password'
	];

	public function __construct($email = "", $password = "", $firstname = "", $surname = "") {
		$this->email = $email;
		$this->password = $password;
		$this->firstname = $firstname;
		$this->surname = $surname;
	}

	/**
	 *  Login user with given credentials
	 */
	public static function Login($user) {
		$json_user = self::createPostFieldsLogin($user);
		$response = self::postLogin($json_user);

		if(!empty($response)) {
			return self::convertJsonToUser(json_decode($response));  
		}
		else {
			return null;
		}
	}

	/**
	 *  Create poststring from credentials to login in user
	 */
	private static function createPostFieldsLogin($user) {
		$json = 
			'email=' 
			. $user->email 
			. '&password=' 
			. $user->password;
		return $json; 
	}

	/**
	 *  Use curl to communicate with webservice and verify login
	 */
	private static function postLogin($user) {
		$curl = curl_init(self::$url . '/login');
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $user);

		$response = curl_exec($curl);

		curl_close($curl);

		return $response;
	}

	/**
	 *  Convert a user from json format to CustomUser object
	 */
	private static function convertJsonToUser($json) {
		$user = new CustomUser();
		if(isset($json->userId)) $user->id = $json->userId;
		if(isset($json->firstName)) $user->firstname = $json->firstName;
		if(isset($json->surName)) $user->surname = $json->surName;
		if(isset($json->email)) $user->email = $json->email;
		return $user;
	}

	/**
	 *  Register a user
	 */
	public static function Register($user) {
		$json_user = self::createPostFieldsRegister($user);
		$response = self::postRegister($json_user);

		if($response) {
			return self::convertJsonToUser(json_decode($response));  
		}
		else {
			return null;
		}
	}

	/**
	 *  Create poststring from user info to register a user
	 */
	private static function createPostFieldsRegister($user) {
		$json =
			'firstname=' 
			. $user->firstname
			. '&surname=' 
			. $user->surname  
			. '&email=' 
			. $user->email 
			. '&password=' 
			. $user->password;
		return $json; 
	}

	private static function hashUserPassword($user) {
		$hash = hash("SHA256", $user->passsword);
		var_dump($hash);
		return $hash;
	}

	/**
	 *  Use curl to communicate with webservice and register the user
	 */
	private static function postRegister($json_user) {
		$curl = curl_init(self::$url . '/register');
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json_user);

		$response = curl_exec($curl);

		curl_close($curl);

		return $response;
	}

	/**
	 *  Use curl to communicate with webservice and update the name of the user
	 */
	public static function UpdateName($id, $firstname, $surname) {
		
		$json = self::createPostFieldsUpdateName($id, $firstname, $surname);
		$response = self::postUpdateName($json);
		
		if($response) {
			return self::convertJsonToUser(json_decode($response));  
		}
		else {
			return null;
		}
	}

	/**
	 *  Create poststring from user info to change name
	 */
	private static function createPostFieldsUpdateName($id, $firstname, $surname) {
		$json =
			'id=' 
			. $id
			. '&firstname=' 
			. $firstname
			. '&lastname=' 
			. $surname;
		return $json;
	}

	/**
	 *  Use curl to communicate with webservice and update name
	 */
	private static function postUpdateName($json){

		$curl = curl_init(self::$url . '/updatename');
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
		$response = curl_exec($curl);
		curl_close($curl);

		return $response;
	}

	/**
	 *  Use curl to communicate with webservice and update the email address of the user
	 */
	public static function UpdateEmail($id, $emailaddress) {
		
		$json = self::createPostFieldsUpdateEmail($id, $emailaddress);
		$response = self::postUpdateEmail($json);

		if($response) {
			return self::convertJsonToUser(json_decode($response));  
		}
		else {
			return null;
		}
	}

	/**
	 *  Create poststring from user info to change email address
	 */
	private static function createPostFieldsUpdateEmail($id, $emailaddress) {
		$json =
			'id=' 
			. $id
			. '&email=' 
			. $emailaddress;
		return $json;
	}

	/**
	 *  Use curl to communicate with webservice and update email address
	 */
	private static function postUpdateEmail($json){

		$curl = curl_init(self::$url . '/updateemail');
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
		$response = curl_exec($curl);
		curl_close($curl);

		return $response;
	}

	/**
	 *  Use curl to communicate with webservice and update password of the user
	 */
	public static function UpdatePassword($user, $currentpassword, $newpassword) {
		$user['password'] = $currentpassword;
		$json_user = self::createPostFieldsLogin($user);
		$response_login = self::postLogin($json_user);

		if(!empty($response_login)) {
			$auth_user = self::convertJsonToUser(json_decode($response_login));
			$json = self::createPostFieldsUpdatePassword($auth_user, $newpassword);
			$response = self::postUpdatePassword($json);
			
			if ($response === 'true') {
				return true;
			} else {
				return false;
			}
		}
		else {
			return false;
		}
	}

	/**
	 *  Create poststring from user info to change email address
	 */
	private static function createPostFieldsUpdatePassword($auth_user, $newpassword) {
		$json =
			'id=' 
			. $auth_user->id
			. '&password=' 
			. $newpassword;
		return $json;
	}

	/**
	 *  Use curl to communicate with webservice and update password
	 */
	private static function postUpdatePassword($json){

		$curl = curl_init(self::$url . '/updatepassword');
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
		$response = curl_exec($curl);
		curl_close($curl);

		return $response;
	}

}

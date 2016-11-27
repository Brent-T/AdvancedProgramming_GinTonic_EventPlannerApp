<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomUser extends Model
{
    // URL TO WEBSERVICE
    private static $url = 'http://localhost:9000';

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
}

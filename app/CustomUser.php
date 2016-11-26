<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomUser extends Model
{
    private static $url = 'http://localhost:9000';

    protected $fillable = [
        'firstname', 'surname', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function __construct($email = "", $password = "", $firstname = "", $surname = "") {
        $this->email = $email;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->surname = $surname;
    }

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

    private static function createPostFieldsLogin($user) {
        $json = 
            'email=' 
            . $user->email 
            . '&password=' 
            . $user->password;
        return $json; 
    }

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

    private static function convertJsonToUser($json) {
        $user = new CustomUser();
        if(isset($json->userId)) $user->id = $json->userId;
        if(isset($json->firstName)) $user->firstname = $json->firstName;
        if(isset($json->surName)) $user->surname = $json->surName;
        if(isset($json->email)) $user->email = $json->email;
        return $user;
    }

    public static function Register($user) {
        $json_user = self::createPostFieldsRegister($user);

        $curl = curl_init(self::$url . '/register');
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_user);

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }

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
}

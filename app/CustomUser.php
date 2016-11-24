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

    public function __construct($email, $password, $firstname = "", $surname = "") {
        $this->email = $email;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->surname = $surname;
    }

    public static function Login($user) {
        $json_user = self::createPostFieldsLogin($user);

        $curl = curl_init(self::$url . '/login');
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_user);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    private static function createPostFieldsLogin($user) {
        $json = 
            'email=' 
            . $user->email 
            . '&password=' 
            . $user->password;
        return $json; 
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

        return $response;
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
            . password_hash($user->password, PASSWORD_DEFAULT);
        return $json; 
    }
}

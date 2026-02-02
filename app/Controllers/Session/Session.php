<?php
namespace App\Controllers\Session;

class Session{
    
    public function __construct(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    public function setKey1($key1, $value1){
        $_SESSION[$key1] = $value1;
        
    }

    public function setKey2($key2, $value2){
        $_SESSION[$key2] = $value2;
    }

    public function setAuth($auth, $value){
        $_SESSION[$auth] = $value;
    }

    public function getKey1($key1){
        return isset($_SESSION[$key1]) ? $_SESSION[$key1]: null;
    }

    public function getKey2($key2){
        return isset($_SESSION[$key2]) ? $_SESSION[$key2]: null;
    }

    
    public function getAuth($auth){
        return isset($_SESSION[$auth]) ? $_SESSION[$auth]: null;
    }

    public function isLogIn(){
        return isset($_SESSION['auth']);
    }
}
<?php

require_once("model/StoreDB.php");
require_once("ViewHelper.php");

class StoreController {
    
    public static function index() {
        echo ViewHelper::render("view/view-anon.php");
    }
    
    public static function registerForm($values = [
        "firstname" => "",
        "lastname" => "",
        "email" => "",
        "password" => "",
        "ulica" => "",
        "hisnast" => "",
        "posta" => "",
        "postnast" => ""
    ]) {
        echo ViewHelper::render("view/view-register.php", $values);
    }
    
    public static function register() {
        $data = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($data)) {
            $id = StoreDB::insert($data);
            echo ViewHelper::redirect(BASE_URL . "store/" . $id);
        } else {
            self::registerForm($data);
        }
    }
    
    public static function loginForm($values = [
        "email" => "",
        "password" => ""
    ]) {
        echo ViewHelper::render("view/view-login.php", $values);
    }
    
    
     public static function checkValues($input) {
        if (empty($input)) {
            return FALSE;
        }

        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value != false;
        }

        return $result;
    }

    /**
     * Returns an array of filtering rules for manipulation books
     * @return type
     */
    public static function getRules() {
        return [
            'firstname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'lastname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_SANITIZE_SPECIAL_CHARS,
            'password' => FILTER_SANITIZE_SPECIAL_CHARS,
            'ulica' => FILTER_SANITIZE_SPECIAL_CHARS,
            'hisnast' => FILTER_VALIDATE_INT,
            'posta' => FILTER_SANITIZE_SPECIAL_CHARS,
            'postnast' => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => [
                    'min_range' => 1000,
                    'max_range' => 9999
                ]
            ]
            
        ];
    }
}



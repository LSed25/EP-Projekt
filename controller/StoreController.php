<?php

require_once("model/StoreDB.php");
require_once("ViewHelper.php");

class StoreController {
    
    public static function index() {
        if ($_SESSION["loggedIn"] == false) {
            echo ViewHelper::render("view/view-anon.php", [
                "books" => StoreDB::getAllBooks()
            ]);
        }
        else {
            echo ViewHelper::render("view/view-stranka.php", [
                 "books" => StoreDB::getAllBooks()
            ]);
        }
    }


        echo ViewHelper::render("view/view-anon.php", [
            "books" => StoreDB::getAllBooks()
        ]);
    }
    
    public static function pridobiEno($id) {
        echo ViewHelper::render("view/view-knjiga.php", StoreDB::get(["id" => $id]));
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
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            StoreDB::insertCustomer($data);
            echo ViewHelper::redirect(BASE_URL . "store/");
        } else {
            self::registerForm($data);
        }
    }

    public static function login() {
        
        $email=$_POST['email'];
		$password=password_hash($_POST['password'], PASSWORD_DEFAULT);

        $id = StoreDB::getCustomerID($email, $password);

        if ($id != NULL) {
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;
            $_SESSION["loggedIn"] = true;
            echo ViewHelper::redirect(BASE_URL . "store/");
        }
        else {
            $_SESSION["loggedIn"] = false;
            $message = "Prijava ni bila uspešna.";
            echo ViewHelper::render("view/view-login.php", $message);
        }

    }

    public static function logout() {
        session_destroy();
        unset($_SESSION);
        session_start();
        $_SESSION["loggedIn"] = false;

        echo ViewHelper::redirect(BASE_URL . "store/");
    }
    
    public static function loginForm($values = [
        "email" => "",
        "password" => ""
    ]) {
        echo ViewHelper::render("view/view-login.php", $values);
    }
    
    public static function sysLoginForm($values = [
        "email" => "",
        "password" => ""
    ]) {
        echo ViewHelper::render("view/syslogin.php", $values);
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
            'password' => [ 
                'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
                'options' => [
                    'min_length' => 9
                ]
            ],
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



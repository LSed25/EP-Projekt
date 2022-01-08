<?php

require_once("model/AdminDB.php");
require_once("ViewHelper.php");
require_once("controller/AdminController.php");

class StoreController {
    
    public static function index() {
        if ($_SESSION["loggedIn"] == false) {
            echo ViewHelper::render("view/view-anon.php", [
                "books" => AdminDB::getAllBooks()
            ]);
        }
        else {
            echo ViewHelper::render("view/view-stranka.php", [
                 "books" => AdminDB::getAllBooks()
            ]);
        }
    }
    
    public static function pridobiEno($id) {
        echo ViewHelper::render("view/view-knjiga.php", AdminDB::get(["id" => $id]));
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
            AdminDB::insertCustomer($data);
            echo ViewHelper::redirect(BASE_URL . "store/");
        } else {
            self::registerForm($data);
        }
    }

    public static function login() {

        $email=$_POST['email'];
	$password=$_POST['password'];

        $role=$_POST["role"];
        
        
        $podatki["message"] = "";

        if ($role == "stranka") {
            $id = AdminDB::getCustomerID($email, $password);

            if ($id != NULL) {
                $_SESSION["id"] = $id;
                $_SESSION["role"] = $role;
                $_SESSION["loggedIn"] = true;
                echo ViewHelper::redirect(BASE_URL . "store/");
            }
            else {
                $_SESSION["loggedIn"] = false;
                $message = "Prijava ni bila uspešna.";
              
                echo ViewHelper::render("view/view-login.php", $message);
            }
        }
        else if ($role == "administrator") {
            $id_admin = AdminDB::getAdminID($email);

            if ($id_admin != NULL) {
                $confirmpassword = AdminDB::getAdminPassword($id_admin)["Geslo"];
                
                $verified = password_verify($password, $confirmpassword);
                if ($verified) {
                    $_SESSION["id"] = $id_admin;
                    $_SESSION["role"] = $role;
                    $_SESSION["loggedIn"] = true;
                    
                    $podatki = AdminDB::getAdminData($id_admin);
                    echo ViewHelper::render("view/view-admin.php", $podatki);
                }
                else {
                    $_SESSION["loggedIn"] = false;
                    $podatki["message"] = "Geslo je napačno.";
                    echo ViewHelper::render("view/syslogin.php", $podatki);
                }
            }
            else {
                $_SESSION["loggedIn"] = false;
                $podatki["message"] = "Prijava ni bila uspešna.";
                echo ViewHelper::render("view/syslogin.php", $podatki);
            }
        }
        else if ($role == "prodajalec") {
            $id_prodajalec = AdminDB::getSellerID($email, $password);

            if ($id != NULL) {
                $podatki = AdminDB::getSellerData($id_prodajalec);

                if ($podatki["Aktiviran"] == true) {
                    $_SESSION["id"] = $id_prodajalec;
                    $_SESSION["role"] = $role;
                    $_SESSION["loggedIn"] = true;

                    echo ViewHelper::render("view/view-prodajalec.php", $podatki);
                }
                else {
                    $_SESSION["loggedIn"] = false;
                    $message = "Prijava ni bila mogoča - profil prodajalca je deaktiviran.";
                    echo ViewHelper::render("view/syslogin.php", $message);
                }
            }
            else {
                $_SESSION["loggedIn"] = false;
                $message = "Prijava ni bila uspešna.";
                echo ViewHelper::render("view/syslogin.php", $message);
            }
        }
    }

    public static function changePassword() {
        $role = $_SESSION["role"];

        $oldpassword=$_POST['oldpassword'];
        $newpassword=password_hash($_POST['newpassword'], PASSWORD_DEFAULT);

        if (!$role) {
            echo ViewHelper::redirect(BASE_URL . "store/");
        }
        else if ($role == "stranka") {
            $id = $_SESSION["id"];
            $confirmpassword = AdminDB::getPassword($id);
            
            if (password_verify($oldpassword, $confirmpassword)) {
                AdminDB::changePassword($id, $newpassword);
                echo ViewHelper::render("view/view-stranka-profil.php");
            }
            else {
                $message = "Sprememba gesla ni bila uspešna - staro geslo se ne ujema.";
            }
        }
        else if ($role == "administrator") {
            $id = $_SESSION["id"];
            $confirmpassword = AdminDB::getAdminPassword($id);
            
            $podatki = AdminDB::getAdminData($id);
            if (password_verify($oldpassword, $confirmpassword)) {
                AdminDB::changeAdminPassword($id, $newpassword);
                $podatki["message"] = "Geslo je bilo uspešno spremenjeno.";
                echo ViewHelper::render("view/view-admin.php", $podatki);
            }
            else {
                $podatki["message"] = "Sprememba gesla ni bila uspešna - staro geslo se ne ujema.";
                echo ViewHelper::render("view/view-admin.php", $podatki);
            }
            
        }
        else if ($role == "prodajalec") {
            $id = $_SESSION["id"];
            $confirmpassword = AdminDB::getSellerPassword($id);

            $podatki = AdminDB::getSellerData($id);
            if (password_verify($oldpassword, $confirmpassword)) {
               AdminDB::changeSellerPassword($id, $newpassword); 
               $podatki["message"] = "Geslo je bilo uspešno spremenjeno.";
               echo ViewHelper::render("view/view-prodajalec.php", $podatki);
            }
            else {
                $podatki["message"] = "Sprememba gesla ni bila uspešna - staro geslo se ne ujema.";
                echo ViewHelper::render("view/view-prodajalec.php", $podatki);
            }
        }
    }

    public static function logout() {
        session_destroy();
        unset($_SESSION);
        session_start();
        $_SESSION["loggedIn"] = false;
        $_SESSION["role"] = "anon";

        echo ViewHelper::redirect(BASE_URL . "store/");
    }
    
    public static function loginForm($values = [
        "email" => "",
        "password" => ""
    ]) {
        echo ViewHelper::render("view/view-login.php", $values);
    }
    
    public static function sysLoginForm($podatki = [
        "message" => ""
    ]) {
        echo ViewHelper::render("view/syslogin.php", $podatki);
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

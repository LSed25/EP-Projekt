<?php

require_once("model/AdminDB.php");
require_once("ViewHelper.php");
require_once("controller/AdminController.php");

class StoreController {
    
    public static function index() {
        if ($_SESSION["loggedIn"] == true) {
            echo ViewHelper::render("view/view-stranka.php", [
                 "books" => AdminDB::getAllBooks()
            ]);
        }
        else {
            echo ViewHelper::render("view/view-anon.php", [
                "books" => AdminDB::getAllBooks()
            ]);
        }
    }
    
    public static function pridobiEno($id) {
            if ($_SESSION["loggedIn"] == false) {
            echo ViewHelper::render("view/view-knjiga.php", AdminDB::get(["id" => $id]));
        }else{
            echo ViewHelper::render("view/view-knjiga-stranka.php", AdminDB::get(["id" => $id]));
        }
    }
    
    public static function getCustomer($id) {
        echo ViewHelper::render("view/view-stranka-profil.php", AdminDB::getUser(["id" => $id]));
    }
    
    public static function vPK() {
        $data = filter_input_array(INPUT_POST);

        if (self::checkValues($data)) {
            $kCena = $data['cena']*$data['kolicina'];
            $data['cena'] = $kCena;
            
            
            AdminDB::buy($data);
            $id = AdminDB::pridobiPKID();
            echo ViewHelper::redirect(BASE_URL . "store/cart/" . $id['LAST_INSERT_ID()']);
        } else {
            self::pridobiEno($id);
        }
    }
    
    public static function addToCart($id) {
        $newid['id_pk'] = $id;
        $data = AdminDB::pridobiPK($newid);
        
        if (self::checkValues($data)) {
            AdminDB::addToCart($data);
            echo ViewHelper::redirect(BASE_URL . "store/");
        } else {
            self::pridobiEno($data['id_produkt']);
        }
    }
    public static function cartDelete($id) {
        AdminDB::emptyCart(["id" => $id]);
        echo ViewHelper::redirect(BASE_URL . "store/");
        
    }
    
    public static function cart($id) {
        $books = 0;
        $books = AdminDB::getCartUser(["id" => $id]);
        //var_dump($books);
        if(!$books) {
            echo ViewHelper::render("view/view-cart.php", [
                     "books" => $books]);
        }else{
            for($i = 0; $i < count($books); $i++) {
                $newid['id_pk'] = $books[$i]['id_artikel'];
                $pks[$i] = AdminDB::pridobiPKA($newid);    
            }
            for($i = 0; $i < count($pks); $i++) {
                $newid['id'] = $pks[$i]['id_produkt'];
                $products[$i] = AdminDB::get($newid);
            }
            echo ViewHelper::render("view/view-cart.php", [
                     "books" => $books,
                     "products" => $products,
                     "pks" => $pks
                    ]);
        }
    }
    
    public static function editForm($params) {
        if (is_array($params)) {
            $values = $params;
        } else if (is_numeric($params)) {
            $values = AdminDB::getUser(["id" => $params]);
        } else {
            throw new InvalidArgumentException("Cannot show form.");
        }

        echo ViewHelper::render("view/user-edit.php", $values);
    }

    public static function edit($id) {
        $data = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($data)) {
            $data["id"] = $id;
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            AdminDB::update($data);
            ViewHelper::redirect(BASE_URL . "store/user/" . $data["id"]);
        } else {
            self::editForm($data);
        }
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
            $id = AdminDB::getCustomerID($email);
            
            if ($id != NULL) {
                $confirmpassword = AdminDB::getPassword($id)["Geslo"];
                
                $verified = password_verify($password, $confirmpassword);
                if ($verified) {
                    $_SESSION["id"] = $id;
                    $_SESSION["role"] = $role;
                    $_SESSION["loggedIn"] = true;
                    
                    
                    echo ViewHelper::redirect(BASE_URL . "store/user/" . $id["id"]);
                }
                else {
                    $_SESSION["loggedIn"] = false;
                    $podatki["message"] = "Prijava ni bila uspešna.";

                    echo ViewHelper::render("view/view-login.php", $podatki);
                }
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
            $id_prodajalec = AdminDB::getSellerID($email);

            if ($id_prodajalec != NULL) {
                $confirmpassword = AdminDB::getSellerPassword($id_prodajalec)["Geslo"];

                $verified = password_verify($password, $confirmpassword);
                if ($verified) {
                    $podatki = AdminDB::getSellerData($id_prodajalec);

                    if ($podatki["Aktiviran"] == true) {
                        $_SESSION["id"] = $id_prodajalec;
                        $_SESSION["role"] = $role;
                        $_SESSION["loggedIn"] = true;
                        
                        echo ViewHelper::render("view/view-prodajalec.php", $podatki);
                    }
                    else {
                        $_SESSION["loggedIn"] = false;
                        $podatki["message"] = "Prijava ni bila mogoča - profil prodajalca je deaktiviran.";
                        echo ViewHelper::render("view/syslogin.php", $podatki);
                    }
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
    }

    public static function changePassword() {
        $role = $_POST["role"];

        $oldpassword=$_POST['oldpassword'];
        $newpassword=password_hash($_POST['newpassword'], PASSWORD_DEFAULT);

        if ($role == "stranka") {
            $who = $_POST["changedby"];
            
            if ($who == "stranka") {
                $id = $_SESSION["id"];
            }
            else {
                $id = $_POST["id"];
            }

            $confirmpassword = AdminDB::getPassword($id)["Geslo"];
            $podatki = AdminDB::getCustomerData($id);

            if (password_verify($oldpassword, $confirmpassword)) {
                AdminDB::changePassword($id, $newpassword); 
                $podatki["message"] = "Geslo je bilo uspešno spremenjeno.";
                if ($who == "prodajalec") {
                    echo ViewHelper::render("view/view-prodajalec-stranka.php", $podatki);
                }
                else {
                    echo ViewHelper::render("view/view-stranka-profil.php", $podatki);
                }
             }
             else {
                 $podatki["message"] = "Sprememba gesla ni bila uspešna - staro geslo se ne ujema.";
                 if ($who == "prodajalec") {
                    echo ViewHelper::render("view/view-prodajalec-stranka.php", $podatki);
                }
                else {
                    echo ViewHelper::render("view/view-stranka-profil.php", $podatki);
                }
             }
        }
        else if ($role == "administrator") {
            $id = $_SESSION["id"];
            $confirmpassword = AdminDB::getAdminPassword($id)["Geslo"];
            
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
            $who = $_POST["changedby"];
            
            if ($who == "prodajalec") {
                $id = $_SESSION["id"];
            }
            else {
                $id = $_POST["id"];
            }
            $confirmpassword = AdminDB::getSellerPassword($id)["Geslo"];

            $podatki = AdminDB::getSellerData($id);
            if (password_verify($oldpassword, $confirmpassword)) {
               AdminDB::changeSellerPassword($id, $newpassword); 
               $podatki["message"] = "Geslo je bilo uspešno spremenjeno.";
               if ($who == "administrator") {
                   
                   echo ViewHelper::render("view/view-admin-prodajalec.php", $podatki);
               }
               else {
                   echo ViewHelper::render("view/view-prodajalec.php", $podatki);
               }
            }
            else {
                $podatki["message"] = "Sprememba gesla ni bila uspešna - staro geslo se ne ujema.";
                if ($who == "administrator") {
                   
                   echo ViewHelper::render("view/view-admin-prodajalec.php", $podatki);
               }
               else {
                   echo ViewHelper::render("view/view-prodajalec.php", $podatki);
               }
            }
        }
        else {
            echo ViewHelper::redirect(BASE_URL . "store/");
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
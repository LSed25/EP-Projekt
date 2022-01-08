<?php

require_once("model/AdminDB.php");
require_once("ViewHelper.php");
require_once("controller/StoreController.php");
require_once("controller/StoreRESTController.php");

class AdminController {
    public static function adminForm($message = "") {
        if ($_SESSION["loggedIn"] == true && $_SESSION["role"] == "administrator") {
            $podatki = AdminDB::getAdminData($_SESSION["id"]);

            echo ViewHelper::render("view/view-admin.php", $podatki, $message);            
        }
        else {
            echo ViewHelper::redirect(BASE_URL . "store/");
        }
    }
    
    public static function admin() {
        $podatki = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($podatki)) {
            $id = $_SESSION["id"];
            $ime = $podatki["name"];
            $priimek = $podatki["surname"];
            $email = $podatki["email"];
            AdminDB::updateAdmin($id, $ime, $priimek, $email);
            $message = "Podatki so bili uspešno posodobljeni.";
            adminForm($message);
        } else {
            $message = "Prišlo je do napake pri posodabljanju podatkov.";
            adminForm($message);
        }
    }

    public static function adminProdajalecForm($message = "", $id = NULL) {
        if ($_SESSION["loggedIn"] == true && $_SESSION["role"] == "administrator") {
            if ($id == NULL) {
                $id = $_GET["id"];
            }
            $podatki = AdminDB::getSellerData($id);

            if ($podatki != NULL) {
                echo ViewHelper::render("view/view-admin-prodajalec.php", $podatki, $message);
            }
            else {
                $message = "Prodajalca ni bilo mogoče najti.";
                $podatki = AdminDB::getAdminData($_SESSION["id"]);
                echo ViewHelper::render("view/view-admin.php", $podatki, $message);
            }
        }
    }

    public static function adminProdajalec() {
        $do = $_POST["do"];

        switch($do){
            case "add":
                $ime = $_POST["name"];
                $priimek = $_POST["surname"];
                $email = $_POST["email"];
                $geslo = password_hash($_POST['password'], PASSWORD_DEFAULT);

                AdminDB::insertSeller($ime, $priimek, $email, $geslo);

                $message = "Prodajalec je bil uspešno dodan.";
                adminForm($message);
                break;
            case "update":
                $id = $_POST["id"];
                $ime = $_POST["name"];
                $priimek = $_POST["surname"];
                $email = $_POST["newemail"];
                $geslo = password_hash($_POST['password'], PASSWORD_DEFAULT);

                AdminDB::updateSeller($ime, $priimek, $email, $geslo);

                $message = "Prodajalec je bil uspešno posodobljen.";
                adminProdajalecForm($message, $id);
                break;
            case "status":
                $id = $_POST["id"];

                if ($_POST["status"] == true) {
                    $updatestatus = false;
                    $message = "Prodajalec je bil uspešno deaktiviran.";
                }
                else {
                    $updatestatus = true;
                    $message = "Prodajalec je bil uspešno aktiviran.";
                }

                AdminDB::activateSeller($id);
                adminProdajalecForm($message);
                break;  
        }
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

    public static function getRules() {
        return [
            'firstname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'lastname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_SANITIZE_SPECIAL_CHARS,
            ]   
        ];
    }
}

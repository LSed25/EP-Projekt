<?php

require_once("model/AdminDB.php");
require_once("ViewHelper.php");
require_once("controller/StoreController.php");
require_once("controller/StoreRESTController.php");

class AdminController {
    public static function adminForm() {
        if ($_SESSION["loggedIn"] == true && $_SESSION["role"] == "administrator") {
            $podatki = AdminDB::getAdminData($_SESSION["id"]);

            echo ViewHelper::render("view/view-admin.php", $podatki);            
        }
        else {
            echo ViewHelper::redirect(BASE_URL . "store/");
        }
    }
    
    public static function admin() {
        $podatki = filter_input_array(INPUT_POST, self::getRules());
        $id = $_SESSION["id"];
        
        if (self::checkValues($podatki)) {
            $ime = $podatki["name"];
            $priimek = $podatki["surname"];
            $email = $podatki["email"];
            AdminDB::updateAdmin($id, $ime, $priimek, $email);
            $variables = AdminDB::getAdminData($id);
            $variables["message"] = "Podatki so bili uspešno posodobljeni.";
            
            echo ViewHelper::render("view/view-admin.php", $variables);
        } else {
            $variables = AdminDB::getAdminData($id);
            $variables["message"] = "Prišlo je do napake pri posodabljanju podatkov.";
            echo ViewHelper::render("view/view-admin.php", $variables);
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
            case "search":
                $id_prodajalec = $_POST["id"];

                $podatki = AdminDB::getSellerData($id_prodajalec);
                echo ViewHelper::render("view/view-admin-prodajalec.php", $podatki);
                break;
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

                AdminDB::updateSeller($id,$ime, $priimek, $email);
                
                $podatki = AdminDB::getSellerData($id);
                $podatki["message"] = "Prodajalec je bil uspešno posodobljen.";
                echo ViewHelper::render("view/view-admin-prodajalec.php", $podatki);
                break;
            case "status":
                $id = $_POST["id"];

                if ($_POST["status"] == true) {
                    $updatestatus = false;
                    $podatki["message"] = "Prodajalec je bil uspešno deaktiviran.";
                }
                else {
                    $updatestatus = true;
                    $podatki["message"] = "Prodajalec je bil uspešno aktiviran.";
                }

                AdminDB::activateSeller($id, $updatestatus);
                $podatki = AdminDB::getSellerData($id);
                echo ViewHelper::render("view/view-admin-prodajalec.php", $podatki);
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
            'name' => FILTER_SANITIZE_SPECIAL_CHARS,
            'surname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_SANITIZE_EMAIL
            ];   
        
    }
}








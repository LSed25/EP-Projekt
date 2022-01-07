<?php

require_once("model/StoreDB.php");
require_once("ViewHelper.php");
require_once("controller/StoreController.php");

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
            AdminDB::updateAdmin($podatki);
            $message = "Podatki so bili uspešno posodobljeni.";
            adminForm($message);
        } else {
            $message = "Prišlo je do napake pri posodabljanju podatkov.";
            adminForm($message);
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

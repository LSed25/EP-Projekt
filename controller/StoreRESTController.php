<?php

require_once("model/AdminDB.php");
require_once("ViewHelper.php");
require_once("controller/StoreController.php");
require_once("controller/AdminController.php");


class StoreRESTController {
    public static function index() {
        $prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
                . $_SERVER["REQUEST_URI"];
        echo ViewHelper::renderJSON();
    }
    
    public static function register() {
        $data = filter_input_array(INPUT_POST, StoreController::getRules());

        if (StoreController::checkValues($data)) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $id = StoreDB::insertCustomer($data);
            echo ViewHelper::renderJSON("", 201);
            ViewHelper::redirect(BASE_URL . "api/store/user/$id");
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
    }
   
}


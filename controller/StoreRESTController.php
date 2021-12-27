<?php

require_once("model/StoreDB.php");
require_once("ViewHelper.php");
require_once("controller/StoreController.php");


class StoreRESTController {
    public static function index() {
        $prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
                . $_SERVER["REQUEST_URI"];
        echo ViewHelper::renderJSON();
    }
    
    public static function register() {
        $data = filter_input_array(INPUT_POST, StoreController::getRules());

        if (StoreController::checkValues($data)) {
            $id = StoreDB::insert($data);
            echo ViewHelper::renderJSON("", 201);
            ViewHelper::redirect(BASE_URL . "api/store/user/$id");
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
    }
   
}


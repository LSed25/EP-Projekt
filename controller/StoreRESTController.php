<?php

require_once("model/AdminDB.php");
require_once("ViewHelper.php");
require_once("controller/StoreController.php");
require_once("controller/AdminController.php");


class StoreRESTController {
    public static function index() {
        $prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
                . $_SERVER["REQUEST_URI"];
        echo ViewHelper::renderJSON(AdminDB::getAllwithURI(["prefix" => $prefix]));
    }
    
    public static function getUser($id) {
        try {
            echo ViewHelper::renderJSON(AdminDB::getUser(["id" => $id]));
        } catch (InvalidArgumentException $e) {
            echo ViewHelper::renderJSON($e->getMessage(), 404);
        }
    }
    
    public static function get($id) {
        try {
            echo ViewHelper::renderJSON(AdminDB::get(["id" => $id]));
        } catch (InvalidArgumentException $e) {
            echo ViewHelper::renderJSON($e->getMessage(), 404);
        }
    }
   
}


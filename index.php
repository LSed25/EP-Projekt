<?php

// enables sessions for the entire app
session_start();

require_once("controller/StoreController.php");
//require_once("controller/StoreRESTController.php");

define("BASE_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "/^store$/" => function ($method) {
        StoreController::index();
    },
    "/^store\/register$/" => function ($method) {
        if ($method == "POST") {
            StoreController::register();
        } else {
            StoreController::registerForm();
        }
    },
    "/^store\/login$/" => function ($method) {
        if ($method == "POST") {
            StoreController::login();
        } else {
            StoreController::loginForm();
        }
    },
    
    /*"jokes/edit" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            JokesController::edit();
        } else {
            JokesController::editForm();
        }
    },
    "jokes/delete" => function () {
        JokesController::delete();
    },
    "" => function () {
        ViewHelper::redirect(BASE_URL . "jokes");
    },*/
    "/^$/" => function () {
        ViewHelper::redirect(BASE_URL . "store");
    },
    # REST API
    /*"/^api\/books\/(\d+)$/" => function ($method, $id) {
        // TODO: izbris knjige z uporabo HTTP metode DELETE
        switch ($method) {
            case "PUT":
                BooksRESTController::edit($id);
                break;
            case "DELETE":
                BooksRESTController::delete($id);
                break;
            default: # GET
                BooksRESTController::get($id);
                break;
        }
    },
    "/^api\/books$/" => function ($method) {
        switch ($method) {
            case "POST":
                BooksRESTController::add();
                break;
            default: # GET
                BooksRESTController::index();
                break;
        }
    },*/
];

foreach ($urls as $pattern => $controller) {
    if (preg_match($pattern, $path, $params)) {
        try {
            $params[0] = $_SERVER["REQUEST_METHOD"];
            $controller(...$params);
        } catch (InvalidArgumentException $e) {
            ViewHelper::error404();
        } catch (Exception $e) {
            ViewHelper::displayError($e, true);
        }

        exit();
    }
}

ViewHelper::displayError(new InvalidArgumentException("No controller matched."), true);
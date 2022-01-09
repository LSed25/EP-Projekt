<?php

// enables sessions for the entire app
session_start();
if(!isset($_SESSION["id"])) {
    $_SESSION["role"] = "anon";
    $_SESSION["loggedIn"] = false;
}else{
    $_SESSION["loggedIn"] = true;
}


require_once("controller/StoreController.php");
require_once("controller/AdminController.php");
require_once("controller/StoreRESTController.php");

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

    "/^store\/logout$/" => function ($method) {
        StoreController::logout();
    },
    
    "/^store\/syslogin$/" => function ($method) {
        if ($method == "POST") {
            StoreController::sysLogin();
        } else {
            StoreController::sysLoginForm();
        }
    },

    "/^store\/changepassword$/" => function ($method) {
        if ($method == "POST") {
            StoreController::changePassword();
        }
    },

    "/^store\/(\d+)$/" => function ($method, $id) {
        StoreController::pridobiEno($id);
    },
    
    "/^store\/user\/(\d+)$/" => function ($method, $id) {
        StoreController::getCustomer($id);
    },
            
    "/^store\/user\/edit\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            StoreController::edit($id);
        } else {
            StoreController::editForm($id);
        }
    },
    
    "/^store\/buy$/" => function ($method) {
        StoreController::vPK();
    },

    "/^store\/cart\/(\d+)$/" => function ($method, $id) {
        StoreController::addToCart($id);
    },
            
    "/^store\/user\/cart\/(\d+)$/" => function ($method, $id) {
        StoreController::cart($id);
    },
            
    "/^store\/admin$/" => function ($method) {
        if ($method == "POST") {
            AdminController::admin();
        } else {
            AdminController::adminForm();
        }
    },
    
    "/^store\/admin\/prodajalec$/" => function ($method) {
        if ($method == "POST") {
            AdminController::adminProdajalec();
        } 
    },
            
    "/^store\/(\d+)$/" => function ($method, $id) {
        StoreController::pridobiEno($id);
    },

    "/^$/" => function () {
        ViewHelper::redirect(BASE_URL . "store");
    },
    
    //--------
    // API
    //--------
    "/^api\/store$/" => function ($method) {
        switch ($method) {
            default: # GET
                StoreRESTController::index();
                break;
        }
    },
    "/^api\/store\/(\d+)$/" => function ($method, $id) {
        switch ($method) {
            default: # GET
                StoreRESTController::get($id);
                break;
        }
    },
    "/^api\/store\/user\/(\d+)$/" => function ($method, $id) {
        switch ($method) {
            default: # GET
                StoreRESTController::getUser($id);
                break;
        }
    }
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
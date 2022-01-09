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
        if (!($_SESSION["loggedIn"] == true && $_SESSION["role"] == "administrator")) {
            echo ViewHelper::redirect(BASE_URL . "store/");
            return;
        }

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

    public static function prodajalecForm() {
        if ($_SESSION["loggedIn"] == true && $_SESSION["role"] == "prodajalec") {
            $podatki = AdminDB::getSellerData($_SESSION["id"]);

            echo ViewHelper::render("view/view-prodajalec.php", $podatki);            
        }
        else {
            echo ViewHelper::redirect(BASE_URL . "store/");
        }
    }

    public static function prodajalec() {
        if (!($_SESSION["loggedIn"] == true && $_SESSION["role"] == "prodajalec")) {
            echo ViewHelper::redirect(BASE_URL . "store/");
            return;
        }
        
        $podatki = filter_input_array(INPUT_POST, self::getRules());
        $id = $_SESSION["id"];
        
        if (self::checkValues($podatki)) {
            $ime = $podatki["name"];
            $priimek = $podatki["surname"];
            $email = $podatki["email"];
            AdminDB::updateSeller($id, $ime, $priimek, $email);
            $variables = AdminDB::getSellerData($id);
            $variables["message"] = "Podatki so bili uspešno posodobljeni.";
            
            echo ViewHelper::render("view/view-prodajalec.php", $variables);
        } else {
            $variables = AdminDB::getSellerData($id);
            $variables["message"] = "Prišlo je do napake pri posodabljanju podatkov.";
            echo ViewHelper::render("view/view-prodajalec.php", $variables);
        }
    }

    public static function adminProdajalec() {
        $do = $_POST["do"];

        switch($do){
            case "search":
                $id_prodajalec = $_POST["id"];

                $podatki = AdminDB::getSellerData($id_prodajalec);
                if ($podatki) {
                    echo ViewHelper::render("view/view-admin-prodajalec.php", $podatki);
                }
                else {
                    $podatki = AdminDB::getAdminData($_SESSION["id"]);
                    $podatki["message"] = "Prodajalec s tem ID ne obstaja.";
                    echo ViewHelper::render("view/view-admin.php", $podatki);
                }
                
                break;
            case "add":
                $ime = $_POST["name"];
                $priimek = $_POST["surname"];
                $email = $_POST["email"];
                $geslo = password_hash($_POST['password'], PASSWORD_DEFAULT);

                AdminDB::insertSeller($ime, $priimek, $email, $geslo);
         
                $podatki = AdminDB::getAdminData($_SESSION["id"]);
                $podatki["message"] = "Prodajalec je bil uspešno dodan.";
                echo ViewHelper::render("view/view-admin.php", $podatki);
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

    public static function produkti() {
        $do = $_POST["do"];

        switch($do){
            case "search":
                $id_produkt = $_POST["id"];

                $podatki = AdminDB::getProductData($id_produkt);

                if ($podatki) {
                    echo ViewHelper::render("view/view-prodajalec-produkt.php", $podatki);
                }
                else {
                    $podatki = AdminDB::getSellerData($_SESSION["id"]);
                    $podatki["message"] = "Produkt s tem ID ne obstaja.";
                    echo ViewHelper::render("view/view-prodajalec.php", $podatki);
                }
                
                break;
            case "add":
                $avtor = $_POST["author"];
                $naslov = $_POST["title"];
                $leto_izdaje = $_POST["year"];
                $cena = $_POST["price"];

                AdminDB::insertProduct($avtor, $naslov, $leto_izdaje, $cena);
         
                $podatki = AdminDB::getSellerData($_SESSION["id"]);
                $podatki["message"] = "Produkt je bil uspešno dodan.";
                echo ViewHelper::render("view/view-prodajalec.php", $podatki);
                break;
            case "update":
                $id = $_POST["id"];
                $avtor = $_POST["author"];
                $naslov = $_POST["title"];
                $leto_izdaje = $_POST["year"];
                $cena = $_POST["price"];

                AdminDB::updateProduct($id, $avtor, $naslov, $leto_izdaje, $cena);
                
                $podatki = AdminDB::getProductData($id);
                $podatki["message"] = "Produkt je bil uspešno posodobljen.";
                echo ViewHelper::render("view/view-prodajalec-produkt.php", $podatki);
                break;
            case "status":
                $id = $_POST["id"];

                if ($_POST["status"] == true) {
                    $updatestatus = false;
                    $podatki["message"] = "Produkt je bil uspešno deaktiviran.";
                }
                else {
                    $updatestatus = true;
                    $podatki["message"] = "Produkt je bil uspešno aktiviran.";
                }

                AdminDB::activateProduct($id, $updatestatus);
                $podatki = AdminDB::getProductData($id);
                echo ViewHelper::render("view/view-prodajalec-produkt.php", $podatki);
                break;  
        }
    }

    public static function stranke() {
        $do = $_POST["do"];

        switch($do){
            case "search":
                $id_stranka = $_POST["id"];

                $podatki = AdminDB::getCustomerData($id_stranka);

                if ($podatki) {
                    echo ViewHelper::render("view/view-prodajalec-stranka.php", $podatki);
                }
                else {
                    $podatki = AdminDB::getSellerData($_SESSION["id"]);
                    $podatki["message"] = "Stranka s tem ID ne obstaja.";
                    echo ViewHelper::render("view/view-prodajalec.php", $podatki);
                }
                
                break;
            case "add":
                $ime = $_POST["name"];
                $priimek = $_POST["surname"];
                $email = $_POST["email"];
                $geslo = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $ulica = $_POST["street"];
                $hisna = $_POST["housenumber"];
                $posta = $_POST["postoffice"];
                $postna = $_POST["postnumber"];

                AdminDB::addCustomer($ime, $priimek, $email, $geslo, $ulica, $hisna, $posta, $postna);
         
                $podatki = AdminDB::getSellerData($_SESSION["id"]);
                $podatki["message"] = "Stranka je bila uspešno dodana.";
                echo ViewHelper::render("view/view-prodajalec.php", $podatki);
                break;
            case "update":
                $id = $_POST["id"];
                $ime = $_POST["name"];
                $priimek = $_POST["surname"];
                $email = $_POST["email"];
                $ulica = $_POST["street"];
                $hisna = $_POST["housenumber"];
                $posta = $_POST["postoffice"];
                $postna = $_POST["postnumber"];

                AdminDB::updateCustomer($id, $ime, $priimek, $email, $ulica, $hisna, $posta, $postna);
                
                $podatki = AdminDB::getCustomerData($id);
                $podatki["message"] = "Stranka je bila uspešno posodobljena.";
                echo ViewHelper::render("view/view-prodajalec-stranka.php", $podatki);
                break;
            case "status":
                $id = $_POST["id"];

                if ($_POST["status"] == true) {
                    $updatestatus = false;
                    $podatki["message"] = "Stranka je bila uspešno deaktivirana.";
                }
                else {
                    $updatestatus = true;
                    $podatki["message"] = "Stranka je bila uspešno aktivirana.";
                }

                AdminDB::activateCustomer($id, $updatestatus);
                $podatki = AdminDB::getCustomerData($id);
                echo ViewHelper::render("view/view-prodajalec-stranka.php", $podatki);
                break;  
        }
    }

    public static function zgodovinaNarocil() {
        if ($_SESSION["loggedIn"] == true && $_SESSION["role"] == "prodajalec") {
            $vsa_narocila = AdminDB::getOrders();

            foreach ($vsa_narocila as $narocilo) {
                $id = $narocilo["id_stranka"];
                $narocilo["stranka"] = AdminDB::getCustomerData($id);

                
            }
            
            echo ViewHelper::render("view/view-prodajalec-narocilo.php", $vsa_narocila);
        }
        else {
            echo ViewHelper::redirect(BASE_URL . "store/");
        }
    }

    public static function getRules() {
        return [
            'name' => FILTER_SANITIZE_SPECIAL_CHARS,
            'surname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_SANITIZE_EMAIL
            ];   
        
    }
}






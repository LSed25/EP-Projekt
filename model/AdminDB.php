<?php

require_once 'model/AbstractDB.php';

class StoreDB extends AbstractDB {
    public static function getAdminID($email, $password) {
        $db = DB::getInstance();

        $statement = $db->prepare("SELECT id_admin FROM Administrator
            WHERE Enaslov=:email AND Geslo=:password");
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":password", $password, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getAdminData($id) {
        $db = DB::getInstance();

        $statement = $db->prepare("SELECT * FROM Administrator
            WHERE id=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getSellerID($email, $password) {
        $db = DB::getInstance();

        $statement = $db->prepare("SELECT id_prodajalec FROM Prodajalec
            WHERE Enaslov=:email AND Geslo=:password");
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":password", $password, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getSellerData($id) {
        $db = DB::getInstance();

        $statement = $db->prepare("SELECT * FROM Prodajalec
            WHERE id=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getAdminPassword($id) {
        $db = DB::getInstance();

        $statement = $db->prepare("SELECT Geslo FROM Administrator
            WHERE id_admin=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function changeAdminPassword($id, $newpassword) {
        $db = DB::getInstance();

        $statement = $db->prepare("UPDATE Administrator
           SET Geslo=:newpassword WHERE id_admin=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":newpassword", $newpassword, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getSellerPassword($id) {
        $db = DB::getInstance();

        $statement = $db->prepare("SELECT Geslo FROM Prodajalec
            WHERE id_prodajalec=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function changeSellerPassword($id, $newpassword) {
        $db = DB::getInstance();

        $statement = $db->prepare("UPDATE Prodajalec
           SET Geslo=:newpassword WHERE id_prodajalec=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":newpassword", $newpassword, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
}
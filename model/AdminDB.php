<?php

require_once 'model/AbstractDB.php';

class StoreDB extends AbstractDB {
    public static function getAdminID($email, $password) {
        $db = DB::getInstance();

        $statement = $db->prepare("SELECT id_admin FROM Administrator
            WHERE Enaslov=:email AND Geslo=:geslo");
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":geslo", $password, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getAdminData($id) {
        $db = DB::getInstance();

        $statement = $db->prepare("SELECT * FROM Administrator
            WHERE id_admin=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getSellerID($email, $password) {
        $db = DB::getInstance();

        $statement = $db->prepare("SELECT id_prodajalec FROM Prodajalec
            WHERE Enaslov=:email AND Geslo=:geslo");
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":geslo", $password, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getSellerData($id) {
        $db = DB::getInstance();

        $statement = $db->prepare("SELECT * FROM Prodajalec
            WHERE id_prodajalec=:id");
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

    public static function updateAdmin($id, $ime, $priimek, $email) {
        $db = DB::getInstance();

        $statement = $db->prepare("UPDATE Administrator SET Ime=:ime, Priimek=:priimek, Enaslov=:email
            WHERE id_admin=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":ime", $ime, PDO::PARAM_STR);
        $statement->bindParam(":priimek", $priimek, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
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

    public static function insertSeller($ime, $priimek, $email, $geslo) {
        $db = DB::getInstance();

        $statement = $db->prepare("INSERT INTO Prodajalec (Ime, Priimek, Enaslov, Geslo)
            VALUES (:ime, :priimek, :email, :geslo)");
        $statement->bindParam(":ime", $ime, PDO::PARAM_STR);
        $statement->bindParam(":priimek", $priimek, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":geslo", $geslo, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public static function updateSeller($id, $ime, $priimek, $email, $geslo) {
        $db = DB::getInstance();

        $statement = $db->prepare("UPDATE Prodajalec SET Ime=:ime, Priimek=:priimek, Enaslov=:email, Geslo=:geslo
            WHERE id_prodajalec=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":ime", $ime, PDO::PARAM_STR);
        $statement->bindParam(":priimek", $priimek, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":geslo", $geslo, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public static function activateSeller($id, $updatestatus) {
        $db = DB::getInstance();

        $statement = $db->prepare("UPDATE Prodajalec
           SET Aktiviran=:newstatus WHERE id_prodajalec=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":newstatus", $updatestatus, PDO::PARAM_BOOL);
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
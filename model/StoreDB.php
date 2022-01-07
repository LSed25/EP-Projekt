<?php

require_once 'model/AbstractDB.php';

class StoreDB extends AbstractDB {
    
    public static function get(array $id) {
        $knjige = parent::query("SELECT id, Avtor, Naslov, Leto_izdaje, Cena"
                        . " FROM Produkt"
                        . " WHERE id = :id", $id);

        if (count($knjige) == 1) {
            return $knjige[0];
        } else {
            throw new InvalidArgumentException("Knjiga ne obstaja");
        }
    }
    
    public static function insertCustomer(array $params) {
        return parent::modify("INSERT INTO Stranka (Ime, Priimek, Enaslov, Geslo, Ulica, Hisna_st, Posta, Postna_st) "
                        . " VALUES (:firstname, :lastname, :email, :password, :ulica, :hisnast, :posta, :postnast)", $params);
    }

    public static function getCustomerID($email, $password) {
        $db = DB::getInstance();

        $statement = $db->prepare("SELECT id FROM Stranka
            WHERE Enaslov=:email AND Geslo=:geslo");
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":geslo", $password, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getPassword($id) {
        $db = DB::getInstance();

        $statement = $db->prepare("SELECT Geslo FROM Stranka
            WHERE id=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function changePassword($id, $newpassword) {
        $db = DB::getInstance();

        $statement = $db->prepare("UPDATE Stranka
           SET Geslo=:newpassword WHERE id=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":newpassword", $newpassword, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getAllBooks() {
        return parent::query("SELECT id, Avtor, Naslov, Leto_izdaje, Cena"
                        . " FROM Produkt"
                        . " ORDER BY id ASC");
    }
    
    public static function insertArticle(array $params) {}

    public static function update(array $params) {}

    public static function delete(array $id) {}
    
}
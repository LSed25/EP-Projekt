<?php

require_once 'model/AbstractDB.php';
require_once 'model/DB.php';

class AdminDB extends AbstractDB {
    
    
    // ----------------
    // ADMINDB FUNKCIJE
    // ----------------
    
    
    public static function getAdminID($email) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id_admin FROM Administrator
            WHERE Enaslov=:email");
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getAdminData($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Administrator
            WHERE id_admin=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getSellerID($email) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id_prodajalec FROM Prodajalec
            WHERE Enaslov=:email");
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getSellerData($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Prodajalec
            WHERE id_prodajalec=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getAdminPassword($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT Geslo FROM Administrator
            WHERE id_admin=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function changeAdminPassword($id, $newpassword) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE Administrator
           SET Geslo=:newpassword WHERE id_admin=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":newpassword", $newpassword, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function updateAdmin($id, $ime, $priimek, $email) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE Administrator SET Ime=:ime, Priimek=:priimek, Enaslov=:email
            WHERE id_admin=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":ime", $ime, PDO::PARAM_STR);
        $statement->bindParam(":priimek", $priimek, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function getSellerPassword($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT Geslo FROM Prodajalec
            WHERE id_prodajalec=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function insertSeller($ime, $priimek, $email, $geslo) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO Prodajalec (Ime, Priimek, Enaslov, Geslo)
            VALUES (:ime, :priimek, :email, :geslo)");
        $statement->bindParam(":ime", $ime, PDO::PARAM_STR);
        $statement->bindParam(":priimek", $priimek, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":geslo", $geslo, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function updateSeller($id, $ime, $priimek, $email) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE Prodajalec SET Ime=:ime, Priimek=:priimek, Enaslov=:email
            WHERE id_prodajalec=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":ime", $ime, PDO::PARAM_STR);
        $statement->bindParam(":priimek", $priimek, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function activateSeller($id, $updatestatus) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE Prodajalec
           SET Aktiviran=:newstatus WHERE id_prodajalec=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":newstatus", $updatestatus, PDO::PARAM_BOOL);
        $statement->execute();
    }

    public static function changeSellerPassword($id, $newpassword) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE Prodajalec
           SET Geslo=:newpassword WHERE id_prodajalec=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":newpassword", $newpassword, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function getProductData($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Produkt
            WHERE id=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function insertProduct($avtor, $naslov, $leto_izdaje, $cena) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO Produkt (Avtor, Naslov, Leto_izdaje, Cena)
            VALUES (:avtor, :naslov, :leto, :cena)");
        $statement->bindParam(":avtor", $avtor, PDO::PARAM_STR);
        $statement->bindParam(":naslov", $naslov, PDO::PARAM_STR);
        $statement->bindParam(":leto", $leto_izdaje, PDO::PARAM_INT);
        $statement->bindParam(":cena", $cena, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function updateProduct($id, $avtor, $naslov, $leto_izdaje, $cena) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE Produkt SET Avtor=:avtor, Naslov=:naslov, Leto_izdaje=:leto, Cena=:cena
            WHERE id=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":avtor", $avtor, PDO::PARAM_STR);
        $statement->bindParam(":naslov", $naslov, PDO::PARAM_STR);
        $statement->bindParam(":leto", $leto_izdaje, PDO::PARAM_INT);
        $statement->bindParam(":cena", $cena, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function activateProduct($id, $updatestatus) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE Produkt
           SET Aktiviran=:newstatus WHERE id=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":newstatus", $updatestatus, PDO::PARAM_BOOL);
        $statement->execute();
    }

    public static function addCustomer($ime, $priimek, $email, $geslo, $ulica, $hisna, $posta, $postna) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO Stranka (Ime, Priimek, Enaslov, Geslo, Ulica, Hisna_st, Posta, Postna_st)
            VALUES (:ime, :priimek, :email, :geslo, :ulica, :hisna, :posta, :postna)");
        $statement->bindParam(":ime", $ime, PDO::PARAM_STR);
        $statement->bindParam(":priimek", $priimek, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":geslo", $geslo, PDO::PARAM_STR);
        $statement->bindParam(":ulica", $ulica, PDO::PARAM_STR);
        $statement->bindParam(":hisna", $hisna, PDO::PARAM_INT);
        $statement->bindParam(":posta", $posta, PDO::PARAM_STR);
        $statement->bindParam(":postna", $postna, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function updateCustomer($id, $ime, $priimek, $email, $ulica, $hisna, $posta, $postna) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE Stranka SET Ime=:ime, Priimek=:priimek, Enaslov=:email, Ulica=:ulica,
        Hisna_st=:hisna, Posta=:posta, Postna_st=:postna WHERE id=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":ime", $ime, PDO::PARAM_STR);
        $statement->bindParam(":priimek", $priimek, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":ulica", $ulica, PDO::PARAM_STR);
        $statement->bindParam(":hisna", $hisna, PDO::PARAM_INT);
        $statement->bindParam(":posta", $posta, PDO::PARAM_STR);
        $statement->bindParam(":postna", $postna, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function activateCustomer($id, $updatestatus) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE Stranka
           SET Aktiviran=:newstatus WHERE id=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":newstatus", $updatestatus, PDO::PARAM_BOOL);
        $statement->execute();
    }

    public static function getOrders() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Narocilo ORDER BY Datum DESC");
        $statement->execute();

        return $statement->fetchAll();
    }
    
    
    
    
    // ----------------
    // STOREDB FUNKCIJE
    // ----------------
    
    
    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT id, Avtor, Naslov, Leto_izdaje, Cena, "
                        . "          CONCAT(:prefix, id) as uri "
                        . "FROM Produkt "
                        . "ORDER BY id ASC", $prefix);
    }
    
    public static function emptyCart(array $id) {
        return parent::modify("DELETE FROM Kosarica WHERE id_strankakosarica = :id", $id);
    }
    
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
    
    public static function update(array $params) {
        return parent::modify("UPDATE Stranka SET Ime = :firstname, Priimek = :lastname, "
                        . "Enaslov = :email, Geslo = :password, Ulica = :ulica, Hisna_st = :hisnast, "
                        . "Posta = :posta, POstna_st = :postnast"
                        . " WHERE id = :id", $params);
    }
    
    public static function buy(array $params) {
        return parent::modify("INSERT INTO Produkt_kosarica (id_produkt, Kolicina, Cena) "
                        . " VALUES (:id_produkt, :kolicina, :cena)", $params);
    }
    
    public static function buyEdit(array $params) {
        return parent::modify("UPDATE Produkt_kosarica SET Kolicina = :amount, Cena = :cena "
                        . " WHERE id_pk = :id", $params);
    }
    
    public static function buyDelete(array $id) {
        return parent::modify("DELETE FROM Kosarica WHERE id_kosarica = :id", $id);
    }
    
    public static function pridobiPKID() {
        $id = parent::query("SELECT LAST_INSERT_ID()");

        if (count($id) == 1) {
            return $id[0];
        } else {
            throw new InvalidArgumentException("ID ne obstaja");
        }
    }
    
    public static function pridobiPK(array $id) {
        $pk = parent::query("SELECT id_pk, Cena"
                        . " FROM Produkt_kosarica"
                        . " WHERE id_pk = :id_pk", $id);

        if (count($pk) == 1) {
            return $pk[0];
        } else {
            throw new InvalidArgumentException("PK ne obstaja");
        }
    }
    
    public static function pridobiPKA(array $id) {
        $pk = parent::query("SELECT id_pk, id_produkt, Cena, Kolicina"
                        . " FROM Produkt_kosarica"
                        . " WHERE id_pk = :id_pk", $id);

        if (count($pk) == 1) {
            return $pk[0];
        } else {
            throw new InvalidArgumentException("PK ne obstaja");
        }
    }
    
    public static function cartSubmit(array $params) {
        return parent::modify("INSERT INTO Narocilo (id_stranka, Cena) "
                        . " VALUES (:id_stranka, :cena)", $params);
    }
    
    public static function addToCart(array $params) {
        return parent::modify("INSERT INTO Kosarica (id_artikel, id_strankakosarica, Cena) "
                        . " VALUES (:id_pk, {$_SESSION['id']['id']}, :Cena)", $params);
    }
    
    public static function getUser(array $id) {
        $uporabnik = parent::query("SELECT id, Ime, Priimek, Enaslov, Geslo, Ulica, Hisna_st, Posta, Postna_st"
                        . " FROM Stranka"
                        . " WHERE id = :id", $id);

        if (count($uporabnik) == 1) {
            return $uporabnik[0];
        } else {
            throw new InvalidArgumentException("Uporabnik ne obstaja");
        }
    }
    
    public static function getCartUser(array $id) {
        return parent::query("SELECT *"
                        . " FROM Kosarica"
                        . " WHERE id_strankakosarica = :id", $id);
    }
    
    public static function insertCustomer(array $params) {
        return parent::modify("INSERT INTO Stranka (Ime, Priimek, Enaslov, Geslo, Ulica, Hisna_st, Posta, Postna_st) "
                        . " VALUES (:firstname, :lastname, :email, :password, :ulica, :hisnast, :posta, :postnast)", $params);
    }

    public static function getCustomerID($email) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id FROM Stranka
            WHERE Enaslov=:email");
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getCustomerData($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Stranka
            WHERE id=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getPassword($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT Geslo FROM Stranka
            WHERE id=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function changePassword($id, $newpassword) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE Stranka
           SET Geslo=:newpassword WHERE id=:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":newpassword", $newpassword, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function getAllBooks() {
        return parent::query("SELECT id, Avtor, Naslov, Leto_izdaje, Cena"
                        . " FROM Produkt"
                        . " ORDER BY id ASC");
    }
    
    public static function insertArticle(array $params) {}

    public static function delete(array $id) {}
}
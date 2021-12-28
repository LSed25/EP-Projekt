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
    
    public static function getAllBooks() {
        return parent::query("SELECT id, Avtor, Naslov, Leto_izdaje, Cena"
                        . " FROM Produkt"
                        . " ORDER BY id ASC");
    }
    
    public static function insertArticle(array $params) {}

    public static function update(array $params) {}

    public static function delete(array $id) {}
    
}
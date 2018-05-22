<?php

class dataBase {

    //L'attribut $db sera disponible dans ses enfants
    protected $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=HospitalE2N;charset=utf8', 'usr_HospitalE2n', 'HospitalE2n');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->db = NULL;
    }

}

?>
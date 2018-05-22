<?php

class appointments extends dataBase {

    public $id;
    public $dateHour;
    public $idPatients;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Fonction qui perrmet de rentrer un rendez vous dans la base
     * @return 
     */
    public function addAppointment() {
        $query = $this->db->prepare('INSERT INTO `appointments` (`dateHour`, `idPatients`) VALUES (:dateHour, :idPatients)');
        $query->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $query->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return $query->execute();
    }

    /**
     * Permet de savoir si l'heure et la date demandé dans le formulaire
     * est bien disponible.
     * @return boolean
     */
    
    public function checkFreeAppointment() {
        $query = 'SELECT COUNT(*) AS `takenAppointment` FROM `appointments` WHERE `dateHour` = :dateHour AND `idPatients` = :idPatients';
        $freeAppointment = $this->db->prepare($query);
        $freeAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $freeAppointment->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        if ($freeAppointment->execute()){
            $freeAppointmentCheck = $freeAppointment->fetch(PDO::FETCH_OBJ);
        } else {
            $freeAppointmentCheck = false;
        }
        return $freeAppointmentCheck;
    }

}
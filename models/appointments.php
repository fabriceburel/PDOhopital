<?php

class appointments extends dataBase {

    public $id;
    public $dateHour;
    public $idPatients;
    public $date;
    public $hour;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fonction qui perrmet de rentrer un rendez vous dans la base
     * @return 
     */
    public function addAppointment()
    {
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
    public function checkFreeAppointment()
    {
        $query = 'SELECT COUNT(*) AS `takenAppointment` FROM `appointments` WHERE `dateHour` = :dateHour AND `idPatients` = :idPatients';
        $freeAppointment = $this->db->prepare($query);
        $freeAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $freeAppointment->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        if ($freeAppointment->execute())
        {
            $freeAppointmentCheck = $freeAppointment->fetch(PDO::FETCH_OBJ);
        }
        else
        {
            $freeAppointmentCheck = false;
        }
        return $freeAppointmentCheck;
    }

    public function getAppointmentsList()
    {
        $appointmentsList = array();
        //On prépare la requête sql qui insert les champs sélectionnés, les valeurs de type :lastname sont des marqueurs nominatifs
        $query = 'SELECT `appointments`.`id`, DATE_FORMAT(`dateHour`, "%d/%m/%Y") AS `date`, DATE_FORMAT(`dateHour`, "%H:%i") AS `hour`, `patients`.`lastname`, `patients`.`firstname` FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` ORDER BY `patients`.`lastname`;';
        $appointmentsListResult = $this->db->query($query);
        //Si l'insertion s'est correctement déroulée, on retourne true car execute() est un booléen
        if (is_object($appointmentsListResult))
        {
            $appointmentsList = $appointmentsListResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $appointmentsList;
    }

    public function getAppointmentById()
    {
        $query = 'SELECT DATE_FORMAT(`dateHour`, "%Y-%m-%d") AS `date`, DATE_FORMAT(`dateHour`, "%H:%i") AS `hour`, `idPatients` FROM `appointments` WHERE `id` = :id';
        $appointmentResult = $this->db->prepare($query);
        $appointmentResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $appointmentResult->execute();
        return $appointmentResult->fetch(PDO::FETCH_OBJ);
    }

    public function updateAppointments()
    {
        $query = 'UPDATE `appointments` SET DATE_FORMAT(`dateHour`, "%d/%m/%Y") AS `date` = :date, DATE_FORMAT(`dateHour`, "%H:%i") AS `hour` = :hour WHERE `id` = :id';
        $appointmentsResult = $this->db->prepare($query);
        $appointmentsResult->bindValue(':date', $this->date, PDO::PARAM_STR);
        $appointmentsResult->bindValue(':hour', $this->hour, PDO::PARAM_STR);
        $appointmentsResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $appointmentsResult->execute();
    }

}

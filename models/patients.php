<?php

class patients extends dataBase {

    public $id = 0;
    public $lastname = '';
    public $firstname = '';
    public $birthdate = '01/01/1900';
    public $phone = '0000000000';
    public $mail = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function addPatient()
    {
        //On prépare la requête sql qui insert dans les champs selectionnés, les valeurs sont des marqueurs nominatifs
        $query = 'INSERT INTO `patients`(`lastname`, `firstname`, `birthdate`, `phone`, `mail`) VALUES(:lastname, :firstName, :birthdate, :phone, :mail)';
        $responseRequest = $this->db->prepare($query);
        $responseRequest->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $responseRequest->bindValue(':firstName', $this->firstName, PDO::PARAM_STR);
        $responseRequest->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $responseRequest->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $responseRequest->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        //Si l'insertion s'est correctement déroulée on retourne vrai
        return $responseRequest->execute();
    }

    public function getPatientList()
    {
        $patientList = array();
        $query = 'SELECT `id`, `lastname`, `firstname`, `birthdate`, `phone`, `mail` FROM `patients`';
        $patientResult = $this->db->query($query);
        if (is_object($patientResult))
        {
            $patientList = $patientResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $patientList;
    }

    public function getPatientById()
    {
        $isCorrect = false;
        $query = 'SELECT `id`, `lastname`, `firstname`, `birthdate`, `phone`, `mail` FROM `patients` WHERE `id` = :id';
        $patientResult = $this->db->prepare($query);
        $patientResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($patientResult->execute())
        {
            $patientInfo = $patientResult->fetch(PDO::FETCH_OBJ);
            if (is_object($patientInfo))
            {
                $this->lastname = $patientInfo->lastname;
                $this->firstname = $patientInfo->firstname;
                $this->birthdate = $patientInfo->birthdate;
                $this->phone = $patientInfo->phone;
                $this->mail = $patientInfo->mail;
                $isCorrect = true;
            }
        }
        return $isCorrect;
    }

    public function updatePatient()
    {
        $query = 'UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate,  `phone` = :phone, `mail` = :mail WHERE `id` = :id';
        $updatePatient = $this->db->prepare($query);
        $updatePatient->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $updatePatient->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $updatePatient->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $updatePatient->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $updatePatient->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $updatePatient->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $updatePatient->execute();
    }
    /**
     * Cette fonction permet de récupérer la liste de patient en fonction d'un offset récupérer dans le controller
     */
    public function getPatientListPagination($offset)
    {
        $query = 'SELECT `id`, `lastname`, `firstname`, `birthdate`, `phone`, `mail` FROM `patients` LIMIT 5 OFFSET :offset';
        $patientResult = $this->db->prepare($query);
        $patientResult->bindValue(':offset', $offset, PDO::PARAM_INT);
        if ($patientResult->execute())
        {
                $patientList = $patientResult->fetchAll(PDO::FETCH_OBJ);
        }else{
            $patientList = false;
        }
        return $patientList;
    }
    /**
     * Cette fonction permet de récupérer le nombre de patient
     */
    Public function countPatient()
    {
        $query = 'SELECT COUNT(`id`) AS `numberPatient` FROM `patients`';
        $patientCount = $this->db->query($query);
        $patientCountResult = $patientCount->fetch(PDO::FETCH_OBJ);
        return $patientCountResult;
    }
    
    public function __destruct()
    {
        
    }

}

?>
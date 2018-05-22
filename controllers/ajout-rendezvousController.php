<?php
//On instancie un nouveau patient
$patient = new patients();
$patientsList = $patient->getPatientList();
$regexDate = '/([0-9]{4})\-(([0]{1}[0-9]{1})|([1]{1}[0-2]{1}))\-(([0-2]{1}[0-9]{1})|([3]{1}[0-1]))/';
$regexTime = '/(([0-1]{1}[0-9]{1})|([2]{1}[0-3]{1}))\:([0-5]{1}[0-9]{1})/';
$errors = array();

if (isset($_POST['submit'])) {
    //On instancie un nouveau RDV
    $appointment = new appointments();
    if (empty($_POST['appointmentDate']) || !preg_match($regexDate, $_POST['appointmentDate'])) {
        $errors['date'] = 'La date n\'est pas valide';
    }
    if (empty($_POST['appointmentTime']) || !preg_match($regexTime, $_POST['appointmentTime'])) {
        $errors['time'] = 'L\'heure n\'est pas valide';
    }
    if (!empty($_POST['appointmentPatient'])) {
        //Si l'id du patient est un nombre
        if (is_nan($_POST['appointmentPatient'])) {
            $errors['idPatient'] = 'La valeur du patient est incorrect';
        } else {
            $appointment->idPatients = $_POST['appointmentPatient'];
        }
    } else {
        $errors['appointmentPatient'] = 'Veuillez renseigner un patient';
    }
    //Si le tableau d'erreur est vide
    if (count($errors) == 0) {
        //On concatène la date et l'heure pour être correct dans la table
        $appointment->dateHour = $_POST['appointmentDate'] . ' ' . $_POST['appointmentTime'];
        //On vérifie la disponibilité du rendez-vous par la méthode checkFreeAppointment
        $checkAppointment = $appointment->checkFreeAppointment();
        //On vérifie que la requête s'est bien exécutée.
        if(!is_object($checkAppointment)){
            $errors['checkAppointment'] = 'Veuillez contacter le support technique';
        }else{
            //Si le return renvoie un false, on averti le patient que le rendez vous n'est pas dispo
            if ($checkAppointment->takenAppointment){
                $errors['takenAppointment'] = 'Ce créneau horaire n\'est pas disponible.';
            } else {
                $appointment->addAppointment();
                $errors['appointmentTaken'] = 'Votre rendez-vous a bien été enregistré.';
            }
        }
    }
}

<?php

$appointments = new appointments();
$patients = new patients();
$errors = array();

$patientsList = $patients->getPatientList();

if (isset($_GET['appointmentId'])) {
    $appointments->id = $_GET['appointmentId'];
    $appointmentDetails = $appointments->getAppointmentById();
}



if (!empty($_POST['date']) && !empty($_POST['hour'])) {
    $appointments->dateHour = ($_POST['date']) . ' ' . ($_POST['hour']);
} else {
    $errors['dateHour'] = 'Veuillez remplir la date et l\'heure du rendez-vous.';
}


if (isset($_POST['submit']) && count($errors) == 0) {
    echo 'ok';
    $appointments->updateAppointments();
}
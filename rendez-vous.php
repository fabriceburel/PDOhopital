<?php
include_once 'models/dataBase.php';
include_once 'models/appointments.php';
include_once 'models/patients.php';
include_once 'controllers/rendezvousController.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <link href="assets/style.css" rel="stylesheet" type="text/css"/>
        <title>Rendez-vous</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">        
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <?php include_once 'header.php'; ?>
    <h1>Informations du rendez-vous</h1>
    <form action="rendez-vous.php?appointmentId=<?= $_GET['appointmentId'] ?>" method="post">
        <h2>Date du rendez-vous : </h2>
        <input type="date" name="date" value="<?= $appointmentDetails->date ?>" />
        <h2>Heure du rendez-vous : </h2>
        <input type="time" name="hour" value="<?= $appointmentDetails->hour ?>" />
        <h2>Patient correspondant : </h2>
        <select name="idPatients" style="color: black">
            <?php
            foreach ($patientsList as $patients)
            {
                ?>
                <option value="<?= $patients->id ?>" <?= $patients->id == $appointmentDetails->idPatients ? 'selected' : '' ?>><?= $patients->lastname . ' ' . $patients->firstname ?></option>  
            <?php } ?>
        </select>
        <input type="submit" name="submit" value="Enregistrer les modifications" />
        <!-- <p>Le rendez-vous n'a pas été trouver</p> -->
    </form>
    <?php include 'footer.php'; ?>
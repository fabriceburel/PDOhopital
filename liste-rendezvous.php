<?php
include_once 'models/dataBase.php';
include_once 'models/appointments.php';
include_once 'controllers/liste-rendezvousController.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <link href="assets/style.css" rel="stylesheet" type="text/css"/>
        <title>Ajout-Patient</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">        
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <?php include 'header.php'; ?>
    <table border="2" class="rdvList table table-hover">
        <thead>
            <tr>
                <th>Patients</th>
                <th>Date du RDV</th>
                <th>Heure du RDV</th>
                <th>Modifier le RDV</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($appointmentsList as $appointment)
            { ?>
                <tr>
                    <td><?= $appointment->lastname . ' ' . $appointment->firstname; ?></td>
                    <td><?= $appointment->date; ?></td>
                    <td><?= $appointment->hour; ?></td>
                    <td><a class="btn btn-secondary" href="rendez-vous.php?appointmentId=<?= $appointment->id; ?>">Voir / Modifier ce RDV</a></td>
                </tr>
<?php } ?>
        </tbody>
    </table>

    <?php include 'footer.php'; ?>

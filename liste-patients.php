<?php
include 'models/dataBase.php';
include 'models/patients.php';
include 'controllers/liste-patientController.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>List-patient</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">        
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <?php
    include 'header.php';
    if (!$patientList)
    {
        ?>
        <p>Erreur serveur: Veuillez contacter l'administrateur!</p>
        <?php
    }
    else
    {
        ?>

        <table class="striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Numéro Tel</th>
                    <th>Mail</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($patientList as $patient)
                {
                    ?>
                    <tr>
                        <td><?= $patient->lastname ?></td>
                        <td><?= $patient->firstname ?></td>
                        <td><?= $patient->birthdate ?></td>
                        <td><?= $patient->phone ?></td>
                        <td><?= $patient->mail ?></td>
                        <td><a href="profil-patient.php?patientId=<?= $patient->id ?>" class="btn">voir</a></td>
                    </tr>
    <?php } ?>
            </tbody>
        </table>
        <a class="btn" href="liste-patients.php?page=<?= $page - 1 ?>" <?= $start <= 1 ? 'disabled' : '' ?>>Précédente</a>
        <?php
        for ($pageNumber = 1; $pageNumber <= $maxPagination; $pageNumber++)
        {
            ?>   <a href="liste-patients.php?page=<?= $pageNumber ?>" class="btn" <?= $page == $pageNumber?'disabled' : '' ?>><?= $pageNumber ?></a>
        <?php } ?>
        <a class="btn" href="liste-patients.php?page=<?= $page + 1 ?>" <?= $start >= $maxPagination ? 'disabled' : '' ?>>Suivante</a>
        <?php
    }
    include 'footer.php';
    ?>

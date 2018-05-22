<?php
include_once 'models/dataBase.php';
include_once 'models/patients.php';
include_once 'controllers/profil-patientController.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Profil patient</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">        
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <?php include 'header.php'; ?>
    <?php if ($isFind)
    { ?>
        <h1>Profil de : <?= $patient->lastname ?> <?= $patient->firstname ?></h1>
        <?php foreach ($errors as $error)
        { ?>
            <p><?= $error ?></p>
    <?php } ?>
        <form action="profile-patient.php?patientId=<?= $_GET['patientId'] ?>" method="POST" class="form">
            <label for="lastname">Nom : </label><input type="text" value="<?= $patient->lastname ?>" name="lastname" />
            <label for="firstname">Prénom : </label><input type="text" value="<?= $patient->firstname ?>" name="firstname" />
            <label for="birthdate">Date de naissance : </label><input type="date" value="<?= $patient->birthdate ?>" name="birthdate" />
            <label for="phone">Numéro de téléphone : </label><input type="text" value="<?= $patient->phone ?>" name="phone" />
            <label for="mail">Mail : </label><input type="text" value="<?= $patient->mail ?>" name="mail" />
            <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
        </form>
    <?php }
    else
    { ?>
        <p>Le patient n'a pas été trouvé.</p>
<?php } ?>
<?php include 'footer.php'; ?>
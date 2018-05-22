<?php
include 'models/dataBase.php';
include 'models/patients.php';
include 'controllers/ajout-patientController.php';
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
        <p><a href="index.php">Accueil</a></p>
        <div>
            <?php foreach ($formError as $Error) { ?>
                <p><?= $Error ?></p>
            <?php } ?>
        </div>
        <form action="#" method="POST">
            <p><label for="lastname" class="<?= isset($formError['lastname']) ? 'inputError' : '' ?>">Nom : </label><input type="text" name="lastname" value="<?= $patients->lastname ?>" /></p>
            <p><label for="firstname" class="<?= isset($formError['firstname']) ? 'inputError' : '' ?>">Prénom : </label><input type="text" name="firstname" value="<?= $patients->firstname ?>" /></p>
            <p><label for="birthdate" class="<?= isset($formError['birthdate']) ? 'inputError' : '' ?>">Date de naissance : </label><input type="date" name="birthdate" value="<?= $patients->birthdate ?>" /></p>
            <p><label for="phone" class="<?= isset($formError['phone']) ? 'inputError' : '' ?>">Numéro de tel : </label><input type="text" name="phone" value="<?= $patients->phone ?>" /></p>
            <p><label for="mail" class="<?= isset($formError['mail']) ? 'inputError' : '' ?>">Adresse mail : </label><input type="text" name="mail" value="<?= $patients->mail ?>" /></p>
            <p><input name="submit" type="submit" value="Valider" /></p>
        </form>
        <p class="formValid">
            <?php
            if($insertSuccess){
                echo 'Envoi réussi';
            }
            ?>
        </p>
<?php include 'footer.php'; ?>

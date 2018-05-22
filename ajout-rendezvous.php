<?php
include 'models/dataBase.php';
include 'models/patients.php';
include_once 'models/appointments.php';
include 'controllers/ajout-patientController.php';
include_once 'controllers/ajout-rendezvousController.php';
?>
<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <title>Ajout de rendez-vous</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">        
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="style.css" />
    </head>
    <?php include 'header.php'; ?>
    <body>
        <h1>Ajoutez un rendez-vous</h1>
        <?php
        foreach ($errors as $error){
            echo $error;
        }
        ?>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="appointmentDate">Date du rendez-vous*</label>
                <input type="date" class="form-control" name="appointmentDate" />
            </div>
            <div class="form-group">
                <label for="appointmentTime">Heure du rendez-vous*</label>
                <input type="time" class="form-control" name="appointmentTime" />
            </div>
            <div class="form-group">
                <label for="appointmentPatient">Patient à prendre en charge*</label>
                <select class="form-control" name="appointmentPatient">
                    <option>Sélectionnez un patient</option>
                    <?php foreach ($patientsList as $patient) { ?> 
                    <option value="<?= $patient->id ?>"><?= $patient->lastname . ', ' . $patient->firstname ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Enregistrer le rendez-vous</button>
        </form>
<?php include 'footer.php'; ?>
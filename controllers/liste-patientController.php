<?php
//par défaut première page
$page = 1;
//on limite l'affichage à 5 patients
$limit = 5;
$patient = new patients();
if(!empty($_GET['page']))
{
    $page = $_GET['page']; 
}
//Permet de calculer le offset en fonction de la page sélectionné
$start = ($page - 1) * $limit;
//appel de la méthode getPatientListPagination
$patientList = $patient->getPatientListPagination($start);
//appel de la méthode countPatient
$patientCount = $patient->countPatient();
$maxPagination = ceil($patientCount->numberPatient/$limit);
?>
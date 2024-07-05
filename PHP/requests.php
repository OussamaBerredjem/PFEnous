<?php

include_once("connection.php");
include_once("gestions.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Modifier les informations de connexion pour se connecter à la base de données Sonatrach
$connection = new Connection('localhost', 'pfe', 'root', '');
$pdo = $connection->connect();
$gestion = new Gestion($pdo);

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['matricule']) && isset($_POST['codeS']) && isset($_POST['dateN']) && isset($_POST['dateR']) && isset($_POST['numero'])&&isset($_POST['fonction']) &&isset($_POST['email']) &&isset($_POST['direction'])  ) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $matricule = $_POST['matricule'];
    $codeS = $_POST['codeS'];
    $dateN = $_POST['dateN'];
    $dateR = $_POST['dateR'];
    $numero = $_POST['numero'];
    $fonct = $_POST['fonction'];
    $email = $_POST['email'];
    $direction = $_POST['direction'];

    // Utiliser des requêtes SQL adaptées à la structure de la base de données Sonatrach
   
    $gestion->ajouter_employee($nom, $prenom, $matricule, $codeS, $dateN, $dateR, $numero,$fonct,$email,$direction);

    echo "add success";
}

if(isset($_GET['employee'])){
   
    $result = $gestion->get_employee();
    echo json_encode($result);
}


if(isset($_POST["nom"]) && isset($_POST['prenom']) && isset($_POST['matricule']) && 
   isset($_POST['code_structure']) && isset($_POST['numero_compte']) && 
   isset($_POST['date_naissance']) && isset($_POST['date_recrutement']) && 
   isset($_POST['emp_id']) && isset($_POST['fonction']) && 
   isset($_POST['email']) &&isset($_POST['direction']) && isset($_POST['edit'])) {

    $gestion->modifier_employee(
        $_POST["nom"], 
        $_POST['prenom'], 
        $_POST['code_structure'], 
        $_POST['numero_compte'], 
        $_POST['date_naissance'], 
        $_POST['date_recrutement'], 
        $_POST['matricule'], 
        $_POST['emp_id'], 
        $_POST['fonction'], 
        $_POST['email'], 
        $_POST['direction'] // Assuming this is correct
    );

    }

if(isset($_GET['id'])&&isset($_GET['pdf'])){
    $gestion->generatePDF($_GET['id']);

}

if(isset($_GET['medailles']) && isset($_GET['to'])){
    $gestion->togetMedialles();
}

if(isset($_GET['profile'])&&isset($_GET['emp_id'])){
    $result = $gestion->get_profile($_GET['emp_id']);
    echo json_encode($result);
}

if(isset($_GET['delete'])&&isset($_GET['id'])){
    $gestion->delete_employee($_GET['id']);
}

if(isset($_POST['matricule'])&&isset($_POST['types'])&&isset($_POST['validable'])&&isset($_POST['date_debut'])&&isset($_POST['date_fin'])){
    $gestion->ajouter_conges($_POST['matricule'],$_POST['types'],$_POST['validable'],$_POST['date_debut'],$_POST['date_fin']);
   
}

if(isset($_GET['conges'])&&isset($_GET['all'])){
    $result = $gestion->get_conges_all();
    echo json_encode($result);
}

if(isset($_GET['list'])){
    $result = $gestion->get_list();
    
    echo json_encode($result);
}

if(isset($_GET['occasion'])){
    $result = $gestion->getOccasion("".$_GET['occasion']);
    echo json_encode($result);
}

if(isset($_GET['medaille'])){
    $result = $gestion->getMedailles("".$_GET['medaille']);
    echo json_encode($result);
}

if(isset($_GET['archive'])){
    $result = $gestion->Archiver($_GET['archive']);
    echo $result;
}
if(isset($_GET['disarchive'])){
    $result = $gestion->Disarchiver($_GET['disarchive']);
    echo $result;
}

if(isset($_GET['password'])&&isset($_GET['id'])){
    $gestion->updatePassword($_GET['id'],$_GET['password']);
}

if(isset($_GET['email'])&&isset($_GET["reset"])){
    $result = $gestion->getLoginIdByEmail($_GET['email']);
    echo json_encode($result);
}

if(isset($_GET['password'])&&isset($_GET['email'])&&isset($_GET['log'])){
    $result = $gestion->loginn($_GET['email'],$_GET['password']);
    echo json_encode($result);
}


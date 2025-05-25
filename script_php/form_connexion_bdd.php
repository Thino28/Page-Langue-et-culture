<?php 
    session_start();
    include("cnx_utilisateur.inc.php");
    $mail = $_POST["mail"];
    $mdp = $_POST["mdp"];
    $result = $cnx -> query("SELECT num_parti,prenom,nom,titre_pro,titre_conf FROM vdeux.participant WHERE mail='$mail' and mdp='$mdp'");
    if ($result) {
        $ligne = $result -> fetch(PDO::FETCH_ASSOC);
        $_SESSION['prenom'] = $ligne['prenom'];
        $_SESSION['nom'] = $ligne['nom'];
        $_SESSION['id'] = $ligne['num_parti'];
        $_SESSION['pro'] = $ligne['titre_pro'];
        $_SESSION['conf'] = $ligne['titre_conf'];
        $_SESSION['mail'] = $mail;
        $_SESSION['mdp'] = $mdp;
    } else {
        header('location:..\form_connexion.html');
        exit();
    }
    if ($_SESSION['id']==1 || $_SESSION['id']==2) {
        header('location:..\Admin.php');
        exit();
    }
    if ($_SESSION['conf'] == true) {
        header('location:..\Conferencier_Principal.php');  
        exit();
    }
    header('location:..\Client_Principal.php'); 
    exit();
?>
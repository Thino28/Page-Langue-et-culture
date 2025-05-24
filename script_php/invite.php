<?php 
    session_start();
    $_SESSION["prenom"] = "Visiteur";
    header('Location: ../Client_Principal.php');
    exit();
?>
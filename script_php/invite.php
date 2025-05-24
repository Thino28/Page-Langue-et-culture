<?php 
    session_start();
    $_SESSION["invite"] = true;
    header('Location: ../Client_Principal.php');
    exit();
?>
<?php
    session_start();
    include('cnx_admin.inc.php');
    print_r($_POST);
    $date=$_POST['date'];
    $duree=$_POST['duree'];
    $horaire=$_POST['horaire'];
    $langue=$_POST['langue'];
    $salle=$_POST['salle'];
    $type=$_POST['type'];
    $categorie=$_POST['categorie'];
    $rcourt=$_POST['Resume-court'];
    $rlong=$_POST['Resume-long'];
    $id=$_SESSION['id'];
    try {
        $cnx->beginTransaction();
        $cnx->exec("INSERT INTO vdeux.conference VALUES (DEFAULT, '$type', '$categorie', '$langue','$date', '$horaire', '$duree', '$rcourt', '$rlong', $salle) "); 
        $idconf=$cnx->lastInsertId();
        $cnx->exec("INSERT INTO vdeux.organise VALUES ($idconf, $id) ");
        if (isset($_POST['mail'])) {
            $mail=$_POST['mail'];
            $resultat = $cnx ->query("SELECT num_parti FROM vdeux.participant WHERE mail='$mail'");
            $r=$resultat->fetch(PDO::FETCH_OBJ);
            if ($r) {
                $idparti=$r->num_parti;
                $cnx->exec("INSERT INTO vdeux.organise VALUES ($idconf, $idparti) ");
            } 
        }
        $cnx->commit();
    } catch (PDOException $e) {
        $cnx->rollBack();
        echo "Failed: " . $e;
    }

    header('location:..\Conferencier_Principal.php');
    exit();
?>
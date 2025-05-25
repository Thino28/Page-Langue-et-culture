<?php
    session_start();
    include("cnx_admin.inc.php");
    $cnx->beginTransaction();
    try {
        $salle=$_POST['salle'];
        $idconf=$_POST['idconf'];
        $cnx->exec("UPDATE vdeux.conference SET num_salle = '$salle' WHERE num_conf = '$idconf'");
        if ($_POST['date']!= "") {
            $date = $_POST['date'];
            $cnx->exec("UPDATE vdeux.conference SET date_conf = '$date' WHERE num_conf = '$idconf'");
        }
        if ($_POST['duree']!= "") {
            $duree = $_POST['duree'];
            $cnx->exec("UPDATE vdeux.conference SET duree = '$duree' WHERE num_conf = '$idconf'");
        }
        if ($_POST['horaire']!= "") {
            $horaire = $_POST['horaire'];
            $cnx->exec("UPDATE vdeux.conference SET horaire = '$horaire' WHERE num_conf = '$idconf'");
        }
        if ($_POST['langue']!= "") {
            $langue = $_POST['langue'];
            $cnx->exec("UPDATE vdeux.conference SET langue = '$langue' WHERE num_conf = '$idconf'");
        }
        if ($_POST['type']!= "") {
            $type = $_POST['type'];
            $cnx->exec("UPDATE vdeux.conference SET type_intervention = '$type' WHERE num_conf = '$idconf'");
        }
        if ($_POST['categorie']!= "") {
            $categorie = $_POST['categorie'];
            $cnx->exec("UPDATE vdeux.conference SET categorie_theme = '$categorie' WHERE num_conf = '$idconf'");
        }
        if ($_POST['Resume-court']!= "") {
            $resume_court = $_POST['Resume-court'];
            $cnx->exec("UPDATE vdeux.conference SET resume_court = '$resume_court' WHERE num_conf = '$idconf'");
        }
        if ($_POST['Resume-long']!= "") {
            $resume_long = $_POST['Resume-long'];
            $cnx->exec("UPDATE vdeux.conference SET resume_long = '$resume_long' WHERE num_conf = '$idconf'");
        }
        $cnx->commit();
    } catch (PDOException $e) {
        $cnx->rollBack();
        echo $e;
        exit();
    }
    if ($_SESSION["id"]<3) {
        header("Location: ../Admin_Conference.php");
    } else {
        header("Location: ../Conferencier_Principal.php");
    }

?>

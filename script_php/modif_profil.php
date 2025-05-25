<?php 
    session_start();
    include("cnx_admin.inc.php");
    $cnx->beginTransaction();
    try {
        if ($_POST['nom'] != "") {
            $nom = $_POST['nom'];
            $cnx->exec("UPDATE vdeux.participant SET nom = '$nom' WHERE num_parti = ".$_SESSION['id']);
        }
        if ($_POST['prenom'] != "") {
            $prenom = $_POST['prenom'];
            $cnx->exec("UPDATE vdeux.participant SET prenom = '$prenom' WHERE num_parti = ".$_SESSION['id']);
        }
        if ($_POST['tel'] != "") {
            $tel = $_POST['tel'];
            $cnx->exec("UPDATE vdeux.participant SET tel = '$tel' WHERE num_parti = ".$_SESSION['id']);
        }
        if ($_POST['adresse'] != "") {
            $adresse = $_POST['adresse'];
            $cnx->exec("UPDATE vdeux.participant SET adresse_postale = '$adresse' WHERE num_parti = ".$_SESSION['id']);
        }
        if ($_POST['mail'] != "") {
            $mail = $_POST['mail'];
            $cnx->exec("UPDATE vdeux.participant SET mail = '$mail' WHERE num_parti = ".$_SESSION['id']);
        }
        if ($_POST['naiss'] != "") {
            $naiss = $_POST['naiss'];
            $cnx->exec("UPDATE vdeux.participant SET date_naiss = '$naiss' WHERE num_parti = ".$_SESSION['id']);
        }
        if ($_POST['profession'] != "") {
            $profession = $_POST['profession'];
            $cnx->exec("UPDATE vdeux.participant SET profession = '$profession' WHERE num_parti = ".$_SESSION['id']);
        }
        if ($_POST['mdp'] != "") {
            $mdp = $_POST['mdp'];
            $cnx->exec("UPDATE vdeux.participant SET mdp = '$mdp' WHERE num_parti = ".$_SESSION['id']);
        }
        if ($_SESSION['pro']) {
            if ($_POST['email_pro'] != "") {
                $email_pro = $_POST['email_pro'];
                $cnx->exec("UPDATE vdeux.pro SET email_pro = '$email_pro' WHERE num_parti = ".$_SESSION['id']);
            }
            if ($_POST['tel_pro'] != "") {
                $tel_pro = $_POST['tel_pro'];
                $cnx->exec("UPDATE vdeux.pro SET tel_pro = '$tel_pro' WHERE num_parti = ".$_SESSION['id']);
            }
            if ($_POST['fonction'] != "") {
                $fonction = $_POST['fonction'];
                $cnx->exec("UPDATE vdeux.pro SET fonction = '$fonction' WHERE num_parti = ".$_SESSION['id']);
            }
        }
        if ($_SESSION['conf']) {
            if ($_POST['fonction'] != "") {
                $fonction = $_POST['fonction'];
                $cnx->exec("UPDATE vdeux.conf SET fonction = '$fonction' WHERE num_parti = ".$_SESSION['id']);
            }
            if ($_POST['orga'] != "") {
                $orga = $_POST['orga'];
                $cnx->exec("UPDATE vdeux.participant SET organisme = '$orga' WHERE num_parti = ".$_SESSION['id']);
            }
        }
        $cnx->commit();
    } catch (PDOException $e) {
        $cnx->rollBack();
        echo $e;
        exit();
    }
?>

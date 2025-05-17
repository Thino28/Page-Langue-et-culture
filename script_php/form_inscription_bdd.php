<?php
    session_start();
    include("cnx_utilisateur.inc.php");
    if (((isset($_POST["nom"]) && isset($_POST["prenom"])) && (isset($_POST["naiss"]) && isset($_POST["mail"]))) && (($_POST["nom"]!=null && $_POST["prenom"]!=null) && ($_POST["naiss"]!=null && $_POST["mail"]!=null))){
        if ((isset($_POST["mdp"]) && isset($_POST["mdp2"])) && ($_POST["mdp"] == $_POST["mdp2"])) {
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $mail = $_POST["mail"];
            $tel = $_POST["tel"];
            $date_naissance = $_POST["naiss"];
            $mdp = $_POST["mdp"];
            $mdp2 = $_POST["mdp2"];
            $adresse = $_POST["adresse"];
            $profession = $_POST["profession"];
            $pro = "false";
            $conf = "false";
            if ($_POST["type_inscr"]=="Pro"  && isset($_POST["mailpro"])){
                $pro = "true";
                $fonction = $_POST["fonction"];
                $mailpro = $_POST["mailpro"];
                $telpro = $_POST["telpro"];
            }
            if ($_POST["type_inscr"]=="Conf" ) {
                $conf = "true";
                $fonction_conf = $_POST["fonction_conf"];
                $orga = $_POST["orga"];
            }
            $cnx -> beginTransaction();
            try {
                $cnx -> exec("INSERT INTO vdeux.participant VALUES (DEFAULT,'$nom','$prenom','$mail','$mdp','$tel','$adresse','$profession','$date_naissance','$pro','$conf')");
                if ($pro=="true") {
                    $id = $cnx -> lastInsertId();
                    $cnx -> exec("INSERT INTO vdeux.pro VALUES ($id,'$mailpro','$telpro','$fonction')");
                }
                if ($conf=="true") {
                    $id = $cnx -> lastInsertId();
                    $cnx -> exec("INSERT INTO vdeux.conferencier VALUES ($id,'$fonction_conf','$orga')");
                }
                $cnx -> commit();
                $_SESSION["essai_inscription"] = "Inscription réussie";
            } catch (PDOException $e) {
                $cnx -> rollback();
                $_SESSION["essai_inscription"] = "Erreur lors de l'inscription";
            }
        } else {
            $_SESSION["essai_inscription"] = "Mot de passe non identique";
        }
    } else {
        $_SESSION["essai_inscription"] = "Remplissez le formulaire";
    }
    header('location:..\form_inscription.php');
    exit();
?>
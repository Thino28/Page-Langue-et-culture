<?php
    include("connexion.inc.php");
    if ((isset($_POST["nom"]) && isset($_POST["prenom"])) && (isset($_POST["naiss"]) && isset($_POST["mail"]))){
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
            $type = "false";
            $spe = "false";
        } else {
            echo "<meta http-equiv='refresh' content='0; url=form_inscription.html'>";
        }

        if ($_POST["type_inscr"]=="Pro" && (isset($_POST["fonction"]) && isset($_POST["mailpro"]))){
            $type = "true";
            $fonction = $_POST["fonction"];
            $mailpro = $_POST["mailpro"];
            $telpro = $_POST["telpro"];
        }
        if ($_POST["type_inscr"]=="Conf" && (isset($_POST["fonction_conf"]) && isset($_POST["orga"]))) {
            $conf = "true";
            $fonction_conf = $_POST["fonction_conf"];
            $orga = $_POST["orga"];
        }
        $cnx -> beginTransaction();
        try {
            $cnx -> exec("INSERT INTO participant VALUES (DEFAULT,'$nom','$prenom','$date_naissance','$mail','$tel','$adresse','$profession','$type','$spe')");
            if ($type) {
                $id = $cnx -> lastInsertId();
                $cnx -> exec("INSERT INTO professionnel VALUES ($id,'$fonction','$telpro','$mailpro')");
            }
            if ($conf) {
                $id = $cnx -> lastInsertId();
                $cnx -> exec("INSERT INTO conferencier VALUES ('$fonction_conf','$orga',$id,NULL,NULL)");
            }
            $cnx -> commit();
            echo "L'inscription a été un succès";
        } catch (PDOException $e) {
            echo "ERREUR : L'inscription a échouée";
            $cnx -> rollback();
            echo $e;
        }
    } else {
        echo "<meta http-equiv='refresh' content='0; url=form_inscription.html'>";
    }
    
    

?>

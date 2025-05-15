<?php 
    session_start();
    include("connexion.inc.php");
    if (isset($_POST["mail"]) && isset($_POST["mdp"])){
        $mail = $_POST["mail"];
        $mdp = $_POST["mdp"];
        $result = $cnx -> query("SELECT num_parti,prenom,titre_pro,titre_conf,admin FROM participant WHERE email_perso='$mail' and mdp='$mdp'");
        if ($result) {
            $ligne = $result -> fetch(PDO::FETCH_ASSOC);
            $_SESSION["id"] = $ligne["num_parti"];
            $_SESSION["email"] = $mail;
            $_SESSION["mdp"] = $mdp;
            $_SESSION["prenom"] = $ligne["prenom"];
            $_SESSION["pro"] = $ligne["titre_pro"];
            $_SESSION["conf"] = $ligne["titre_conf"];
            $_SESSION["admin"] = $ligne["admin"];
        } else {
            echo "<meta http-equiv='refresh' content='0; url=form_connexion.html'>";
        }
        if ($_SESSION["conf"]) {
            echo "<meta http-equiv='refresh' content='0; url=PAGECONF.html'>"; //CHANGER REDIRECTION
        }
        if ($_SESSION["admin"]) {
            echo "<meta http-equiv='refresh' content='0; url=Admin.html'>"; 
        }
        echo "<meta http-equiv='refresh' content='0; url=inscription.html'>"; //CHANGER REDIRECTION
    }
?>
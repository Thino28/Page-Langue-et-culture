<?php 
    include("cnx_utilisateur.inc.php");
    if ((isset($_POST["mail"]) && isset($_POST["mdp"])) && ($_POST["mail"]!=null && $_POST["mdp"]!=null)){
        $mail = $_POST["mail"];
        $mdp = $_POST["mdp"];
        $result = $cnx -> query("SELECT num_parti,prenom,titre_pro,titre_conf FROM vdeux.participant WHERE mail='$mail' and mdp='$mdp'");
        if ($result) {
            $ligne = $result -> fetch(PDO::FETCH_ASSOC);
            $prenom = $ligne['prenom'];
            $id = $ligne['num_parti'];
            $pro = $ligne['titre_pro'];
            $conf = $ligne['titre_conf'];
            setcookie("prenom","$prenom",time()+3600,'/');
            setcookie("mail","$mail",time()+3600,'/');
            setcookie("id","$id",time()+3600,'/');
            setcookie("mdp","$mdp",time()+3600,'/');
            setcookie("pro","$pro",time()+3600,'/');
            setcookie("conf","$conf",time()+3600,'/');
        } else {
            header('location:..\form_connexion.html');
            exit();
        }
        if ($conf) {
            header('location:form_connexion.html');  //CHANGER REDIRECTION pages conférencier
            exit();
        }
        if ($id==1 || $id==2) {
            header('location:..\Admin.php');
            exit();
        }
        header('location:..\Client_Principal.php'); 
        exit();
    } else {
        header('location:..\form_connexion.html');
        exit();
    }
?>
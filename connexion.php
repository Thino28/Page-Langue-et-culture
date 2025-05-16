<?php 
    include("connexion.inc.php");
    if ((isset($_POST["mail"]) && isset($_POST["mdp"])) && ($_POST["mail"]!=null && $_POST["mdp"]!=null)){
        $mail = $_POST["mail"];
        $mdp = $_POST["mdp"];
        $result = $cnx -> query("SELECT num_parti,prenom,titre_pro,titre_conf,admin FROM participant WHERE email_perso='$mail' and mdp='$mdp'");
        if ($result) {
            $ligne = $result -> fetch(PDO::FETCH_ASSOC);
            $nom = $ligne['nom'];
            $prenom = $ligne['prenom'];
            $id = $ligne['num_parti'];
            $pro = $ligne['titre_pro'];
            $conf = $ligne['titre_conf'];
            $admin = $ligne['admin'];
            setcookie("nom","$nom",time()+3600);
            setcookie("prenom","$prenom",time()+3600);
            setcookie("mail","$mail",time()+3600);
            setcookie("id","$id",time()+3600);
            setcookie("mdp","$mdp",time()+3600);
            setcookie("pro","$pro",time()+3600);
            setcookie("conf","$conf",time()+3600);
            setcookie("admin","$admin",time()+3600);
        } else {
            header('location:form_connexion.html');
            exit();
        }
        if ($conf) {
            header('location:form_connexion.html');  //CHANGER REDIRECTION pages conférencier
            exit();
        }
        if ($admin) {
            header('location:Admin.php');
            exit();
        }
        header('location:Client_Principal.php'); 
        exit();
    } else {
        header('location:form_connexion.html');
        exit();
    }
?>
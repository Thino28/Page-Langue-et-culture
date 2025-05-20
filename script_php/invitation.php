<?php 
   include("cnx_parti.inc.php");
   if (isset($_POST['inv']) && $_POST['inv'] != "") {
      $num= explode("_",$_POST['valinv']);
      $email = $_POST['inv'];
      $resultat = $cnx->query("SELECT num_parti FROM vdeux.participant WHERE mail = '$email'");
      $num_invit = $resultat->fetch(PDO::FETCH_OBJ);
      if ($num_invit == null || $num_invit->num_parti == 1 || $num_invit->num_parti == 2) {
         header('location:..\Client_Principal.php');
         exit();
      } else {
         $cnx -> beginTransaction();
         try {
            $cnx->exec("INSERT INTO vdeux.historique_invitation VALUES (DEFAULT,NOW(),$num[1],$num_invit->num_parti,$num[0])");
            $cnx -> commit();
         } catch (PDOException $e){
            $cnx -> rollback();
         }
      }
      
   }
   
   header('location:..\Client_Principal.php');
   exit();

?>
<?php 
   include("cnx_admin.inc.php");
   if (isset($_POST['supp']) && $_POST['supp'] != "") {
      $num= $_POST['supp'];
      $cnx -> beginTransaction();
      try {
         $cnx->exec("DELETE FROM vdeux.organise WHERE num_parti=$num");
         $cnx->exec("DELETE FROM vdeux.conferencier WHERE num_parti=$num");
         $cnx->exec("DELETE FROM vdeux.pro WHERE num_parti=$num");
         $cnx->exec("DELETE FROM vdeux.inscrit WHERE num_parti=$num");
         $cnx->exec("DELETE FROM vdeux.participant WHERE num_parti=$num");
         $cnx -> commit();
      } catch (PDOException $e){
         $cnx -> rollback();
         echo $e;
      }
   }
   //header('location:..\Admin_Utilisateur.php');
   //exit();

?>
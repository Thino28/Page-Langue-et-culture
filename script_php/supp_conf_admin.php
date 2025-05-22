<?php 
   include("cnx_admin.inc.php");
   if (isset($_POST['suppc']) && $_POST['suppc'] != "") {
      $num= $_POST['suppc'];
      $cnx -> beginTransaction();
      try {
         $cnx->exec("DELETE FROM vdeux.organise WHERE num_conf=$num");
         $cnx->exec("DELETE FROM vdeux.inscrit WHERE num_conf=$num");
         $cnx->exec("DELETE FROM vdeux.historique_invitation WHERE num_conf=$num");
         $cnx->exec("DELETE FROM vdeux.conference WHERE num_conf=$num");
         $cnx -> commit();
      } catch (PDOException $e){
         $cnx -> rollback();
         echo $e;
      }
   }
   header('location:..\Admin_Conference.php');
   exit();

?>
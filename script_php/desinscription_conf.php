<?php 
    include("cnx_parti.inc.php");
    $num= explode("_",$_POST['desin']);
    $cnx -> beginTransaction();
    try {
        $cnx->exec("DELETE FROM vdeux.inscrit WHERE num_conf=$num[0] AND num_parti=$num[1]");
        $cnx -> commit();
    } catch (PDOException $e){
        $cnx -> rollback();
    }
    header('location:..\Client_Principal.php');
    exit();

?>
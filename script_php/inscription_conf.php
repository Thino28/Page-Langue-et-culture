<?php 
    include("cnx_parti.inc.php");
    $num= explode("_",$_POST['insc']);
    $cnx -> beginTransaction();
    try {
        $cnx->exec("INSERT INTO vdeux.inscrit VALUES ($num[0],$num[1])");
        $cnx -> commit();
    } catch (PDOException $e){
        $cnx -> rollback();
    }
    header('location:..\Client_Principal.php');
    exit();

?>
<?php
include_once('conn.php');

    //Resolve the ID passed by the Javascript Function
    if(isset($_GET['lid'])){$lid = $_GET['lid'];}

    //trouver le premier logement s'il y a lieu

    global $bdd;
    $req = $bdd->query('select lloyer, lprov from logement where lid='.$lid);
    $tarifslog = $req->fetchAll();

    echo json_encode($tarifslog[0]);

?>

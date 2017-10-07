<?php
include_once 'fct/load.php';
include_once 'vue/head.php';
include_once 'vue/navbar.php';
//il faut içi gérer les différents mode d'arrivée grmblblbl
if(isset($_GET['action']) && $_GET['action']=="liste") //action en cours
{
  $listelogements=$logement->listelogements();
  include_once("./vue/listelogements.php");
}

if($_GET['action']=="new") //action en cours
{
  $sid=1;
  $societe= new societe();
  $ldesc="";
  $ladresse="";
  $lcp="";
  $lville="";
  $lloyer="";
  $lprov="";
  $letage="";
  $ltype=0;
  include_once("./vue/logement.php");
}

if($_GET['action']=="modif") //action en cours
{
  $lid=$_GET['lid'];
  $log=$logement->donneeslogement($lid);
  $sid=$log['sid'];
  $societe= new societe();
  $ldesc=$log['ldesc'];
  $letage=$log['letage'];
  $ladresse=$log['ladresse'];
  $lcp=$log['lcp'];
  $lville=$log['lville'];
  $lloyer=$log['lloyer'];
  $lprov=$log['lprov'];
  $ltype=$log['ltype'];
  $letage=$log['letage'];
  include_once("./vue/logement.php");
}

if($_GET['action']=="suppr"){
  $lid=$_GET['lid'];
  include_once('./vue/suppr/supprlogement.php');
}




	include_once 'fct/scripts.php';
?>
<script>
  $(document).ready( function () {
    $('#tableau_logements').DataTable({
      "language":{
  "url":"https://cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"
}
}
    );
} );
</script>

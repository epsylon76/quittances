
<?php

//load
include_once('./fct/load.php');





//si on arrive pour un client défini par get cid
if(isset($_GET['cid']))
{
	$lignesquittances = $quittance->liste_quittances("cid",$_GET['cid']);
	$listecontrats = $contrat->listecontrats($_GET['cid']);
	$cli = $client->donneesclient($_GET['cid']);
}



//selon l'action demandée on affiche la vue correspondante


if($_GET['action'] == "modif")
{
	//on charge les données selon que l'action est une modif ou un nouveau

	$action="modif";
	$cid=$cli['cid'];
	$nom=$cli['cnom'];
	$tel=$cli['ctel'];
	$mail=$cli['cmail'];
	$garnom=$cli['garnom'];
	$gartel=$cli['gartel'];
	$garmail=$cli['garmail'];
	$garadr=$cli['garadr'];
	$garcp=$cli['garcp'];
	$garville=$cli['garville'];
	//la vue modif
	include_once('./vue/modifclient.php');
}

if($_GET['action'] == "new")
{
	$action="new";
	$nom="";
	$tel="";
	$mail="";
	$garnom="";
	$gartel="";
	$garmail="";
	$garadr="";
	$garcp="";
	$garville="";
	//la vue modif
	include_once('./vue/modifclient.php');
}

if($_GET['action'] == "suppr")
{
	$cid=$cli['cid'];
	include_once('./vue/suppr/supprclient.php');
}

if($_GET['action'] == "liste")
{
	//on charge la liste complète
	$listeclient = $client->liste_clients();
	$listeclienthide = $client->liste_clientshide();
	//on charge la vue
	include_once('./vue/listeclients.php');
}

if($_GET['action'] == "afficher")
{
	//on charge la vue
	include_once('./vue/client.php');
}

if($_GET['action']=="hide")
{
	$cid=$_GET['cid'];
	$client->hide($cid);
	header('location:client.php?action=liste');
}

if($_GET['action']=="unhide")
{
	$cid=$_GET['cid'];
	$client->unhide($cid);
	header('location:client.php?action=liste');
}


include_once('./fct/scripts.php');
//les scripts de fin de page
?>

<script>
  $(document).ready( function () {
    $('#tab_locataires').DataTable({
      "language":{
  "url":"https://cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"
}
}
    );
} );
</script>
<script>
  $(document).ready( function () {
    $('#tab_locataires_inactifs').DataTable({
      "language":{
  "url":"https://cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"
}
}
    );
} );
</script>

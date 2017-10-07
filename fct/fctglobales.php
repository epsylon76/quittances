<?php

//prends une date en paramètre, retourne une variable mois avec le nom du mois et le numéro du mois
function mois($date)
{
	$date=new DateTime($date,new DateTimeZone('Europe/Paris'));
	$nomois=$date->format('n');
	$tab_mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
	$mois['nommois'] = $tab_mois[$nomois-1];
	$mois['nomois'] = $nomois;
	return $mois;
}

//prend un numéro en paramètre, retourne le nom du mois
function mois_from_no($nomois)
{
	$mois=intval($nomois);
	if($mois==-1){$mois=12;}
	$tab_mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
	$mois = $tab_mois[$nomois-1];
	return $mois;
}

//teste si les deux dates données en paramètre sont dans le même mois et la même année
function ponctuel($datedebut,$datefin)
{
	$md=date("m",strtotime($datedebut));
	$mf=date("m",strtotime($datefin));
	$ad=date("Y",strtotime($datedebut));
	$af=date("Y",strtotime($datefin));
	if($af=$ad && $md==$mf)
	{return true;}
	else {
		return false;
	}
}

//retourne l'année d'une date donnée en paramètre
function annee($date)
{
	$date=new DateTime($date,new DateTimeZone('Europe/Paris'));
	$annee=$date->format('Y');
	return $annee;
}

//affiche un select des moyens de paiement préselectionné sur le paramètre
function selectpaiement($sel)
{
	$s[1]='';
	$s[2]='';
	$s[3]='';
	$s[$sel]=' selected ';
	$paiement = '<select name="moyenpaiement" class="form-control">';
	$paiement = $paiement.'<option value="1"'.$s[1].'>chèque</option>';
	$paiement = $paiement.'<option value="2"'.$s[2].'>virement</option>';
	$paiement = $paiement.'<option value="3"'.$s[3].'>espèces</option>';
	$paiement = $paiement.'</select>';

	return $paiement;
}


//affiche un select des mois de l'année en paramètre, et vérifie lesquelles sont possibles
function select_mois($num_mois,$annee,$cid)
{
	global $bdd;
	//fond de couleur

	$colorvert='style="background-color:#92FFAB"';
	$colorbleu='style="background-color:#A7C4E8" disabled';
	$cid = intval($cid);
	$annee = intval($annee);
	$num_mois = intval($num_mois);
	$num_mois = ltrim($num_mois, '0');

	for($i=1;$i<=12;$i++) //de 1 à 12 on vérifie si la quittance existe pour ce contrat, ce mois et cette année
	{
		$selected[$i]='';//on désélectionne d'abord
		$req = $bdd->query('select qdate from quittance where YEAR(qdate) = '.$annee.' AND cid ='.$cid.' AND MONTH(qdate) = '.$i);

		$date = $req->fetch();
		if($date) // si une valeur existe, la date existe
		{
			//on colore le fond du choix en bleu
			$class[$i]=$colorbleu;
		}
		else {
			$class[$i]=$colorvert; //sinon en vert = dispo
		}
	} //fin du for

$selected[$num_mois]="selected "; //on selectionne le mois en cours

//trick : le mois selectionné s'est vu attrivuer une couleur de fond, on met la même pour le select (case principale)
if($class[$num_mois]==$colorvert){$bg=$colorvert;}ELSE{$bg=$colorbleu;}

//hop plus qu'a afficher
print '<select name="mois" class="form-control" '.$bg.'style="" id="mois">
<option value="1"'.$selected[1].$class[1].'>Janvier</option>
<option value="2"'.$selected[2].$class[2].'>Février</option>
<option value="3"'.$selected[3].$class[3].'>Mars</option>
<option value="4"'.$selected[4].$class[4].'>Avril</option>
<option value="5"'.$selected[5].$class[5].'>Mai</option>
<option value="6"'.$selected[6].$class[6].'>Juin</option>
<option value="7"'.$selected[7].$class[7].'>Juillet</option>
<option value="8"'.$selected[8].$class[8].'>Août</option>
<option value="9"'.$selected[9].$class[9].'>Septembre</option>
<option value="10"'.$selected[10].$class[10].'>Octobre</option>
<option value="11"'.$selected[11].$class[11].'>Novembre</option>
<option value="12"'.$selected[12].$class[12].'>Décembre</option>
</select>';
}//fin de la fonction




function select_annee($annee)
{
	$earliest_year = $annee-5;
	$select='<select name="annee" class="form-control input-sm" id="annee" style="width:80px">';

	foreach (range(date('Y')+1, $earliest_year) as $x)
	{
		$select=$select.'<option value="'.$x.'"'.($x == $annee ? ' selected' : '').'>'.$x.'</option>';
	}
	$select=$select.'</select>';
	return $select;
}

function nav_annee()
{

	echo'
	<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	<i class="fa fa-filter" aria-hidden="true"></i> Année
	<span class="caret"></span>
	</a>
	<ul class="dropdown-menu">
	<li><a href="index.php">Toutes années</a></li>';

	$earliest_year = 2010;
	foreach (range(date('Y')+1, $earliest_year) as $x)
	{
		echo '<li><a href="index.php?annee='.$x.'">'.$x.'</a></li>';
	}
	echo '  </ul>
	</li>';

}

function intervalle($datefincontrat)
{
	//date d'aujourd'hui
	$dateaujourdhui=new DateTime('now',new DateTimeZone('Europe/Paris'));
	//il faut regarder s'il y a une date de fin de contrat ou pas

	$datefincontrat=new DateTime($datefincontrat,new DateTimeZone('Europe/Paris'));


	$interval = $dateaujourdhui->diff($datefincontrat);
	$pos = $interval->format('%R'); //valeur positive ou négative

	$interval=$interval->format('%a'); //intervalle

	//maintenant on calcule et on décide de l'affichage de l'alerte

	return $interval;

}



function date_humain_unix($date_humain){
	//separation de la date par / ou -
	list ($jour , $mois , $an) = preg_split("[/]",$date_humain);
	//inverse la date

	return($an."-".$mois."-".$jour);
}

function date_unix_humain($date_unix){
	//separation de la date par / ou -
	list ($an , $mois , $jour) = preg_split("[-]",$date_unix);
	//inverse la date

	return($jour."/".$mois."/".$an);
}



function derniersid()
{
	global $bdd;
	$req = $bdd->query('select MAX(sid) from societe');
	$donnees = $req->fetchAll();
	$sid = $donnees[0];
	return $sid;
}

function rrmdir($dir) {
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
				if (is_dir($dir."/".$object))
					rrmdir($dir."/".$object);
				else
					unlink($dir."/".$object);
			}
		}
		rmdir($dir);
	}
}

function pagemessage($couleur,$titre,$message,$lienbouton){

echo'
	<div class="row">
		<div class="col-md-4 col-md-offset-4" style="margin-top:50px;">
			<div class="panel panel-'.$couleur.'">
				<div class="panel-heading">
					<h3 class="panel-title">'.$titre.'</h3>
				</div>
				<div class="panel-body">
					<p>'.$message.'</p>
					<p><a class="btn btn-default btn-lg" href="'.$lienbouton.'">retour</a></p>
				</div>
			</div>
		</div>
	</div>';
}

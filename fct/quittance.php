<?php

class quittance
{


	public function liste_quittances($tri,$val)
	{
		//la var bdd comporte la connexion pdo
		global $bdd;
		$val=intval($val);
		//on effectue la requete de liste des sociétés
		switch ($tri)
		{
			
			case "cid":

			$req = $bdd->query('select * from quittance where cid='.$val.' order by qid desc');
			if($req){
				$donnees = $req->fetchAll();
			}else{$donnees=false;}

			return $donnees;

			break;


			case "cnid":

			$req = $bdd->query('select * from quittance where cnid='.$val.' order by qid desc');
			if($req){
				$donnees = $req->fetchAll();
			}else{$donnees=false;}
			return $donnees;

			break;


			case "sid":

			$req = $bdd->query('select * from quittance where sid='.$val.'  order by qid desc');
			if($req){
				$donnees = $req->fetchAll();
			}else{$donnees=false;}
			return $donnees;

			break;


			case "annee":

			$req = $bdd->query('select * from quittance where YEAR(qdate)='.$val.' order by qid desc');
			if($req){
				$donnees = $req->fetchAll();
			}else{$donnees=false;}
			return $donnees;

			break;


			case "all":

			$req = $bdd->query('select * from quittance where 1 order by qid desc');
			$donnees = $req->fetchAll();
			return $donnees;

			break;

		}
	}



	public function aff_quittance($qid)
	{
		global $bdd;

		$req = $bdd->query('select * from quittance where qid='.$qid);
		$donnees_quittance = $req->fetch();
		return $donnees_quittance;
	}


	//rend un tableau des dates de quittances
	public function datesq($annee,$cid)
	{
		global $bdd;
		$req = $bdd->query('select qdate from quittance where YEAR(qdate) = '.$annee.' AND cid ='.$cid);
		$dates = $req->fetchAll();
		return $dates;
	}

	//rend une réponse si la quittance existe
	public function qexiste($annee,$mois,$cid)
	{
		global $bdd;
		$req = $bdd->query('select qdate from quittance where YEAR(qdate) = '.$annee.' AND cid ='.$cid.' AND MONTH(qdate) = '.$mois);
		$dates = $req->fetch();
		if($dates)
		{return TRUE;}else{return FALSE;}
	}


	public function derniereqidclient($cid)
	{
		global $bdd;
		$req = $bdd->query('select qid from quittance where cid="'.$cid.'" order by qdate desc limit 1');
		$qid = $req->fetch();
		return $qid;
	}

	//y a il une quittance précédente à ce contrat, retourne false si non, retourne la derniere qid si oui

	public function dernierequittancecontrat($cnid)
	{
		global $bdd;
		$req = $bdd->query('select count(qid) from quittance where cnid='.$cnid);
		$count = $req->fetch();
		if($count==0){return false;}
		else {
			$req = $bdd->query('select max(qid) from quittance where cnid='.$cnid);
			$qid = $req->fetch();
			$qid = $qid[0];
			return $qid;
		}
	}
}

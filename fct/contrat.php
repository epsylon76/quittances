<?php

class contrat
{
	private $donnees;

	public function listecontratsmain()
	{
		//la var bdd comporte la connexion pdo
		global $bdd;

			$req = $bdd->query('select * from contrat where datedebut<=NOW() and datefin>=NOW()');
			$donnees = $req->fetchAll();
			return $donnees;

	}

	//liste des contrats en fonction du cid
	public function listecontrats($cid)
	{
		$cid=intval($cid);
		global $bdd;
		$req = $bdd->query('select * from contrat where cid ='.$cid);
		$liste = $req->fetchAll();
		if(!empty($liste))
		{
		return $liste;
	}
	}

	public function selectcontrats($cid)
	{

		global $bdd;
		$req = $bdd->query('select cnid from contrat where cid ='.$cid);
		$liste = $req->fetchAll();
		$select='<select name="contrat" class="form-control">';
		foreach($liste as $con)
		{
			$select = $select.'<option value="'.$con[0].'">contrat n°'.$con[0].'</option>';
		}
		$select=$select.'</select>';
		return $select;
	}


	//donnees contrat en fontion du cnid
	public function donneescontrat($cnid)
	{
		global $bdd;
		$req = $bdd->query('select * from contrat where cnid='.$cnid );
		$donneescontrat = $req->fetchAll();
		$donneescontrat = $donneescontrat[0];
		return $donneescontrat;
	}

	//liste des contrats en fonction de la periode de debut
	public function listecontratsdebut($mois,$annee)
	{
		$mois=intval($mois);
		$annee=intval($annee);
		global $bdd;
		$req = $bdd->query('select * from contrat where month(datedebut)='.$mois.' and year(datedebut)='.$annee);
		if($req){
			$liste = $req->fetchAll();
		}else{
			$liste=false;
		}
		return $liste;
	}

	public function listecontratsfin($mois,$annee)
	{
		$mois=intval($mois);
		$annee=intval($annee);
		global $bdd;
		$req = $bdd->query('select * from contrat where month(datefin)='.$mois.' and year(datefin)='.$annee);
		if($req){
			$liste = $req->fetchAll();
		}else{
			$liste=false;
		}
		return $liste;
	}



	public function nb_mvt_contrats($mois,$annee)
	{
		$mois=intval($mois);
		$annee=intval($annee);
		$mvt=0;
		global $bdd;
		$req = $bdd->query('select count(cnid) from contrat where month(datefin)='.$mois.' and year(datefin)='.$annee);
		if($req){
			$nb = $req->fetch();
			$mvt=$nb[0];
		}
		$req = $bdd->query('select count(cnid) from contrat where month(datedebut)='.$mois.' and year(datedebut)='.$annee);
		if($req){
			$nb = $req->fetch();
			$mvt=$nb[0]+$mvt;
		}
		return $mvt;

	}


	public function has_contrats($cid)
	{
		global $bdd;
		$cid=intval($cid);
		$req = $bdd->query('select count(cnid) from contrat where cid='.$cid);
		$nb=$req->fetch();
		if($nb[0]==0){return false;}else{return true;}
	}


}

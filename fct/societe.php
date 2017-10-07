<?php

class societe
{


	public function liste_societes()
	{
		//la var bdd comporte la connexion pdo
		global $bdd;
		//on effectue la requete de liste des sociétés

		$req = $bdd->query('select * from societe');
		$donnees = $req->fetchAll();
		return $donnees;
	}



	//donnees societe en fcontion du sid
	public function donneessociete($sid)
	{
		global $bdd;
		$req = $bdd->query('select * from societe where sid='.$sid );
		$donneessociete = $req->fetchAll();
		if(!empty($donneessociete))
		{
			$donneessociete = $donneessociete[0];
			return $donneessociete;
		}
	}

	//afficher le select societes avec ou sans qid selected
	public function selectsociete($sid)
	{
		global $bdd;

		$req = $bdd->query('select * from societe');
		$listesocietes = $req->fetchAll();

		$listesoc='<select name="sid" class="form-control">';
		foreach($listesocietes as $soc)
		{
			$listesoc= $listesoc.'<option value="'.$soc['sid'].'"';
			if($sid==$soc['sid'])
			{
				$listesoc = $listesoc.'selected';
			}

			$listesoc = $listesoc.'>'.$soc['snom'].'</option>';

		}
		$listesoc = $listesoc.'</select>';
		return $listesoc;
	}

	public function menu_societes()
	{
		$navsoc=
		'<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		<i class="fa fa-filter" aria-hidden="true"></i>	Société<span class="caret"></span>
		</a>

		<ul class="dropdown-menu">
		<li>
		<a href="index.php">Toutes</a>
		</li>';

		global $bdd;
		$req = $bdd->query('select sid, snom from societe');
		$donnees = $req->fetchAll();
		foreach($donnees as $societe)
		{
			$navsoc=$navsoc.'<li><a href="index.php?sid='.$societe['sid'].'">'.$societe['snom'].'</a></li>';
		}
		$navsoc=$navsoc."</ul></li>";
		return $navsoc;
	}



	public function has_quittances($sid) //retourne true si la société a des quittances
	{
		global $bdd;
		$req = $bdd->query('select count(sid) from quittance where sid='.$sid);
		$donnees = $req->fetchAll();
		$nb=$donnees[0][0];
		if($nb>=1){return true;}ELSE{return false;}
	}




}

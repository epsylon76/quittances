<?php

class client
{
	private $donnees;

	public function liste_clients()
	{
		//la var bdd comporte la connexion pdo
		global $bdd;
		//on effectue la requete de liste des sociétés

			$req = $bdd->query('select * from client where hide=0');
			$donnees = $req->fetchAll();
			return $donnees;

	}

		public function liste_clientshide()
	{
		//la var bdd comporte la connexion pdo
		global $bdd;
		//on effectue la requete de liste des sociétés

			$req = $bdd->query('select * from client where hide=1');
			$donnees = $req->fetchAll();
			return $donnees;

	}

	//donnees client en fcontion du cid
	public function donneesclient($cid)
	{
		global $bdd;
		$cid=intval($cid);//on protege contre l'injection
		$req = $bdd->query('select * from client where cid='.$cid);
		$donneesclient = $req->fetchAll();
		if(!empty($donneesclient))
		{
			$donneesclient = $donneesclient[0];
			return $donneesclient;
		}
	}

	public function hide($cid)
	{
		global $bdd;
		$req = $bdd->query('update client set hide=1 where cid='.$cid);
	}

	public function unhide($cid)
	{
		global $bdd;
		$cid=intval($cid);
		$req = $bdd->query('update client set hide=0 where cid='.$cid);
	}






}

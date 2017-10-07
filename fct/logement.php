<?php

class logement
{
	//liste logements
	public function listelogements()
	{
		global $bdd;
		$req = $bdd->query('select * from logement where 1 order by ldesc asc' );
		$ldata = $req->fetchAll();
		if(!empty($ldata))
		{
			return $ldata;
		}
	}

	//donnees logement
	public function donneeslogement($lid)
	{
		global $bdd;
		$req = $bdd->query('select * from logement where lid='.$lid );
		$ldata = $req->fetchAll();

		if(!empty($ldata))
		{
			$ldata = $ldata[0];
			return $ldata;
		}
	}

	public function selectlogement()
	{
		global $bdd;

		$req = $bdd->query('select * from logement');
		$listelog= $req->fetchAll();

		$select='<select name="lid" id="selectlogement" class="form-control" required>';
		$select=$select.'<option value="" disabled selected>Selectionner un logement</option>';
		foreach($listelog as $log)
		{
			$select= $select.'<option value="'.$log['lid'].'"';
			$select = $select.'>'.$log['ldesc'].'</option>';

		}
		$select = $select.'</select>';
		return $select;
	}

	public function nbcontrats($lid)
	{
		global $bdd;
		$req = $bdd->query('select count(cnid) from contrat where lid='.$lid );
		$ldata = $req->fetchAll();
		$ldata = $ldata[0];
		return $ldata;
	}

	public function listecontrats($lid)
	{
		global $bdd;
		$req = $bdd->query('select cid from contrat where lid='.$lid.' and datedebut<=now() and datefin>=NOW()');
		$ldata = $req->fetchAll();
		return $ldata;
	}


}

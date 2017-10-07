
<?php

	session_start();
	
	if(!isset($_SESSION['annee']))
		{			
			$_SESSION['annee']="all";
		}
		

		
	if(!isset($_SESSION['societe']))
		{

			$_SESSION['societe']="all";
		}
	

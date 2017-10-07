<?php
try
	{
		$bdd = new PDO('mysql:host=...;dbname=...','...','...');
		$bdd->exec('SET NAMES utf8');
	}
catch (Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
?>

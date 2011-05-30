<?php
//File necessari..
	require_once('../classes/data.inc.php');

//Istanzio gli oggetti di configurazione, di creazione dell'XML e connessione al DB
	$data = new data("SELECT * FROM progetto_alimento;");

	$data->getResult();
	
?>	
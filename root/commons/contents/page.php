<?php

//File necessari..
	require_once('../classes/data.inc.php');
	
// query
	$query = "SELECT livello_accesso, titolo, corpo AS testo 
FROM pagine 
WHERE pretty_url = '" . $_GET['info'] . "'";

$ident_elemento = 'sezione';

//Istanzio gli oggetti di configurazione, di creazione dell'XML e connessione al DB
	$data = new data($ident_elemento, $query);

	$data->getResult();
	
?>
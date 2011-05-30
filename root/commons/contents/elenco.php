<?php
//File necessari..
	require_once('../classes/data.inc.php');
	
// query
	$query = "SELECT * 
			FROM eventi
			";



if(isset($_GET['info'])){
$query .= " WHERE nome LIKE '%".$_GET['info']."%' OR luogo LIKE '%".$_GET['info']."%' OR via LIKE '%".$_GET['info']."%' OR descrizione LIKE '%".$_GET['info']."%'";
/*
if(isset($_GET['nome']))
$query .= "nome = " . $_GET['nome'] . " ";
if(isset($_GET['nome']))
$query .= "nome = " . $_GET['nome'] . " ";
*/
}

$query .= " ORDER BY data_ora ASC;";
//echo $query;
	$ident_elemento = 'evento';



//Istanzio gli oggetti di configurazione, di creazione dell'XML e connessione al DB
	$data = new data($ident_elemento, $query);

	$data->getResult();
	
?>
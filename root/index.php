<?php
session_start();

	//Includo i files necessari
	require_once('./commons/config.inc.php');
	require_once('./commons/classes/template.inc.php');
	
	//Implemento la configurazione
	$config = new config();
	
	//Implemento la gestione dei templates
	$template = new template();
	


if(isset($_GET['sezione']))
$sezione = $_GET['sezione'];
else
$sezione = 'homepage';


	$data = simplexml_load_file($config->getXmlDataFile() . $sezione);


if($data->head->code == 200){
	$template->replaceContent('{titolo}', $data->sezione->titolo);
	$template->replaceContent('{testo}', $data->sezione->testo);
}
elseif($data->head->code == 403){
	$template->replaceContent('{titolo}', 'Accesso negato');
	$template->replaceContent('{testo}', 'Non disponi dei privilegi necessari per visualizzare la pagina.');
}
else{
	$template->replaceContent('{titolo}', 'errore');
	$template->replaceContent('{testo}', 'errore');
}

	$template->printContent();

?>
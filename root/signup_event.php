<?php
session_start();
	//Includo i files necessari
	require_once('./commons/config.inc.php');
	require_once('./commons/classes/db.inc.php');
	require_once('./commons/classes/template.inc.php');
	require_once('./commons/classes/mail.inc.php');	

	
	//Implemento la configurazione
	$config = new config();
	//Implemento la gestione dei templates
	$template = new template();
	//Implemento l'invio di mail
	$mail = new mail();

	$data = new db($config->getHost(), $config->getUser(), $config->getPass(), $config->getdbName());

$template->replaceContent('{titolo}', 'Iscrizione all\'evento');

if(isset($_POST['id_evento']) && isset($_SESSION['id'])){
$query = 'INSERT INTO iscrizioni(utente, evento) VALUES(' . $_SESSION['id'] . ', ' . $_POST['id_evento'] . ');';
$data->executeQuery($query);

$mail->setReceiver($_SESSION['mail']);
$mail->setObject('Iscrizione all\'evento');
$mail->setMessage('Ciao ' . $_SESSION['user'] . ",\nti confermiamo l'iscrizione all'evento richiesto.");
$mail->sendMail();

$testo = 'Iscrizione all\'evento avvenuta con successo. Ti abbiamo inviato una mail di conferma.';
}
else{
$testo = 'Iscrizione all\'evento fallita.';
}
$template->replaceContent('{testo}', $testo);

	$template->printContent();

?>
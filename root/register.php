<?php
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

	//Implemento la gestione delle info
	$data = new db($config->getHost(), $config->getUser(), $config->getPass(), $config->getdbName());

$template->replaceContent('{titolo}', 'Registrazione utente');

if(isset($_POST['nome'])){
$data->executeQuery("INSERT INTO utenti (nome, cognome, mail, data_nascita, abilitato, notifiche, username, password, livello) VALUES ('" . $_POST['nome'] . "', '" . $_POST['cognome'] . "', '" . $_POST['mail'] . "', '" . $_POST['data_nascita'] . "', 1, 1, '" . $_POST['username'] . "', '" . $_POST['password'] . "', 1);"); 

$mail->setReceiver($_POST['mail']);
$mail->setObject('Iscrizione al sito ' . $config->getSiteName());
$mail->setMessage('Benvenuto ' . $_POST['nome'] . "!\n\nDi seguito i dati della tua registrazione:\n\n\nUsername: " . $_POST['username'] . "\nPassword: " . $_POST['password'] . "\n\n\nBuona permanenza su " . $config->getBasePath() . '!');
$mail->sendMail();

$testo = 'Registrazione effettuata. Ti abbiamo inviato una mail con i tuoi dati.';
}
else{
$testo = 'Errore nella fase di registrazione.';
}

$template->replaceContent('{testo}', $testo);
	$template->printContent();
?>
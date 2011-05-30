<?php
session_start();
	//Includo i files necessari
	require_once('./commons/config.inc.php');
	require_once('./commons/classes/db.inc.php');
	require_once('./commons/classes/template.inc.php');
	
	//Implemento la configurazione
	$config = new config();
	//Implemento la gestione dei templates
	$template = new template();

	$db = new db($config->getHost(), $config->getUser(), $config->getPass(), $config->getdbName());

	
	$user = stripslashes(trim($_POST['username']));
	$pass = stripslashes(trim($_POST['password']));

if($_GET['action'] == 'login'){
	$template->replaceContent('{titolo}', 'Pagina di login');
	if(!isset($_SESSION['user'])){
	//user non loggato


		if(!isset($_POST['username']) || !isset($_POST['password'])){
			$template->replaceContent('{testo}', 'ERRORE: username e/o password non inseriti.');
			exit;
		}

		$query = 'SELECT id, username, mail, livello FROM utenti WHERE username = "' . $user . '" AND password = "' . $pass . '";';
		$db->generateQuery($query);


		if($db->hasResults()){
			$info = $db->getInfo(0);
			$_SESSION['user'] = $info['username'];
			$_SESSION['id'] = $info['id'];
			$_SESSION['mail'] = $info['mail'];
			$_SESSION['livello'] = $info['livello'];


			$template->replaceContent('{testo}', 'Login effettuato con successo. Benvenuto ' . $_SESSION['user'] . '.');

		}
		else{
			$template->replaceContent('{testo}', 'ERRORE: username e/o password errati.');
		}

	}
	else{
		//user loggato
		$template->replaceContent('{testo}', 'Hey ' . $_SESSION['user'] . ', hai gi&agrave; effettuato l\'accesso!');
	}
}
elseif($_GET['action'] == 'logout'){

session_unset();
session_destroy();

	$template->replaceContent('{titolo}', 'Pagina di logout');
			$template->replaceContent('{testo}', 'Logout effettuato');
}

		$template->printContent();
?>
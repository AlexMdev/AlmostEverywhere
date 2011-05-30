<?php
	//Includo i files necessari
	require_once('./commons/config.inc.php');
	require_once('./commons/classes/db.inc.php');
	require_once('./commons/classes/template.inc.php');
	
	//Implemento la configurazione
	$config = new config();
	
	//Implemento la gestione dei templates
	$template = new template();

	//Implemento la gestione delle info
	$data = new db($config->getHost(), $config->getUser(), $config->getPass(), $config->getdbName());

	//Implemento la gestione dei templates
	$template = new template();

	$template->replaceContent('{titolo}', 'Pannello admin');


if(isset($_POST)){
	if($_POST['sezione'] == 'pagine'){
		if($_POST['action'] == 'insert'){
			$data->executeQuery("INSERT INTO pagine (titolo, corpo, pretty_url, livello_accesso) VALUES('" . $_POST['titolo'] . "', '" . $_POST['corpo'] . "', '" . $_POST['pretty_url'] . "', " . $_POST['livello_accesso'] . ");");
$testo = 'Inserimento della nuova pagina eseguito. <a href="' . $config->getBasePath() . '/admin.php?sezione=pagine&id=' . mysql_insert_id() . '">(Modifica)</a> | <a href="' . $config->getBasePath() . '/' . $_POST['pretty_url'] . '">(visualizza)</a> la pagina.';
		}
		elseif($_POST['action'] == 'delete'){
			$data->executeQuery("DELETE FROM pagine WHERE id = " . $_POST['id'] . ";");
$testo = 'Rimozione della pagina eseguito.';
		}
		elseif($_POST['action'] == 'update'){
			$data->executeQuery("UPDATE pagine SET titolo = '" . $_POST['titolo'] . "', corpo = '" . $_POST['corpo'] . "', pretty_url = '" . $_POST['pretty_url'] . "', livello_accesso = " . $_POST['livello_accesso'] . " WHERE id = " . $_POST['id'] . ";");
$testo = 'Aggiornamento della pagina eseguito. <a href="'.$config->getBasePath().'/admin.php?sezione=pagine&id='.$_POST['id'].'">(Modifica)</a> | <a href="'.$config->getBasePath().'/'.$_POST['pretty_url'].'">(visualizza)</a> la pagina.';

		}
	}
	elseif($_POST['sezione'] == 'eventi'){
		if($_POST['action'] == 'insert'){
			$data->executeQuery("INSERT INTO pagine (titolo, corpo, pretty_url, livello_accesso) VALUES('" . $_POST['titolo'] . "', '" . $_POST['corpo'] . "', '" . $_POST['pretty_url'] . "', " . $_POST['livello_accesso'] . ");");
$testo = 'Inserimento del nuovo evento eseguito. <a href="' . $config->getBasePath() . '/admin.php?sezione=eventi&id=' . mysql_insert_id() . '">(Modifica)</a> | <a href="' . $config->getBasePath() . '/eventi">(visualizza)</a> l\'evento.';
		}
		elseif($_POST['action'] == 'delete'){
			$data->executeQuery("DELETE FROM pagine WHERE id = " . $_POST['id'] . ";");
$testo = 'Rimozione dell\'evento eseguito.';
		}
		elseif($_POST['action'] == 'update'){
			$data->executeQuery("UPDATE eventi SET nome = '" . $_POST['nome'] . "', data_ora = '" . $_POST['data_ora'] . "', luogo = '" . $_POST['luogo'] . "', via = '" . $_POST['via'] . "',  costo = '" . $_POST['costo'] . "', min_eta = '" . $_POST['min_eta'] . "', descrizione = '" . $_POST['descrizione'] . "' WHERE id = " . $_POST['id'] . ";");
$testo = 'Aggiornamento dell\'evento eseguito. <a href="'.$config->getBasePath().'/admin.php?sezione=eventi&id='.$_POST['id'].'">(Modifica)</a> | <a href="'.$config->getBasePath().'/eventi">(visualizza)</a> l\'evento.';

		}
	}
}
else
$testo = 'Pagina non richiamabile direttamente.';
$template->replaceContent('{testo}', $testo);

	$template->printContent();

?>
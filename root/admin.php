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

	//Implemento la gestione delle info
	$data = new db($config->getHost(), $config->getUser(), $config->getPass(), $config->getdbName());
$data->generateQuery('SELECT titolo, corpo FROM pagine WHERE id=7;');
$info = $data->getInfo(0);

	$template->replaceContent('{titolo}', 'Pannello admin');

//se ha livello di accesso sufficiente..
if($_SESSION['livello'] >= 2){

	//se non sono in homepage admin
	if(isset($_GET['sezione'])){
		switch($_GET['sezione']){
			//modifica delle pagine
			case 'pagine':
				//se chiede di modificare una pagina specifica
				if(isset($_GET['id'])){
if($_GET['id'] == 'new'){
					$testo = '';
					$testo .= '<form method="post" action="save.php">';
					$testo .= '<input type="hidden" name="sezione" value="pagine">';
					$testo .= '<input type="hidden" name="action" value="insert">';
					$testo .= '<br />Titolo: <input type="text" name="titolo" />';
					$testo .= '<br />Corpo: <textarea name="corpo"></textarea>';
					$testo .= '<br />Pretty URL: <input type="text" name="pretty_url" />';
					$testo .= '<br />Livello accesso: <input type="text" name="livello_accesso" />';
					$testo .= '<input type="submit" value="Inserisci" />';
					$testo .= '</form>';
}
else{
					$data->generateQuery('SELECT titolo, corpo, pretty_url, livello_accesso FROM pagine WHERE id='. $_GET['id'] . ';');
					$info = $data->getInfo(1);
					$testo = '';
					$testo .= '<form method="post" action="save.php">';
					$testo .= '<input type="hidden" name="sezione" value="pagine">';
					$testo .= '<input type="hidden" name="id" value=' . $_GET['id'] . '>';
					$testo .= '<input type="hidden" name="action" value="update">';
					$testo .= '<br />Titolo: <input type="text" name="titolo" value="' . $info['titolo'] . '" />';
					$testo .= '<br />Corpo: <textarea name="corpo">' . $info['corpo'] . '</textarea>';
					$testo .= '<br />Pretty URL: <input type="text" name="pretty_url" value="' . $info['pretty_url'] . '" />';
					$testo .= '<br />Livello accesso: <input type="text" name="livello_accesso" value="' . $info['livello_accesso'] . '" />';
					$testo .= '<input type="submit" value="salva le modifiche" />';
					$testo .= '</form>';
}
					$template->replaceContent('{testo}', $testo);
				}
				//stampo l'elenco delle pagine
				else{
					$data->generateQuery('SELECT id, titolo FROM pagine;');
					$info = $data->getAllInfo();
					$testo = '<ul>';
					foreach($info as $record){
						$testo .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?sezione=pagine&id=' . $record['id'] . '">' . $record['titolo'] . '</a></li>';
						$testo .= '<form method="post" action="delete.php">';
						$testo .= '<input type="hidden" name="id" value="' . $record['id'] . '" />';
						$testo .= '<input type="hidden" name="sezione" value="pagine" />';
						$testo .= '<input type="submit" class="delete" value="Cancella" />';
						$testo .= '</form>';
						$testo .= '<hr />';
					}
					$testo .= '<li><br /><br /><a href="' . $_SERVER['PHP_SELF'] . '?sezione=pagine&id=new"><b>Aggiungi una pagina</b></a></li>';
					$testo .= '</ul>';

					$template->replaceContent('{testo}', $testo);
				}
				break;
				//se chiede di modificare gli eventi
				case 'eventi':
/*					$data->generateQuery('SELECT nome FROM eventi;');
					$info = $data->getAllInfo();
					$testo = '<ul>';
					foreach($info as $record){
						$testo .= '<li>' . $record['nome'] . '</li>';
						$testo .= '<form method="post" action="delete.php">';
						$testo .= '<input type="hidden" name="id" value="' . $record['id'] . '" />';
						$testo .= '<input type="hidden" name="sezione" value="eventi" />';
						$testo .= '<input type="submit" class="delete" value="Cancella" />';
						$testo .= '</form>';
						$testo .= '<hr />';
					}
					$testo .= '</ul>';

					$template->replaceContent('{testo}', $testo);
*/
					if(isset($_GET['id'])){
						$data->generateQuery('SELECT * FROM eventi WHERE id ='. $_GET['id'] . ';');
						$info = $data->getAllInfo();
$info = $info[1];
						$testo = '';
					$testo .= '<form method="post" action="save.php">';
					$testo .= '<input type="hidden" name="sezione" value="eventi" />';
					$testo .= '<input type="hidden" name="action" value="update" />';
					$testo .= '<input type="hidden" name="id" value="' . $_GET['id'] . '" />';
					$testo .= '<br />Nome: <input type="text" name="nome" value="' . $info['nome'] . '" />';
					$testo .= '<br />Data/Ora: <input type="text" name="data_ora" value="' . $info['data_ora'] . '" />';
					$testo .= '<br />luogo: <input type="text" name="luogo" value="' . $info['luogo'] . '" />';
					$testo .= '<br />Via luogo: <input type="text" name="via" value="' . $info['via'] . '" />';
					$testo .= '<br />Costo: <input type="text" name="costo" value="' . $info['costo'] . '" />';
					$testo .= '<br />Minimo di et&agrave;: <input type="text" name="min_eta" value="' . $info['min_eta'] . '" />';
					$testo .= '<br />Descrizione: <textarea name="descrizione">' . $info['descrizione'] . '</textarea>';
					$testo .= '<input type="submit" value="salva" />';
					$testo .= '</form>';
						$template->replaceContent('{testo}', $testo);
					}
					//stampo l'elenco delle pagine
					else{
						$data->generateQuery('SELECT id, nome FROM eventi;');
						$info = $data->getAllInfo();
						$testo = '<ul>';
						foreach($info as $record){
							$testo .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?sezione=eventi&id=' . $record['id'] . '">' . $record['nome'] . '</a>' .'</li>';
						}
						$testo .= '</ul>';

						$template->replaceContent('{testo}', $testo);
					}
					break;
		}
	}
else{
$template->replaceContent('{testo}', $info['corpo']);
}

}
else{
	$template->replaceContent('{titolo}', 'errore');
	$template->replaceContent('{testo}', 'errore');
}

	$template->printContent();

?>
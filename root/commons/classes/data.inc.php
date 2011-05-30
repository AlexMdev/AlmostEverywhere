<?php

session_start();

//Files necessari..
	require_once('../config.inc.php');
	require_once('xml.inc.php');
	require_once('db.inc.php');

class data{

	protected $config, $dataXml, $dataDb, $code, $id, $elemento, $pageData;

	function __construct($elemento, $query){
		//Istanzio gli oggetti di configurazione, di creazione dell'XML e connessione al DB
		$this->elemento = $elemento;
		$this->config = new config();
		$this->dataXml = new xml();
		$this->dataDb = new db($this->config->getHost(), $this->config->getUser(), $this->config->getPass(), $this->config->getdbName());

		$this->dataDb->generateQuery($query);

$this->pageData = $this->dataDb->getInfo(0);
	}

	function getResult(){

		if(!isset($_SESSION['livello']))
			$_SESSION['livello'] = 0;

		if($_SESSION['livello'] >= $this->pageData['livello_accesso']){
			if($this->dataDb->hasResults()){
				$this->sendHead(200);
				$this->sendBody();
			}
			else
				$this->sendHead(404);
		}
		else{
			$this->sendHead(403);
		}
	}

	function sendHead($actCode){

		$this->dataXml->openTag('head');
		$this->dataXml->printTag('code', $actCode);
		$this->dataXml->closeTag('head');
	}

	function sendBody(){
	foreach($this->dataDb->getAllInfo() as $row){
			$this->dataXml->openTag($this->elemento);

			foreach(array_keys($row) as $tag)
					$this->dataXml->printTag($tag, '<![CDATA[' . $row[$tag] . ']]>');

			$this->dataXml->closeTag($this->elemento);
		}
	}
}
?>
<?php

class config{

	protected $host, $user, $pass, $dbName, $siteMail, $siteName, $xmlDataFile, $basePath;
	
	public function __construct(){
		// parametri di configurazione database
		$this->host = 'localhost';
		$this->user = 'AlmostEverywhere';
		$this->pass = 'test';
		$this->dbName = 'AlmostEverywhere';
		$this->siteMail = 'your@mail.ext';
		$this->siteName = 'AlmostEverywhere';
		$this->basePath = 'http://' . $_SERVER['SERVER_NAME'] . '/AlmostEverywhere';
		// estrazione info
		$this->xmlDataFile = $this->basePath . '/commons/contents/page/';
	}
	
	public function getSiteMail(){
		return $this->siteMail;
	}

	public function getSiteName(){
		return $this->siteName;
	}

	public function getHost(){
		return $this->host;
	}
	
	public function getUser(){
		return $this->user;
	}
	
	public function getPass(){
		return $this->pass;
	}
	
	public function getdbName(){
		return $this->dbName;
	}

	public function getBasePath(){
		return $this->basePath;
	}

	public function getXmlDataFile(){
		return $this->xmlDataFile;
	}

	public function getNoJsLoc(){
		if(isset($_GET['section']))
			return './index.php' . '?' . 'nojs=true' . '&' . 'section=' . $_GET['section'];
		return './index.php' . '?' . 'nojs=true'; 
	}
}

?>
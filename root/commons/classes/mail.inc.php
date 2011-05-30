<?php

session_start();

require_once('./commons/config.inc.php');

class mail{

	protected $mittente, $destinatario, $oggetto, $messaggio;
	protected $config;

	function __construct(){
		$this->config = new config();
		$this->mittente = 'From: "' . $this->config->getSiteName() . '" <' . $this->config->getSiteMail() . "> \r\n";
	}

	public function setReceiver($value){
		$this->destinatario = $value;
	}

	public function setMessage($value){
		$this->messaggio = $value;
	}

	public function setObject($value){
		$this->oggetto = $value;
	}

	public function sendMail(){
		mail($this->destinatario, $this->oggetto, $this->messaggio, $this->mittente);
	}

}

?>
<?php

	require_once('./commons/config.inc.php');

class template{

	protected $templatePath, $templateFile, $templateBase, $templateMobile;
	protected $templateContent;
	protected $config;
	
	public function __construct(){

		$this->templatePath = './templates/';
		$this->templateBase = 'base';
		$this->templateMobile = 'mobile';
		$this->templateFile = '/template.inc.tpl';
		
		$this->config = new config();

		$this->templateContent = file_get_contents($this->getTemplate());
		$this->replaceSection();	
	}

private function replaceSection(){
//rimpiazzo le parti base
	$this->replaceContent('{base_path}', $this->config->getBasePath());
	$this->replaceContent('{nojs}', $this->config->getNoJsLoc());

	if(isset($_SESSION['user'])){

$this->replaceContent('<a href="./login" class="link" title="login">Login</a>', '<a href="./login.php?action=logout" class="link noajx" title="logout">Logout</a>');
$this->replaceContent('<a href="./registrazione" class="link" title="registrazione">Registrati</a>', '');

		if($_SESSION['livello'] >= 2){
			$this->replaceContent('{admin}', '<a href="admin.php" title="Amministrazione">Pannello Amministrazione</a>');
		}
		else{
			$this->replaceContent('{admin}', '');
		}
	}
	else{
		$this->replaceContent('{admin}', '');
	}

}
		
	public function getTemplate(){
	
		if($this->isMobile())
			return $this->templatePath . $this->templateMobile . $this->templateFile;
		return $this->templatePath . $this->templateBase . $this->templateFile;
	}
	
	private function isMobile(){
		$isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
		$isiPod = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPod');
		$isiPhone = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPhone');
		$isAndroid = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Android');
	
		if($isiPhone || $isiPad || $isiPod || $isAndroid)
			return true;
		return false;
	}
	
	public function replaceContent($selector, $content){
		$this->templateContent = str_replace($selector, $content, $this->templateContent);
	}
	
	public function printContent(){
		echo $this->templateContent;
	}
		
}

?>
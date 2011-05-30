<?php

	class xml{

		protected $indent;
	
		public function __construct(){
			header("Content-Type: application/xml; charset=UTF-8");
			$this->indent = 0;
			$this->printXmlHead();
		}
		
		public function __destruct(){
			$this->printXmlFoot();
		}
		
		private function printXmlHead(){
			echo "<?xml version=\"1.0\" ?>\n";
			$this->openTag('data');
		}
		
		private function printXmlFoot(){
			$this->indent--;
			$this->closeTag('data');
		}
		
		public function printTag($nomeTag, $contenuto){
			$this->openTag($nomeTag);

			$this->printIndent();
			echo $contenuto . "\n";

			$this->closeTag($nomeTag);

		}

		public function openTag($nomeTag){
			$this->printIndent();
			echo "<$nomeTag>\n";
			$this->indent++;
		}

		public function openTagP($nomeTag, $parametro){
			$parametro = preg_split('/:/', $parametro);
			$this->printIndent();
			echo "<$nomeTag $parametro[0]=\"$parametro[1]\">\n";
			$this->indent++;
		}

		public function closeTag($nomeTag){
			$this->indent--;
			$this->printIndent();
			echo "</$nomeTag>\n";
		}

		private function printIndent(){
			for($pos=0; $pos<$this->indent; $pos++)
				echo "\t";
		}
		
	}

?>
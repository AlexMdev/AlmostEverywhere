<?php

	class db{
	
		protected $connectDb, $selectDb, $queryIstance, $queryText, $data;
	
		public function __construct($host, $user, $pass, $dbName){
			$this->connectDb = mysql_connect($host, $user, $pass) or die('errore connessione');
 			$this->selectDb = mysql_select_db($dbName, $this->connectDb) or die('errore selezione');
 			$this->data = array();
		}
		
		public function __destruct(){
		/*	if(isset($this->queryIstance))
				mysql_free_result($this->queryIstance);*/
				
			mysql_close($this->connectDb);
		}
		
		public function generateQuery($query){
	
			$this->queryText = $query;
			$this->getDbData();
		}

		public function executeQuery($query){
	
			$this->queryText = $query;
			$this->queryIstance = mysql_query($this->queryText);// or die('errore');
		}
		
		private function getDbData(){
			$this->queryIstance = mysql_query($this->queryText);
//echo mysql_errno($this->connectDb) . ": " . mysql_error($this->connectDb) . "\n";
			while($row = mysql_fetch_assoc($this->queryIstance))
				array_push($this->data, $row);
		}

public function getConnection(){
return $this->connectDb;
}

		public function getAllInfo(){
			return $this->data;
		}
		
		public function getInfo($info){
			return $this->data[$info];
		}

		public function hasResults(){
			if(mysql_num_rows($this->queryIstance) > 0)
				return true;
			else
				return false;
		}

		public function getRows(){
			return array_keys($this->data);
		}
		
		
	}

?>
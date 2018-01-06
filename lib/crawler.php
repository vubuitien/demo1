<?php 
	class Crawler
	{
		public $tits;
		public $contents;
		public $show;
		public $db;
		public $sql;
		public $url;
		public $title;
		public $content;
		public $ch;
		public $convn;
		public $titvn;
		public $ketqua;
		public $link;
		private $host = DB_HOST; 	
		private $dbname = DB_NAME;
		private $username = DB_USERNAME;
		private $pass = DB_PASSWORD;
		public $type = '';
		public $tit = 'title';
		public $con = 'content';

		protected function _connectdb(){
			$this->conn = new mysqli($this->host, $this->username, $this->pass, $this->dbname);
		}
		
		function getContents($sql){
			$this->_connectdb();
			$result = mysqli_query($this->conn, $sql);
	    	$return = array();
	    	while ($row = mysqli_fetch_assoc($result)){
	            $return[] = $row;
	        }
	        return $return;
		}

		function crawl(){
			$ch = curl_init($this->url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$this->ketqua=curl_exec($ch);
			ini_set('display_errors', 'off');
			ini_set('log_errors', 'on');
			ini_set('error_log','php-error.log');
			curl_close($ch);
		}

		function save(){
			$this->_connectdb();

			$string = "INSERT INTO $this->type($this->tit, $this->con) VALUES ('$this->tits', '$this->contents')";
			$query = mysqli_query($this->conn, $string);
		}
	}
?>

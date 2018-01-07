<?php 
	class Crawler
	{
		public $tits;
		public $contents;
		public $show;
		public $db;
		public $sql;
		private $__url;
		public $title;
		public $content;
		public $ch;
		public $convn;
		public $titvn;
		public $ketqua;
		public $link;
		public $host; 	
		public $dbname;
		public $username;
		public $pass;
		public $type = '';
		public $tit = 'title';
		public $con = 'content';

		public function __construct($host, $username, $pass, $dbname){
			$this->host = $host;
			$this->username = $username; 
			$this->pass = $pass;
			$this->dbname = $dbname;
		}
		
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
			mysql_close($this->conn);
		}

		function setURL($url){
			$this->__url = $url;
		}

		function crawl(){
			$ch = curl_init($this->__url);
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
			mysql_close($this->conn);
		}
	}
?>

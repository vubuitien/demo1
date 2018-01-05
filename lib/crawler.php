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
		public $host; 	
		public $dbname;
		public $username;
		public $pass;

		function connectdb(){

			$this->conn = new mysqli($this->host, $this->username, $this->pass, $this->dbname);
		}
		

		function getContents($sql){
			$this->connectdb();

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

		function show_dl(){
			$this->link = $_POST['getlink'];
			$this->url = $this->link;
			$this->crawl();
			
		}

		function save($table, $data){
			$this->connectdb();
			$string = "";
			$string = "INSERT INTO ".$table." (";
			$string .= implode(",", array_keys($data)) . ') VALUES (';
			$string .= "'" . implode("','", array_values($data)) ."')";

			$query = mysqli_query($this->conn, $string);
			if($query){
				return true;
			}

		}
	}


?>

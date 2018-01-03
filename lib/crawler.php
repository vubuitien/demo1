<?php 
	require_once('db.php');
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

		function conndb(){

			$this->conn = new mysqli($this->host, $this->username, $this->pass, $this->dbname);
		}
		function crawl(){
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$this->url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$this->ketqua=curl_exec($ch);
			ini_set('display_errors', 'off');
			ini_set('log_errors', 'on');
			ini_set('error_log','php-error.log');
			curl_close($ch);
		}

		function showdb($sql){
			$this->conndb();

			$result = mysqli_query($this->conn, $sql);
	    	$return = array();
	    	while ($row = mysqli_fetch_assoc($result)){
	            $return[] = $row;
	        }

	        return $return;
		}

		function save($table, $data){
			$string = "INSERT INTO ".$table." (";
			$string .= implode(",", array_keys($data)) . ') VALUES (';
			$string .= "'" . implode("','", array_values($data)) ."')";

			if(mysqli_query($this->conn, $string)){
				return true;
			}else{
				echo mysqli_error($this->conn);
			}

		}

		function get_link(){
			$this->url = $this->link;
			echo $this->crawl();
		}


		function get_info($titl, $cont){
	    	$this->get_link();
		    preg_match($titl, $this->ketqua, $tit_vn);
			preg_match($cont, $this->ketqua, $content_vn);
		    $this->tits = $tit_vn[1];
		    $this->contents = $content_vn[1];

		}

		function show_dl(){
			if(isset($_POST['getlink'])){
				$this->link = $_POST['getlink'];
				$this->get_link();
			}
		}
		
	}

?>

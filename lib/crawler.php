<?php 

	class DB{
		private $host = "localhost"; 	
		private $dbname = "clawler";
		private $username = "root";
		private $pass = "";
		protected $connec;

		public function connect(){
			if(!isset($this->connec)){
				$this->connec = new mysqli($this->host, $this->username, $this->pass, $this->dbname);
				mysqli_set_charset($this->connec, 'utf8');
				if(!$this->connec){
					echo "ket noi false";
					exit;
				}
			}
			return $this->connec;
		}
	}

	class Crawler extends DB
	{
		public $tits;
		public $contents;
		public $show;
		public $sql;
		public $url;
		public $title;
		public $getlink;
		public $content;
		public $post;
		public $ch;
		public $ketqua;
		public $link;

		public function __construct()
		{
			parent::connect();
		}

		//Phương thức lấy dữ liệu từ CSDL
		public function getData($query){
			$result = $this->connec->query($query);
			if($result == false){
				return false;
			}

			$row = array();
			while($row=$result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}
		// Phương thức thực thi lệnh truy vấn
		function execute($query){
			$result = $this->connec->query($query);
			if($result == false){
				return false;
			}else{
				return true;
			}
		}

		// Lấy dữ liệu trong link website

		function get_link(){
			$this->url = $this->link;
			echo $this->crawl();
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
		// End
		
	}

	class ClawlerVN extends Crawler
	{	
		function get_info_vnx(){
	    	$this->get_link();
		    preg_match('/\<h1 class="title_news_detail mb10".*\>(.*)\<\/h1\>/isU', $this->ketqua, $tit_vnx);
			preg_match('/\<article class="content_detail fck_detail width_common block_ads_connect".*\>(.*)\<\/article\>/isU', $this->ketqua, $content_vnx);
		    $this->tits = $tit_vnx[1];
		    $this->contents = $content_vnx[1];
		}
			
		function get_info_vnnet(){
	    	$this->get_link();
		    preg_match('/\<h1 class="title".*\>(.*)\<\/h1\>/isU', $this->ketqua, $tit_vnn);
			preg_match('/\<div id="ArticleContent" class="ArticleContent".*\>(.*)\<\/div\>/isU', $this->ketqua, $content_vnn);
		    $this->tits = $tit_vnn[1];
		    $this->contents = $content_vnn[1];
		}
	}

	
?>

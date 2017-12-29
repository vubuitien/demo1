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
		public $ketqua;
		public $link;
		private $host = DB_HOST; 	
		private $dbname = DB_NAME;
		private $username = DB_USERNAME;
		private $pass = DB_PASSWORD;

		function conn(){

			$this->db = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->pass);
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

		function showvnn(){
			$this->conn();
			$this->post = 'vnn';
			$this->show = $this->db->query("SELECT * FROM $this->post");
			$this->show->execute();
		}

		function save(){
			$this->conn();

			$this->sql = "INSERT INTO $this->post (title, content) VALUES ('$this->title', '$this->content')";
			$this->db->exec($this->sql);
		}

		function get_link(){
			$this->url = $this->link;
			echo $this->crawl();
		}

		function savedb(){
			if(isset($_POST['savevnn'])){
				$this->title = $_POST['savetitvnn'];
				$this->content = $_POST['saveconvnn'];
				$this->save($title,$content);
				exit(header("Location: ./vnn.php"));
			}
		}
/*
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
*/
		function show_dl(){
			if(isset($_POST['getlink'])){
				$this->link = $_POST['getlink'];
				$this->get_link();
			}
		}
		
	}

	class ClawlerVNX extends Crawler
	{	
		function get_info_vnx(){
	    	$this->get_link();
		    preg_match('/\<h1 class="title_news_detail mb10".*\>(.*)\<\/h1\>/isU', $this->ketqua, $tit_vnx);
			preg_match('/\<article class="content_detail fck_detail width_common block_ads_connect".*\>(.*)\<\/article\>/isU', $this->ketqua, $content_vnx);
		    $this->tits = $tit_vnx[1];
		    $this->contents = $content_vnx[1];

		}
		
	}

	class ClawlerVNN extends Crawler
	{	
		function get_info_vnnet(){
	    	$this->get_link();
		    preg_match('/\<h1 class="title".*\>(.*)\<\/h1\>/isU', $this->ketqua, $tit_vnn);
			preg_match('/\<div id="ArticleContent" class="ArticleContent".*\>(.*)\<\/div\>/isU', $this->ketqua, $content_vnn);
		    $this->tits = $tit_vnn[1];
		    $this->contents = $content_vnn[1];
		}
	}

	
?>

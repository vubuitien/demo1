<?php 

	include_once ('crawler.php');
	class VNCrawler extends Crawler
	{
		public $type = 'vnn';
		public function parse(){
			$this->crawl();
		    preg_match('/\<h1 class="title".*\>(.*)\<\/h1\>/isU', $this->ketqua, $tit_vn);
			preg_match('/\<div id="ArticleContent" class="ArticleContent".*\>(.*)\<\/div\>/isU', $this->ketqua, $content_vn);
		    $this->tits = $tit_vn[1];
		    $this->contents = $content_vn[1];
		}
	}
?>

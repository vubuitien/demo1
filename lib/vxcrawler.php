<?php 
	include_once ('crawler.php');
	class VXCrawler extends Crawler
	{
		public $type = 'vnn';
		public function parse(){
			$this->crawl();
		    	preg_match('/\<h1 class="title_news_detail mb10".*\>(.*)\<\/h1\>/isU', $this->ketqua, $tit_vn);
			preg_match('/\<article class="content_detail fck_detail width_common block_ads_connect".*\>(.*)\<\/article\>/isU', $this->ketqua, $content_vn);
		    	$this->tits = $tit_vn[1];
		    	$this->contents = $content_vn[1];
		}
	}
?>

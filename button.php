<?php 
	include ('lib/crawler.php');

	/**
	* 
	*/
	class Button extends ClawlerVN
	{

		function show_dl(){
			if(isset($_POST['getlink'])){
				$this->link = $_POST['getlink'];
				$this->get_link();
			}
		}
		function getdb(){
			if(isset($_POST['gettlink'])){
				$this->getlink = $this->link;
				exit(header("Location: ./index.php"));
			}
		}
	}
?>
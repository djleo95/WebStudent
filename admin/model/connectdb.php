<?php
	/**
	* 
	*/
	class Connectdb {
		//create connection
		private $connect;

		function __construct(){
			//$this->connect = new mysqli("163.44.136.42", "cp177954_sis", "Thuchanhlaptrinhweb", "cp177954_sisDatabase");
			$this->connect = new mysqli("127.0.0.1", "root", "", "websis");
			if($this->connect){
				//print "Kết nối thành công !";
			}
			else{
				print "Kết nối không thành công !";
			}
		}
		function getConnect(){
			return $this->connect;
		}
	}
?>

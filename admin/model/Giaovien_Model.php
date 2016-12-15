<?php 
	include ("connectdb.php");
	/**
	* 
	*/
	class Giaovien_Model
	{
		private $masogiaovien, $khoahocphutrach;

		//gọi sau khi xác định là giáo viên role = 2, $masogiaovien lấy qua hàm
		//getMaSo() của class User

		function __construct()
		{
			parent::connect();
		}

		function __destruct {
			parent::dis_connect();
		}

		function setGiaoVien($masogiaovien)
		{
			$this->masogiaovien = $masogiaovien;
			$db = new Connectdb();
			$connect = $db->getConnect();
			$sql_query = "SELECT makhoahoc from khoahoc where masogiaovien = '$masogiaovien'";
			$result = $connect->query($sql_query);
			$row = $result->fetch_row();
			$this->khoahocphutrach = array();
			while($row = $result->fetch_row()){
				$this->khoahocphutrach[] = $row[0];
			}
			$connect->close();
		}

		function getMaSoGiaoVien(){
			return $this->masogiaovien;
		}

		function getKhoaHocPhuTrach(){
			return $this->khoahocphutrach;
		}

		function updateThongTinKhoaHoc(){
			
		}
		/*$masogiaovien lấy quá hàm getMaSoGiaoVien()
		function getKhoaHocPhuTrach($masogiaovien){
		$db = new Connectdb();
		$connect = $db->getConnect();
		$sql_query = "SELECT makhoahoc from khoahoc where masogiaovien = '$masogiaovien'";
		$result = $connect->query($sql_query);
		$row = $result->fetch_row();
		$connect->close();
		return $row;
		}

		/*function getDanhSachSinhVien($makhoahoc){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$sql_query = "SELECT masosinhvien from dsdangkikhoahoc where makhoahoc = '$makhoahoc'";
			$result = $connect->query($sql_query);
			$row = $result->fetch_row();
			$connect->close();
			return $row;
		}*/
	}
 ?>
<?php
	/**
	* 
	*/
	include ("khoahoc.php");
	class Quanli_Model 
	{
		
		function __construct()
		{
			parent::connect();
		}

		function __destruct {
			parent::dis_connect();
		}
		
		function updateThongTinKhoaHoc($makhoahoc, $tenkhoahoc, $viendaotao, $kihoc, $masogiaovien, $tengiaovien, $phonghoc, $sosvtoithieu, $sosvtoida, $sosvdadangki){
			$khoahoc = new KhoaHoc;
			$khoahoc->updateThongTinKhoaHoc('$makhoahoc', '$tenkhoahoc', '$viendaotao', '$kihoc', '$masogiaovien', '$tengiaovien', '$phonghoc', '$sosvtoithieu', '$sosvtoida', '$sosvdadangki');
		}

		//1 giáo viên có thể dạy nhiều khóa học nhưng ko đc trùng tkb
		function phancongGiaoVien($makhoahoc, $tengiaovien){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$stmt = $connect->stmt_init();
			if ($stmt->prepare("INSERT INTO khoahoc(tengiaovien) VALUES ('?') WHERE makhoahoc =?")){
				$stmt->bind_param("ss", $tengiaovien, $makhoahoc);
				$stmt->execute();
				$stmt->close();
			}
			$connect->close();
		}

		function getKiHoc(){
			//$db = new Connectdb();
			//$connect = $db->getConnect();
			$sql_query = "SELECT kihoc from dotdangki";
			//$result = $connect->query($sql_query);
			$result = $this->__conn->query($sql_query);
			$row = $result->fetch_row();
			$connect->close();
			return $row;
		}
		//mở đợt đăng kí theo kì học

		//return 0 nếu ko có, 1 nếu hợp lí, 2 nếu hiện tại ko trong đợt dki

		function getNgayDangKi(){
			$sql_query = "SELECT ngaybatdaudangki FROM dotdangki";
			$result = $this->__conn->query($sql_query);
			if($result->fetch_row()){
				$ngaydangki = $result->fetch_row();
				$ngaydangki = strtotime($ngaydangki);
				$ngaydangki = date("Y/m/d", $ngaydangki);
				return $ngaydangki;
			}
			else{

			}
		}

		function getNgayKetThuc(){
			$sql_query = "SELECT ngayketthucdangki FROM dotdangki";
			$result = $this->__conn->query($sql_query);
			if($result->fetch_row()){
				$ngayketthuc = $result->fetch_row();
				$ngayketthuc = strtotime($ngayketthuc);
				$ngayketthuc = date("Y/m/d", $ngayketthuc);
				return $ngayketthuc;
			}
			else{

			}
		}
		function checkDotDangKi(){
			$today = date("Y/m/d");
			$sql_query = "SELECT ngaybatdaudangki FROM dotdangki";
			$result = $this->__conn->query($sql_query);
			if($result->fetch_row()){
				$ngaydangki = $result->fetch_row();
			}
			else{
				return 0;
			}
			$sql_query = "SELECT ngayketthucdangki FROM dotdangki";
			$result = $this->__conn->query();
			if($result->fetch_row()){
				$ngayketthuc = $result->fetch_row();
			}
			else{
				return 0;
			}
			if($today >= $ngaydangki && $today <= $ngayketthuc){
				return 1;
			}
			else{
				return 2;
			}
		}

		function moDotDangKi($kihoc, $ngaybatdaudangki, $ngayketthucdangki){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$stmt = $connect->stmt_init();
			if ($stmt->prepare("INSERT INTO dotdangki(kihoc, ngaybatdaudangki, ngayketthucdangki) VALUES ('?', '?', '?')")){
				$stmt->bind_param("sss", $kihoc, $ngaybatdaudangki, $ngayketthucdangki);
				$stmt->execute();
				$stmt->close();
			}
			$connect->close();
		}

		//tìm trong những kì học đã mở dki rồi tiến hành đóng đăng kí nếu muốn
		function dongDotDangKi($kihoc){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$stmt = $connect->stmt_init();
			if ($stmt->prepare("DELETE FROM dotdangki where kihoc ='?'")){
				$stmt->bind_param("s", $kihoc);
				$stmt->execute();
				$stmt->close();
			}
			$connect->close();
		}
	}
?>
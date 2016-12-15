<?php
	/**
	* 
	*/
	include("connectdb.php");
	class Khoahoc_Model
	{
		private $makhoahoc, $tenkhoahoc, $viendaotao, $kihoc, $masogiaovien, $tengiaovien, $thoikhoabieu, $phonghoc, $sosvtoithieu, $sosvtoida, $sosvdadangki, $ngaybatdaudangki, $ngayketthucdangki;
		function __construct()
		{
			parent::connect();
		}

		function __destruct {
			parent::dis_connect();
		}
		
		function setKhoaHoc($makhoahoc, $tenkhoahoc, $viendaotao, $kihoc, $masogiaovien, $tengiaovien, $phonghoc, $sosvtoithieu, $sosvtoida, $sosvdadangki)
		{
			$this->makhoahoc = $makhoahoc;
			$this->tenkhoahoc = $tenkhoahoc;
			$this->viendaotao = $viendaotao;
			$this->kihoc = $kihoc;
			$this->masogiaovien = $masogiaovien;
			$this->tengiaovien = $tengiaovien;
			$this->phonghoc = $phonghoc;
			$this->sosvtoithieu = $sosvtoithieu;
			$this->sosvtoida = $sosvtoida;
			$this->sosvdadangki = $sosvdadangki;
			$db = new Connectdb();
			$connect = $db->getConnect();
			$sql_query = "INSERT INTO khoahoc(makhoahoc, tenkhoahoc, viendaotao, kihoc, masogiaovien, tengiaovien, phonghoc, sosvtoithieu, sosvtoida, sosvdadangki, ngaybatdaudangki, ngayketthucdangki) VALUES ( '$makhoahoc', '$tenkhoahoc', '$viendaotao' , '$kihoc', '$masogiaovien', '$tengiaovien', '$phonghoc', '$sosvtoithieu', '$sosvtoida', '$sosvdadangki')";
			$result  = $connect->query($sql_query);
			$connect->close();
			if($result) return 1;
			else return -1;
		}

		function getDanhSachKhoaHoc(){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$sql_query = "SELECT * from khoahoc";
			$result = $connect->query($sql_query);
			$row = $result->fetch_row();
			$connect->close();
			return $row;
		}

		//dùng khi tìm thông tin khóa học, nhập mã kh vào để tìm
		function getKhoaHocQuaMaKH($makhoahoc){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$stmt = $connect->stmt_init();
			if ($stmt->prepare("SELECT * from khoahoc where makhoahoc =?")){
				$stmt->bind_param("s", $makhoahoc);
				$stmt->execute();
				$result = $stmt->get_result(); //trả về 1 resultset ko phải 1 trường duy nhất như bind_result()
				$row = $result->fetch_row();
				$stmt->close();
			}
			$connect->close();
			return $row;
			/*
			$sql_query = "SELECT * from khoahoc where makhoahoc =?";
			$result = $connect->query($sql_query);
			$row = $result->fetch_row();
			$connect->close();
			return $row;
			*/
		}

		//dùng khi tìm thông tin khóa học, nhập tên kh vào để tìm
		function getKhoaHocQuaTenKH($tenkhoahoc){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$tenkhoahocdb = "%$tenkhoahoc%";
			$stmt = $connect->stmt_init();
			if ($stmt->prepare("SELECT * from khoahoc where tenkhoahoc like ?")){
				$stmt->bind_param("s", $tenkhoahocdb);
				$stmt->execute();
				$result = $stmt->get_result(); //trả về 1 resultset ko phải 1 trường duy nhất như bind_result()
				$row = $result->fetch_row();
				$stmt->close();
			}
			$connect->close();
			return $row;
		}

		function getKhoaHocQuaVien($viendaotao){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$stmt = $connect->stmt_init();
			if ($stmt->prepare("SELECT * from khoahoc where viendaotao =?")){
				$stmt->bind_param("s", $viendaotao);
				$stmt->execute();
				$result = $stmt->get_result(); //trả về 1 resultset ko phải 1 trường duy nhất như bind_result()
				$row = $result->fetch_row();
				$stmt->close();
			}
			$connect->close();
			return $row;
		}

		function getSoTinChiKhoaHoc($makhoahoc){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$sql_query = "SELECT sotinchi from khoahoc where makhoahoc = '$makhoahoc'";
			$result = $connect->query($sql_query);
			$sotinchi = $result->fetch_row();
			$connect->close();
			return $row[0];
		}
		
		function getThoiKhoaBieu_Thu($makhoahoc){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$sql_query = "SELECT thu from thoikhoabieu where makhoahoc = '$makhoahoc'";
			$result = $connect->query($sql_query);
			$row = $result->fetch_row();
			$connect->close();
			return $row;
		}

		function getThoiKhoaBieu_Tiet($makhoahoc){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$sql_query = "SELECT thiet from thoikhoabieu where makhoahoc = '$makhoahoc'";
			$result = $connect->query($sql_query);
			$row = $result->fetch_row();
			$connect->close();
			return $row;
		}
		
		function getSoSvToiThieu($makhoahoc){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$sql_query = "SELECT sosvtoithieu from khoahoc where makhoahoc = '$makhoahoc'";
			$result = $connect->query($sql_query);
			$row = $result->fetch_row();
			$connect->close();
			return $row[0];
		}

		function getSoSvToiDa($makhoahoc){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$sql_query = "SELECT sosvtoida from khoahoc where makhoahoc = '$makhoahoc'";
			$result = $connect->query($sql_query);
			$row = $result->fetch_row();
			$connect->close();
			return $row[0];
		}

		function getSoSvDaDangKi($makhoahoc){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$sql_query = "SELECT sosvdadangki from khoahoc where makhoahoc = '$makhoahoc'";
			$result = $connect->query($sql_query);
			$row = $result->fetch_row();
			$connect->close();
			return $row[0];
		}

		//admin dùng phương thức này để update tt
		function updateThongTinKhoaHoc($makhoahoc1, $makhoahoc2, $tenkhoahoc, $viendaotao, $kihoc, $masogiaovien, $tengiaovien, $phonghoc, $sosvtoithieu, $sosvtoida, $sosvdadangki){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$sql_query = "UPDATE khoahoc SET makhoahoc = '$makhoahoc2', tenkhoahoc= '$tenkhoahoc', viendaotao = '$viendaotao', kihoc = '$kihoc', masogiaovien = '$masogiaovien', tengiaovien= '$tengiaovien', phonghoc = '$phonghoc', sosvtoithieu = '$sosvtoithieu', sosvtoida = '$sosvtoida', sosvdadangki = '$sosvdadangki' WHERE makhoahoc = '$makhoahoc1'";
			$result = $connect->query($sql_query);
			$connect->close();
			if($result) return 1;
			else return -1;
		}
	}
?>


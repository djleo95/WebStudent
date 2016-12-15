<?php
	/**
	* 
	*/
	include ("khoahoc.php");
	class Sinhvien_Model extends Sis_Model
	{
		private $masosinhvien;
		//
		function __construct()
		{
			parent::connect();
		}

		function __destruct {
			parent::dis_connect();
		}
		//sử dụng khi chỉ cần đối tượng sv ko cần mssv để thực hiện phương thức
		function createSinhVien($masosinhvien){
			$this->masosinhvien = $masosinhvien;
		}

		function getMaSoSinhVien(){
			return $this->masosinhvien;
		}
		
		//kiểm tra số sv đăng kí < max số sv đăng kí rồi dùng phương thức này
		//return -1 nếu đăng kí không thành công
		function dangkiKhoaHoc($makhoahoc){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$masosinhvien = $this->masosinhvien;
			$stmt = $connect->stmt_init();
			if ($stmt->prepare("INSERT INTO dsdangkikhoahoc(masosinhvien, makhoahoc) VALUES (?, ?)")){
				$stmt->bind_param("ss", $masosinhvien, $makhoahoc);
				$stmt->execute();
				$stmt->close();
			}
			else {
				$connect->close();
				return -1;
			}

			$khoahoc = new KhoaHoc();
			$sosvdadangki = $khoahoc->getSoSvDaDangKi($makhoahoc);
			$sosvdadangki = $sosvdadangki + 1;
			if ($stmt->prepare("UPDATE khoahoc SET sosvdadangki = '$sosvdadangki'
				where makhoahoc =?")){
				$stmt->bind_param("s", $makhoahoc);
				$stmt->execute();
				$stmt->close();
			}
			else{
				$connect->close();
				return -1;
			}
		}

		function timKhoaHocQuaMaKH($makhoahoc){
			$khoahoc = new KhoaHoc();
			return $khoahoc->getKhoaHocQuaMaKH($makhoahoc);
		}

		function timKhoaHocQuaTenKH($tenkhoahoc){
			$khoahoc = new KhoaHoc();
			return $khoahoc->getKhoaHocQuaTenKH($tenkhoahoc);
		}

		function getDanhSachSVDangKi($makhoahoc){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$stmt = $connect->stmt_init();	
			if ($check = $stmt->prepare("SELECT masosinhvien, hoten, lop FROM sinhvien where masosinhvien IN (SELECT masosinhvien FROM dsdangkikhoahoc where makhoahoc =?)")){
				$stmt->bind_param("s", $makhoahoc);
				$stmt->execute();
				$result = $stmt->get_result(); //trả về 1 resultset ko phải 1 trường duy nhất như bind_result()
				$danhsachsv = array();
				while($row = $result->fetch_row()){
					$danhsachsv[] = $row;
				}
				$stmt->close();
			}	
			$connect->close();
			return $danhsachsv;
		}

		function getDanhSachKHDangKi($kihoc){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$masosinhvien = $this->masosinhvien;
			$sql_query = "SELECT makhoahoc, tenkhoahoc, sotinchi FROM khoahoc WHERE kihoc = '$kihoc' AND makhoahoc IN(SELECT makhoahoc FROM dsdangkikhoahoc WHERE masosinhvien = '$masosinhvien')";
			$result = $connect->query($sql_query);
			$dskhoahocdangki = array();
			while ($row = $result->fetch_row()) {
				$dskhoahocdangki[] = $row;
			}
			$connect->close();
			return $dskhoahocdangki;
		}

		function getTongSoTinChiDaDangKi($kihoc){
			$db = new Connectdb();
			$connect = $db->getConnect();
			$masosinhvien = $this->masosinhvien;
			$tongsotinchi = 0;
			$sql_query = "SELECT sotinchi FROM khoahoc WHERE kihoc = '$kihoc' AND makhoahoc IN(SELECT makhoahoc FROM dsdangkikhoahoc WHERE masosinhvien = '$masosinhvien')";
			$result = $connect->query($sql_query);
			while ($row = $result->fetch_row()) {
				$tongsotinchi = $tongsotinchi + $row[0];
			}
			$connect->close();
			return $tongsotinchi;
		}
	}
?>
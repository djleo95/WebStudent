<?php
	class User_Model extends Sis_Model
	{
		private $username, $password, $role, $maso;

		function __construct(){
			parent::__construct();
		}

		function setUser($username, $password){
			$this->username = $username;
			$this->password = $password;


			$sql_query = "SELECT role FROM user where username = '$username' and password = '$password'";
			$result = $this->__conn->query($sql_query);
			if($row = $result->fetch_row()){
				$this->role = $row[0];
			}
			$sql_query = "SELECT maso FROM user where username = '$username' and password = '$password'";
			$result = $this->__conn->query($sql_query);
			if($row = $result->fetch_row()){
				$this->maso = $row[0];
			}
		}

		//return quyền cua nguoi dung
		function getRole(){
			return $this->role;
		}

		function getMaSo(){
			return $this->maso;
		}
		
		//kiem tra đăng nhập
		function checkUser($username, $password){
			
			//check username neu ko ton tai return 1
			$stmt = $this->__conn->stmt_init();
			if ($stmt->prepare("SELECT username FROM user WHERE username=?")){
				$stmt->bind_param("s", $username);
				$stmt->execute();
				$stmt->bind_result($usernamecheck);
				$stmt->fetch();
				//$result = $stmt->get_result();
				//$row = $result->fetch_row();
				if(is_null($usernamecheck)){
					$this->dis_connect();
					return 1;
				}
			}
			//check password cua username nếu ko đúng return 2
			$stmt = $this->__conn->stmt_init();
			if ($stmt->prepare("SELECT password FROM user WHERE username=?")){
				$stmt->bind_param("s", $username);
				$stmt->execute();
				$stmt->bind_result($passwordcheck);
				$stmt->fetch();
				if($passwordcheck != $password){
					return 2;
				}
			}
			//a quen swift ==
			/*
			//check username neu ko ton tai return 1
			$sql_query1 = "SELECT username from user where username = '$username'";
			$result1 = $connect->query($sql_query1);
			$row1 = $result1->fetch_row();
			if(is_null($row1[0])){
				return 1;
			}
			//check password cua username nếu ko đúng return 2
			$sql_query2 = "SELECT password from user where username = '$username'";
			$result2 = $connect->query($sql_query2);
			$row2 = $result2->fetch_row();
			if($row2[0] != $password){
				$connect->close();
				return 2;
			}
			*/
		}

		// public function __destruct() {
		// 	parent::dis_connect();
		// }
	}
?>
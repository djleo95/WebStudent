<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Login_Controller extends Base_Controller
{
    public function indexAction()
    {
		$data = array(
            'title' => 'Đăng nhập vào trang quản lí'
        );

        $this->view->load('login', $data);
    }

    public function loginAction() {
    	//echo "Done login";
        $username = $_POST["txtTenDangNhap"];
        $password = $_POST["txtMatKhau"];
        $this->model->load('user');
        $check = $this->model->user->checkUser($username, $password);
        if($check == 1){
            echo "<div class='error'><br><div align='center'>Sai Username. <br>";
            echo " <a href='".$_SERVER["PHP_SELF"]."'> Thử lại </a> </div> </div><br>";
        }
        elseif($check == 2){
            echo "<div class='error'><br><div align='center'>Sai Password. <br>";
            echo " <a href='".$_SERVER["PHP_SELF"]."'> Thử lại </a> </div> </div><br>";
        }
        else{
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            $this->model->user->setUser($username, $password);
            $role = $this->model->user->getRole();
            if($role == 1){
                $data = array('title' => 'Trang chủ admin');
                $this->view->load('trangchuadmin', $data);
            }
            elseif($role ==2){
                $data = array('title' => 'Trang chủ giáo viên');
                $this->view->load('trangchugv', $data);
            }
            elseif ($role == 3) {
                $data = array('title' => 'Trang chủ sinh viên');
                $this->view->load('trangchusv', $data);
            }
        }
    }
}
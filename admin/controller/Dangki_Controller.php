<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Dangki_Controller extends Base_Controller
{
	public function indexAction()
    {
    	$this->model->load('quanli');
    	$checkngay = $this->model->quanli->checkDotDangKi();
    	if($checkngay == 0){
    		echo "<div class='error'><br><div align='center'>Hiện tại không có đợt đăng kí nào ! <br>";
    	}
    	elseif($checkngay == 2{
    		$ngaydangki = $this->model->quanli->getNgayDangKi();
    		$ngayketthuc = $this->model->quanli->getNgayKetThuc();
    		echo "<div class='error'><br><div align='center'>Hiện tại không trong thời gian đăng kí ! <br> Thời gian đăng kí là : $ngaydangki - $ngayketthuc <br>";
    	}
    	else{
    		$this->model->load('quanli');
    	}
    	}
		$data = array(
            'title' => 'Đăng kí',

        );

        $this->view->load('dangki', $data);
    }


}
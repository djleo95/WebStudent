<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Sis_Controller
{
    // Đối tượng view
    protected $view     = NULL;
    
    // Đối tượng model
    protected $model    = NULL;
    
    // Đối tượng library
    protected $library  = NULL;
    
    // Đối tượng helper
    protected $helper   = NULL;
    
    // Đối tượng config
    protected $config   = NULL;
    
    /**
	 * Hàm khởi tạo
     * 
     * @desc    Load các thư viện cần thiết
	 */
    public function __construct() 
    {
        // Loader cho config
        require_once PATH_SYSTEM . '/core/loader/Sis_Config_Loader.php';
        $this->config   = new Sis_Config_Loader();
        $this->config->load('config');

        // Load View
        require_once PATH_SYSTEM . '/core/loader/Sis_View_Loader.php';
        $this->view = new Sis_View_Loader();

        // Load Model
        require_once PATH_SYSTEM . '/core/loader/Sis_Model_Loader.php';
        $this->model = new Sis_Model_Loader();
    }
}


//// Require 2 file model and view
//require_once PATH_SYSTEM . '/core/loader/Sis_Model_Loader.php';
//require_once PATH_SYSTEM . '/core/loader/Sis_View_Loader.php';
//require_once PATH_SYSTEM . '/core/loader/Sis_Library_Loader.php';
//require_once PATH_SYSTEM . '/core/loader/Sis_Helper_Loader.php';
//$this->model    = new Sis_Model_Loader();
//$this->view     = new Sis_View_Loader();
//$this->library  = new Sis_Library_Loader();
//$this->helper   = new Sis_Helper_Loader();
//
//// Config
//$this->config   = include PATH_APPLICATION . '/config/config.php';
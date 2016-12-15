<?php
/**
 * @package		Sis_Framework
 * @author		Freetuts Dev Team
 * @email       freetuts.net@gmail.com
 * @copyright	Copyright (c) 2015
 * @since		Version 1.0
 * @filesource  system/core/loader/Sis_Model_Loader.php
 */

class Sis_Model_Loader
{   
    /**
	 * Load model
     * 
	 * @param 	string
     * @desc    hàm load model, tham số truyền vào là tên của model và các biến truyền vào hàm khởi tạo
	 */
    public function load($model, $args = null)
    {
        // Nếu model chưa load thì tiến hành load
        if (empty($this->{$model})){
            include_once PATH_SYSTEM . '/core/Sis_Model.php';
            $class = ucfirst($model) . '_Model';
            require_once(PATH_APPLICATION . '/model/' . $class . '.php');
            $this->{$model} = new $class($args);
        }
    }
}
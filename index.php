<?php

// Đường dẫn tới hệ  thống
define('PATH_SYSTEM', __DIR__ .'/system');
define('PATH_APPLICATION', __DIR__ . '/admin');
define('PATH_TEMPLATE', __DIR__ . '/public/template');
define('PATH_CSS', __DIR__ . '/public/css');
// Lấy thông số cấu hình
require (PATH_SYSTEM . '/config/config.php');

//mở file Sis_Common.php, file này chứa hàm Sis_Load() chạy hệ thống
include_once PATH_SYSTEM . '/core/Sis_Common.php';

// Chương trình chính
Sis_load();
<?php
// Thư Viện Xử Lý Database
class Sis_Model
{
    // Biến lưu trữ kết nối
    protected $__conn;
    
    // Biến lưu trữ kết quả truy vấn
    protected $_result = NULL;

    public function __construct() {
        $this->connect();
    }
    
    // Hàm Kết Nối
    public function connect()
    {
        // Nếu chưa kết nối thì thực hiện kết nối
        if (!$this->__conn){
            $this->__conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('Lỗi kết nối');
            mysqli_query($this->__conn, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
        }
    }
 
    // Hàm Ngắt Kết Nối
    public function dis_connect()
    {
        if ($this->__conn){
            mysqli_close($this->__conn);
        }
    }

    
    public function get_result()
    {
        $result_tmp = array();
        if ( ! empty($this->_result)){
            while ($row = mysql_fetch_array($result)){
                array_push($result_tmp, $row);
            }
        }
        return $result_tmp;
    }
 
    // Hàm Insert
    public function insert($table, $data)
    {
        // Lưu trữ danh sách field
        $field_list = '';
        // Lưu trữ danh sách giá trị tương ứng với field
        $value_list = '';
 
        // Lặp qua data
        foreach ($data as $key => $value){
            $field_list .= ",$key";
            $value_list .= ",'".mysql_escape_string($value)."'";
        }
 
        // Vì sau vòng lặp các biến $field_list và $value_list sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
        $sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
 
        return mysqli_query($this->__conn, $sql);
    }
 
    // Hàm Update
    public function update($table, $data, $where)
    {
        $sql = '';
        // Lặp qua data
        foreach ($data as $key => $value){
            $sql .= "$key = '".mysql_escape_string($value)."',";
        }
 
        // Vì sau vòng lặp biến $sql sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;
 
        return mysqli_query($this->__conn, $sql);
        '
            
        ';
    }
 
    // Hàm delete
    public function remove($table, $where)
    {
        $sql = "DELETE FROM $table WHERE $where";
        return mysqli_query($this->__conn, $sql);
    }
 
    // Hàm lấy danh sách
    public function execute($sql)
    { 
        $result = mysqli_query($this->__conn, $sql);
 
        if (!$result){
            $this->_result = NULL;
            return FALSE;
        }
        
        $this->_result = $result;
        return TRUE;
    }
}
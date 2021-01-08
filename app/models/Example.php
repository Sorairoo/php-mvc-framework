<?php
namespace App\Models;
use \PDO;
class Example {
    
    protected $conn;
    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }
    public function all()
    {
        $result = [];
        $sql = 'select * from posts';
        $stm = $this->conn->query($sql);
       
       
        if($stm && $stm->rowCount()){
            
            $result =  $stm->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    
    }
    
   
}

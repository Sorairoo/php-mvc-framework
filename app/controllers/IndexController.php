<?php

namespace App\Controllers;
use PDO;
use App\Models\Example;

class IndexController extends BaseController

{
    protected $Model;
    public function __construct(PDO $conn) {

        parent::__construct($conn);
        $this->Model = new Example($conn);

      
    }
 
    public function homePage(){
        $example=$this->Model->all();

        $this->content =  view('homepage', compact('example'));
    }
    public function test(){

        $this->content =  view('test', compact([]));
    }
}
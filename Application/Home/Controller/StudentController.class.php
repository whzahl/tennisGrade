<?php 
/* 
 * 考生模块
 *  */

namespace Home\Controller;
use Home\Controller\CheckController;

class StudentController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}

    public function index(){
        $province = M('tg_province')->select();
        $this->province = $province;
	    $this->display();
    }





}
<?php 
/* 
 * 直播模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class LiveController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}


	public function index(){
		$this->display();
	}
	
	public function add(){
		$this->display();
	}
	
	public function edit(){
		$this->display();
	}




}
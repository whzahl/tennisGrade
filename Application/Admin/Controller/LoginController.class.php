<?php
/* 
 * 登录模块
 *  */
namespace Admin\Controller;
use Admin\Controller\CheckController;

class LoginController extends CheckController{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function login(){
		$str = urlencode('www.zhongaotech.com');
		echo $str;
		$this->display();
	}
	public function weixinlogin(){
		$this->display();
	}
	
}




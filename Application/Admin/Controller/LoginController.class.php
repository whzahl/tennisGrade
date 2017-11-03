<?php
/* 
 * 登录模块
 *  */
namespace Admin\Controller;
use Admin\Controller\BaseController;

class LoginController extends BaseController{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function login(){
//		$str = urlencode('www.zhongaotech.com');
//		echo $str;


		$this->display();
	}
	public function weixinlogin(){
		$this->display();
	}
	public function loginout(){
		session('Type',null);
    	$this->success("退出成功",'/Admin/Login/login');
	}
	public function homelogin(){
		$type=I('get.type');
    	$pid = I('get.pid');
    	$pdata = M('tg_place')->where(array('pid'=>$pid))->find();
    	if (!empty($pdata)) {
	        session('Type',array(
	    	'type' => $type,
	    	'uid' => $pid,
	    	'uname'=>$pdata['pname']
	    	));
	        $this->success('登录成功！','/Admin/Index/index');
    	}else {
    		$this->error('登录失败！');
    	}
    	
	}
}




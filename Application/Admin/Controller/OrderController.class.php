<?php
/* 
 * 订单模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class OrderController extends CheckController{
	
	public function __construct(){
		parent::__construct();
	}
	
<<<<<<< HEAD
	public function index(){
		$intCount = D('Order','Service') ->count($arrWhere);
		$Page = new \Think\Page($intCount,10);
		$show =  $Page ->show();
		$first =  $Page->firstRow;
		$list = $Page->listRows;
		$arrData = D('Order','Service') ->findAll($arrWhere,$first,$list);
		$this-> count = $intCount;
		$this-> page = $show;
		$this-> list = $arrData;
		$this->display();
	}
=======
	
>>>>>>> 7a5f72a3869f79d153204755c2996470b12fee66
	
}



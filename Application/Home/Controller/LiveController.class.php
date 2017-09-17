<?php 
/* 
 * 直播模块
 *  */

namespace Home\Controller;
use Home\Controller\BaseController;

class LiveController extends BaseController{
      
	public function __construct(){
		parent::__construct();
	}

    public function index(){
    	$arrData = D('Live','Service')-> findAll($arrWhere);
    	$this-> list = $arrData;
        $this->display();
    }

}
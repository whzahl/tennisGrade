<?php 
/* 
 * 介绍模块
 *  */

namespace Home\Controller;
use Home\Controller\BaseController;

class IntroController extends BaseController{
      
	public function __construct(){
		parent::__construct();
	}

	public function index(){
	    $this->display();
    }

    public function content(){
	    $arrWhere['inid'] = I('get.inid');
	    $arrData = D('Intro','Service')->findOne($arrWhere);
	    $this->list = $arrData;
	    $this->display();
    }




}


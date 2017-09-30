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
	    switch ($arrWhere['inid']){
            case 1: $chTitle = '平台简介';
                    $enTitle = 'Platform Introduction';
                    break;
            case 2: $chTitle = '考级简介';
                    $enTitle = 'Test Introduction';
                    break;
            case 4: $chTitle = '考级内容';
                $enTitle = 'Test Content';
                break;
            case 5: $chTitle = '证书样板';
                $enTitle = 'Certificate Template';
                break;
            case 6: $chTitle = '考点协议';
                $enTitle = 'Place Agreement';
                break;
            case 7: $chTitle = '考官协议';
                $enTitle = 'Teacher Agreement';
                break;
            case 8: $chTitle = '报名协议';
                $enTitle = 'Student Agreement';
                break;
            default: $chTitle = '平台简介';
                $enTitle = 'Platform Introduction';

        }
	    $arrData = D('Intro','Service')->findOne($arrWhere);
	    $this->list = $arrData;

        $this->chTitle = $chTitle;
        $this->enTitle = $enTitle;
	    $this->display();
    }




}


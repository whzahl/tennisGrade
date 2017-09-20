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
    	$this->list = $arrData;

        $province =  M('tg_province')->select();
        $this->province = $province;
        $this->display();
    }

    public function live(){
        $code  = I("get.code");
        $name  = I("get.name");
        $arrData = array();
        $i = 0;
        $arrWhere1[$name] = $code;
        $place = D('Place','Service')->findAll($arrWhere1);
        foreach ($place as $k=>$val){
            $pid = $val['pid'];
            $arrWhere2['pid'] = $pid;
            $arrData[$i++] = D('Live','Service')->findAll($arrWhere2);
        }
        $this->ajaxReturn($arrData,'json');
    }

}
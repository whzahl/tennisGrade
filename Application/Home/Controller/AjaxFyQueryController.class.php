<?php

namespace Home\Controller;
use Home\Controller\BaseController;

class AjaxFyQueryController extends BaseController{

    public function __construct(){
        parent::__construct();
    }

    public function initQuery(){
        $db = I('get.db');//目标数据表
        $num = I('get.num');//每页数据
        $arrData = D($db,'Service')->findAll($arrWhere, $skip, $num);
        $this->ajaxReturn($arrData,'json');
    }

    Public function initAmount(){
        $db = I('get.db');//目标数据表
        $arrData = D($db,'Service')->countAll();
        $this->ajaxReturn($arrData,'json');
    }
    public function ajaxFy(){
        $db = I('get.db');//目标数据表
        $page = I('get.page');//第几页
        $num = I('get.num');//每页数据
        $code = I('get.code');
        $name = I('get.name');
        $skip = ($page-1)*$num;

        $arrWhere[$name] = array('like','%'.$code.'%');
        $arrData = D($db,'Service')->findAll($arrWhere, $skip, $num);
//        $arrData[0]['sum'] = D($db,'Service')->count($arrWhere);
        $this->ajaxReturn($arrData,'json');
    }

    public function amount(){
        $db = I('get.db');
        $code = I('get.code');
        $name = I('get.name');
        $arrWhere[$name] = array('like','%'.$code.'%');
        $amount = D($db,'Service')->countWhere($arrWhere);
        $this->ajaxReturn($amount,'json');
    }
    public function AssociationDb(){
        $db = I('get.db');
        $code = I('get.code');
        $name = I('get.name');
        $arrWhere[$name] = $code;
        $arrData = D($db,'Service')->findAll($arrWhere);
        $this->ajaxReturn($arrData,'json');
    }
}

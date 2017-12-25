<?php

namespace Home\Controller;

use Home\Controller\BaseController;

class AjaxFyQueryController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function initQuery()
    {
        $db = I('get.db');//目标数据表
        $num = I('get.num');//每页数据
        if($db == 'Place' || $db == 'Teacher'){
            $arrWhere['status'] = 1;
        }
        $arrData = D($db, 'Service')->findAll($arrWhere, $skip, $num);
        $this->ajaxReturn($arrData, 'json');
    }

    public function initTeacherQuery()
    {
        $db = I('get.db');//目标数据表
        $num = I('get.num');//每页数据
        $arrData = array();
        $i = 0;
        if($db == 'Place' || $db == 'Teacher'){
            $arrWhere['status'] = 1;
        }
        $arrData[0] = D($db, 'Service')->findAll($arrWhere, $skip, $num);
        foreach ($arrData[0] as $val){
            $arrWhere1['pid'] = $val['pid'];
            $arrData[1][$i++] = D('Place','Service')->findOne($arrWhere1);
        }
        $this->ajaxReturn($arrData,'json');
    }

    Public function initAmount()
    {
        $db = I('get.db');//目标数据表
        if($db == 'Place' || $db == 'Teacher'){
            $arrWhere['status'] = 1;
        }
        $arrData = D($db, 'Service')->count($arrWhere);
        $this->ajaxReturn($arrData, 'json');
    }

    public function ajaxFy()
    {
        $db = I('get.db');              //目标数据表
        $page = I('get.page');          //第几页
        $num = I('get.num');            //每页数据
        $code = I('get.code');
        $name = I('get.name');
        $skip = ($page - 1) * $num;
        if($db == 'Place' || $db == 'Teacher'){
            $arrWhere['status'] = 1;
        }
        $arrWhere[$name] = array('like', '%' . $code . '%');
        $arrData = D($db, 'Service')->findAll($arrWhere, $skip, $num);
        $this->ajaxReturn($arrData, 'json');
    }

    public function ajaxTeacherFy()
    {
        $db = I('get.db');              //目标数据表
        $page = I('get.page');          //第几页
        $num = I('get.num');            //每页数据
        $code = I('get.code');
        $name = I('get.name');
        $skip = ($page - 1) * $num;
        $arrData = array();
        $i = 0;
        if($db == 'Place' || $db == 'Teacher'){
            $arrWhere['status'] = 1;
        }
        $arrWhere[$name] = array('like', '%' . $code . '%');
        $arrData[0] = D($db, 'Service')->findAll($arrWhere, $skip, $num);
        foreach ($arrData[0] as $val) {
            $arrWhere1['pid'] = $val['pid'];
            $arrData[1][$i++] = D('Place','Service')->findOne($arrWhere1);
        }

        $this->ajaxReturn($arrData, 'json');
    }

    public function amount()
    {
        $db = I('get.db');
        $code = I('get.code');
        $name = I('get.name');
        if($db == 'Place' || $db == 'Teacher'){
            $arrWhere['status'] = 1;
        }
        $arrWhere[$name] = array('like', '%' . $code . '%');
        $amount = D($db, 'Service')->count($arrWhere);
        $this->ajaxReturn($amount, 'json');
    }

    public function AssociationDb()
    {
        $db = I('get.db');
        $code = I('get.code');
        $name = I('get.name');
        $arrWhere[$name] = $code;
        $arrData = D($db, 'Service')->findOne($arrWhere);
        $this->ajaxReturn($arrData, 'json');
    }
}

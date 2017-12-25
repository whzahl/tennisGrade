<?php 
/* 
 * 公告模块
 *  */

namespace Home\Controller;
use Home\Controller\BaseController;

class NoticeController extends BaseController{
      
	public function __construct(){
		parent::__construct();
	}

    public function index(){

        $intCount = D('Notice','Service')->count($arrWhere);
        $Page = new \Think\Page($intCount,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $first = $Page->firstRow;
        $list = $Page->listRows;
        $arrData = D('Notice','Service')->findAll($arrWhere,$first,$list);
        $this->count = $intCount;
        $this->page = $show;
        $this->list = $arrData;

//        var_dump($arrData);
//        exit();

        $chTitle = '考试公告';
        $enTitle = 'Examination Notice';
        $this->chTitle = $chTitle;
        $this->enTitle = $enTitle;
        $this->display();
    }

    public function content(){
        $arrWhere['noid']  = I('get.noid');
        $arrData = D('Notice','Service')->findOne($arrWhere);
        $chTitle = '公告内容';
        $enTitle = 'Notice Content';
        $this->chTitle = $chTitle;
        $this->enTitle = $enTitle;
        $this->list = $arrData;
        $this->display();
    }





}
<?php 
/*
 * 新闻资讯模块
 *   */

namespace Home\Controller;
use Home\Controller\BaseController;

class NewsController extends BaseController{
	
	public function  __construct(){
		parent::__construct();
	} 

	public function index(){
	    //查询已发布的新闻，并分页显示
        $arrWhere['status'] = 1;

        $intCount = D('News','Service')->count($arrWhere);
        $Page = new \Think\Page($intCount,2);// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $first = $Page->firstRow;
        $list = $Page->listRows;
        $arrData = D('News','Service')->findAll($arrWhere,$first,$list);
        $this->count = $intCount;
        $this->page = $show;
        $this->list = $arrData;

        $this->display();
    }

    public function content(){
	    $arrWhere['nid'] = I('get.nid');
	    $arrData = D('News','Service')->findOne($arrWhere);
	    $this->list = $arrData;
    }
	
	
	
}




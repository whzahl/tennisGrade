<?php 
/* 
 * 公告模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class NoticeController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}


	public function index(){
		$strTitle=I('get.title');
		if (!empty($strTitle)) {
			$arrWhere['title'] = array('like','%'.$strTitle.'%');
			$this->title=$strTitle;
		}
		$intCount = D('Notice','Service')->count($arrWhere);
		$Page = new \Think\Page($intCount,7);// 实例化分页类 传入总记录数和每页显示的记录数(7)
		$show = $Page->show();   // 分页显示输出
		$first = $Page->firstRow;
		$list = $Page->listRows;
		$arrData = D('Notice','Service')->findAll($arrWhere,$first,$list);
		$this->count = $intCount;
		$this->page = $show;
		$this->list = $arrData;
		$this->display();
	}
	
	public function add(){
	     $notice = M('tg_notice');
	  	 $data = $notice->create(); 
	 	if(IS_POST){
			$data['create_time'] = time();
			$arrData = $notice->data($data)->add();
			if($arrData){
			$this->success('添加成功！','/Admin/Notice/index');
			}else {
			$this->error('添加失败！');
			}
			
		}else{
			$this->display();
		}
	}
	
	public function edit(){
		$notice  = M('tg_notice');
		$data = $notice->create();
		if (IS_POST) {
			$data['modify_time'] = time();
			/* dump($data);
			exit();  */
			$arrData = $notice->data($data)->save();
			if($arrData){
				$this->success('修改成功！','/Admin/Notice/index');
			}else {
				$this->error('修改失败！');
			}
				
		}else {
			$noid = I('get.noid');
			$arrData = M('tg_notice')->where(array('noid'=>$noid))->find();
			$this->list = $arrData;
			$this->display();
		}
		
	}

	public function delete(){
	
		$arrWhere['noid'] =I('get.noid');
	
		$arrData = D('Notice','Service')->delete($arrWhere);
		if($arrData){
			$this->success('删除成功！','/Admin/Notice/index');
		}else {
			$this->error('删除失败！');
		}
		$this->display();
	}


}
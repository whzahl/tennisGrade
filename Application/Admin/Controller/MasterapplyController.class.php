<?php 
/* 
 * 管理员模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class MasterapplyController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}


	public function index(){

		$data = M('tg_masterapply')->select();
		$this->assign('data',$data);
		$this->display();
	}



	public function add(){
		
		if (IS_POST) {
			
			$arr = I('post.');
			// $pid =  $_SESSION['pid'];
			$arr['create_time'] = time();
			$arr['status'] = 2;
			$arrDate = M('tg_masterapply')->add($arr);
			if ($arrDate) {
				$this->success('添加成功！','/Admin/Masterapply/index');
			}else{
				$this->error('添加失败！');
			}
		}else{
			$this->display();
		}
	}

	public function city(){


	}



	public function edit(){
        if (IS_POST) {
			$arr = I('post.');
			$arr['create_time'] = time();
			$arrDate = D('Master','Service')->edit($arr);
			// $arrDate = M('tg_master')->data($arr)->save();
			if($arrDate){
				$this->success('修改成功！','/Admin/Masterapply/index');
			}else{
				$this->error('修改失败！');
			}
		}else{
			
			$this->display();
		}
	}


	public function delete(){
		$arrWhere = I('get.');
    	$arrData =M('tg_masterapply')->where(array('id'=>$arrWhere['id']))->delete();
		if (!$arrData){
	        $this->error('删除失败!');
	    }else {
	        $this->success('删除成功！');
	    }
		$this->display();
	}



}
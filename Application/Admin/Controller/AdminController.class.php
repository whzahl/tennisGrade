<?php 
/* 
 * 管理员模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class AdminController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}


	public function index(){
		$data = M('tg_admin')->order('aid desc')->select();
		$count = M('tg_admin')->count();

		$this->assign('data',$data);// 赋值数据集
		$this->display();
	}



	public function add(){
		if (IS_POST) {
			$arr = I('post.');
			$arr['create_time'] = time();
			if ($arr['password1'] == $arr['password2']) {
				$arr['password'] = $arr['password2'];
			}else{
				$this->error('两次密码不一致，请重新输入！');
			}
			$arrDate = M('tg_admin')->add($arr);
			if ($arrDate) {
				$this->success('添加成功！','/Admin/Admin/index');
			}else{
				$this->error('添加失败！');
			}
		}else{
			$this->display();
		}
	}



	public function edit(){
        if (IS_POST) {
			$arr = I('post.');
			dump($arr);
			$data = M('tg_admin')->where(array('aid'=>$arr['aid']))->find();
			if ($arr['passwordOld'] == $data['password']) {
				$arr['create_time'] = time();
				$arr['password'] = $arr['passwordNew'];
				if($arr['passwordNew'] != $arr['passwordOld']){
					$arrDate = D('Admin','Service')->edit($arr);
					dump($arrDate);die;
					if($arrDate){
						$this->success('修改成功！','/Admin/Admin/index');
					}else{
						$this->error('修改失败！');
					}
				}else{
					$this->error('新密码不可与旧密码相同，请重新输入！');
				}
			}else{
				$this->error('旧密码输入错误！');
			}
		}else{
			$arr['aid'] = I('get.aid');
        	$data = D('Admin','Service')->findOne($arr);
        	$this->assign('data',$data);
			$this->display();
		}
	}


	public function delete(){
		$arrWhere = I('get.');
	    if($arrWhere['type'] == 1){
	    	 $this->error('超级管理员不能删除！');
	    }else{
	    	$arrData =M('tg_admin')->where(array('aid'=>$arrWhere['aid']))->delete();
			if (!$arrData){
		        $this->error('删除失败!');
		    }else {
		        $this->success('删除成功！');
		    }
	    }
		$this->display();
	}




}
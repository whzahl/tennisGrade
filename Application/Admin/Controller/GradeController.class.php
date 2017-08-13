<?php 
/* 
 * 证书等级查询模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class GradeController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}


	public function index(){
		/* $strTitle=I('get.title');
		if (!empty($strTitle)) {
			$arrWhere['title'] = array('like','%'.$strTitle.'%');
			$this->title=$strTitle;
		} */
		$intCount = D('Grade','Service')->count($arrWhere);
		$Page = new \Think\Page($intCount,7);// 实例化分页类 传入总记录数和每页显示的记录数(7)
		$show = $Page->show();   // 分页显示输出
		$first = $Page->firstRow;
		$list = $Page->listRows;
		$arrData = D('Grade','Service')->findAll($arrWhere,$first,$list);
		$this->count = $intCount;
		$this->page = $show;
		$this->list = $arrData;
		$this->display();
	}
	
	public function add(){
	     $grade = M('tg_grade');
	  	 $data = $grade->create(); 
	 	if(IS_POST){
	 		$upload = new \Think\Upload();// 实例化上传类
	 		$upload->maxSize   =     3145728 ;// 设置附件上传大小
	 		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	 		$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
	 		 
	 		// 上传文件
	 		$info   =    $upload->uploadOne($_FILES['picture']);
	 		if(!$info) {// 上传错误提示错误信息
	 			$this->error($upload->getError());
	 		}else{
 			$arrImage = $_FILES['picture']['name'];
 			$data['picture'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
			$data['create_time'] = time();
			$arrData = $grade->data($data)->add();
			if($arrData){
			$this->success('添加成功！','/Admin/Grade/index');
			}else {
			$this->error('添加失败！');
			}
	 		}
		}else{
			$this->display();
		}
	}
	
	public function edit(){
	    $grade  = M('tg_grade');
		$data = $grade->create();
		if (IS_POST) {
			
			/* dump($data);
			exit();  */
			$arrData = $grade->data($data)->save();
			if($arrData){
				$this->success('修改成功！','/Admin/Grade/index');
			}else {
				$this->error('修改失败！');
			}
				
		}else {
			$gid = I('get.gid');
			$arrData = M('tg_grade')->where(array('gid'=>$gid))->find();
			$this->list = $arrData;
			$this->display();
		}
	}

	public function delete(){
	
		$arrWhere['gid'] =I('get.gid');
	
		$arrData = D('Grade','Service')->delete($arrWhere);
		if($arrData){
			$this->success('删除成功！','/Admin/Grade/index');
		}else {
			$this->error('删除失败！');
		}
		$this->display();
	}


}
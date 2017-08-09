<?php 
/* 
 * 考官模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class TeacherController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}


    public function index(){
    	$intCount = D('Teacher','Service') ->count($arrWhere);
    	$Page = new \Think\Page($intCount,10);
    	$show =  $Page ->show();
    	$first =  $Page->firstRow;
    	$list = $Page->listRows;
    	$arrData = D('Teacher','Service') ->findAll($arrWhere,$first,$list);
    	foreach ($arrData as $k => $v){
    		$arrWhere['pid'] = $v['pid'];
    		$arrDatas = D('Place','Service') ->findOne($arrWhere);
    		$arrData[$k]['address'] = $arrDatas['address'];
    	}
    	$this-> count = $intCount;
    	$this-> page = $show;
    	$this-> list = $arrData;
    	$this->display();
    }
 

    public function edit(){
        	if(IS_POST){
    		$arrWhere=I('post.');
    		$arrImage = $_FILES['picture']['name'];
    		$arrImages = $_FILES['certificate']['name'];
    		$arrWhere['create_time'] = time();
    		if (empty($arrImage)){
    			$arrData=D('Teacher','Service')->edit($arrWhere);
    		}else{
    			$upload = new \Think\Upload();// 实例化上传类
    			$upload->maxSize   =     3145728 ;// 设置附件上传大小
    			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    			$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
    			 
    			// 上传文件
    			$info   =    $upload->uploadOne($_FILES['picture']);
    			$info1   =    $upload->uploadOne($_FILES['certificate']);
    			if(!$info) {// 上传错误提示错误信息
    				$this->error($upload->getError());
    			}else{// 上传成功
    				$arrWhere['picture'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
    			}
    			if(!$info1) {// 上传错误提示错误信息
    				$this->error($upload->getError());
    			}else{// 上传成功
    				$arrWhere['certificate'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
    			}
    			$arrData=D('Teacher','Service')->edit($arrWhere);
    		}
    		if ($arrData){
    			$this->success('修改成功','/Admin/Place/index');
    		}else {
    			$this->error('修改失败');
    		}
    	}else{
    		$arrWhere['tid']=I('get.tid');
    		$arrData=D('Teacher','Service')->findOne($arrWhere);
    		$this->list=$arrData;
    		$this->display();
    	}
    }

    public function delete(){
    	$arrWhere['tid'] = I('get.tid');
    	$arrData = D('Teacher','Service') ->delete($arrWhere);
    	if ($arrData) {
    		$this->success('删除成功','/Admin/Teacher/index');
    	} else {
    		$this->error('删除失败');
    	}

    	$this->display();
    }
    
    public function add(){
    	$this->display();
    }

    public function edit(){
    	$this->display();
    }



    	$this->display();
    }

    public function test(){
    	
    }
}
<?php 
/* 
 * 考生模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class StudentController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}

    public function index(){
<<<<<<< HEAD
    	$intCount = D('Student','Service') ->count($arrWhere);
    	$Page = new \Think\Page($intCount,10);
    	$show =  $Page ->show();
    	$first =  $Page->firstRow;
    	$list = $Page->listRows;
    	$arrData = D('Student','Service') ->findAll($arrWhere,$first,$list);
    	foreach ($arrData as $k => $v){
    		$arrWhere['tid'] = $v['tid'];
    		$arrDatas = D('Teacher','Service') ->findOne($arrWhere);
    		$arrData[$k]['tname'] = $arrDatas['tname'];
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
    		$arrWhere['create_time'] = time();
    		if (empty($arrImage)){
    			$arrData=D('Student','Service')->edit($arrWhere);
    		}else{
    			$upload = new \Think\Upload();// 实例化上传类
    			$upload->maxSize   =     3145728 ;// 设置附件上传大小
    			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    			$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
    			 
    			// 上传文件
    			$info   =    $upload->uploadOne($_FILES['picture']);
    			if(!$info) {// 上传错误提示错误信息
    				$this->error($upload->getError());
    			}else{// 上传成功
    				$arrWhere['picture'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
    			    $arrData=D('Student','Service')->edit($arrWhere);
    			}
    		}
    		if ($arrData){
    			$this->success('修改成功','/Admin/Place/index');
    		}else {
    			$this->error('修改失败');
    		}
    	}else{
    		$arrWhere['sid']=I('get.sid');
    		$arrData=D('Student','Service')->findOne($arrWhere);
    		$this->list=$arrData;
    		$this->display();
    	}
    }


    public function delete(){
    	$arrWhere['sid'] = I('get.sid');
    	$arrData = D('Place','Service') ->delete($arrWhere);
    	if ($arrData) {
    		$this->success('删除成功','/Admin/Student/index');
    	} else {
    		$this->error('删除失败');
    	}
    	$this->display();
    }
=======
    	$this->display();
    }
    
    public function add(){
    	$this->display();
    }

    public function edit(){
    	$this->display();
    }



>>>>>>> 7a5f72a3869f79d153204755c2996470b12fee66


}
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
    	if (!empty($_SESSION['Type']['uid'])) {
    		$arrWhere['pid'] = $_SESSION['Type']['uid'];
    	}
    	$intCount = D('Teacher','Service') ->count($arrWhere);
    	$Page = new \Think\Page($intCount,10);
    	$show =  $Page ->show();
    	$first =  $Page->firstRow;
    	$list = $Page->listRows;
    	$arrData = D('Teacher','Service') ->findAll($arrWhere,$first,$list);
    	foreach ($arrData as $k => $v){
    		$arrWhere['pid'] = $v['pid'];
    		$arrDatas = D('Place','Service') ->findOne($arrWhere);
    		$arrData[$k]['pname'] = $arrDatas['pname'];
    		$arrWheres['code'] = $v['province'];
    		$arrDatas = D('Province','Service') -> findOne($arrWheres);
    		$arrData[$k]['province'] = $arrDatas['name'];
    		$arrWheres['code'] = $v['city'];
    		$arrDatas = D('City','Service') -> findOne($arrWheres);
    		$arrData[$k]['city'] = $arrDatas['name'];
    		$arrWheres['code'] = $v['area'];
    		$arrDatas = D('Area','Service') -> findOne($arrWheres);
    		$arrData[$k]['area'] = $arrDatas['name'];
    	}
    	$this-> count = $intCount;
    	$this-> page = $show;
    	$this->list = $arrData;
    	$this->display();
    }
 

    public function edit(){
        	if(IS_POST){
    		$arrWhere=I('post.');
    		$arrImage = $_FILES['picture']['name'];
    		$arrImages = $_FILES['certificate']['name'];
    		$arrWhere['create_time'] = time();

    		if (empty($arrImage) && empty($arrImages)){
    		    $arrWhere['certificate'] = implode("、", $arrWhere['certificate']);
    			$arrData=D('Teacher','Service')->edit($arrWhere);
    		}
    		else{
    			$upload = new \Think\Upload();// 实例化上传类
    			$upload->maxSize   =     3145728 ;// 设置附件上传大小
    			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    			$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
    			 
    			// 上传文件
    			$info   =    $upload->uploadOne($_FILES['picture']);
    			$info1   =    $upload->upload(array($_FILES['certificate']));
    			if(!$info) {// 上传错误提示错误信息
//                    $this->error($upload->getError());
                }
    			else{// 上传成功
    				$arrWhere['picture'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
    			}
    			if(!$info1) {// 上传错误提示错误信息
//    				$this->error($upload->getError());
    			}
    			else{// 上传成功
                    foreach ($info1 as $key => $val){
                        //向数组插入元素的两种写法
                        $arrWhere['certificate'][] = '/Public/Uploads/'.$val['savepath'].$val['savename'];
//                        array_push($arrWhere['certificate'],'/Public/Uploads/'.$val['savepath'].$val['savename']);
                    }
    			}

                $arrWhere['certificate'] = implode("、", $arrWhere['certificate']);
    			$arrData=D('Teacher','Service')->edit($arrWhere);
    		}
    		if ($arrData){
    			$this->success('修改成功','/Admin/Teacher/index');
    		}else {
    			$this->error('修改失败');
    		}
    	}else{
    		$arrWhere['tid']=I('get.tid');
    		$arrData=D('Teacher','Service')->findOne($arrWhere);
    		$list1 = explode("、",$arrData['certificate']);
    		$this->list=$arrData;
    		$this->list1=$list1;
    		$this->display();
    	}
    }

    public function check(){
        if(IS_POST){
            $arrWhere=I('post.');
            $arrImage = $_FILES['picture']['name'];
            $arrImages = $_FILES['certificate']['name'];
            $arrWhere['create_time'] = time();

            if (empty($arrImage) && empty($arrImages)){
                $arrWhere['certificate'] = implode("、", $arrWhere['certificate']);
                $arrData=D('Teacher','Service')->edit($arrWhere);
            }
            else{
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录

                // 上传文件
                $info   =    $upload->uploadOne($_FILES['picture']);
                $info1   =    $upload->upload(array($_FILES['certificate']));
                if(!$info) {// 上传错误提示错误信息
//                    $this->error($upload->getError());
                }
                else{// 上传成功
                    $arrWhere['picture'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
                }
                if(!$info1) {// 上传错误提示错误信息
//    				$this->error($upload->getError());
                }
                else{// 上传成功
                    foreach ($info1 as $key => $val){
                        //向数组插入元素的两种写法
                        $arrWhere['certificate'][] = '/Public/Uploads/'.$val['savepath'].$val['savename'];
//                        array_push($arrWhere['certificate'],'/Public/Uploads/'.$val['savepath'].$val['savename']);
                    }
                }
                $arrWhere['certificate'] = implode("、", $arrWhere['certificate']);
                $arrData=D('Teacher','Service')->edit($arrWhere);
            }
            if ($arrData){
                $this->success('修改成功','/Admin/Teacher/index');
            }else {
                $this->error('修改失败');
            }
        }else{
            $arrWhere['tid']=I('get.tid');
            $arrData=D('Teacher','Service')->findOne($arrWhere);
            $list1 = explode("、",$arrData['certificate']);
            $this->list=$arrData;
            $this->list1=$list1;
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
    }
    
    public function add(){
    	$this->display();
    }

}
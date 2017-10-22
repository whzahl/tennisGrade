<?php 
/* 
 * 考生模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;
//header('Content-Type:text/html; charset=utf-8');

class StudentController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}

    public function index(){
    	if (!empty($_SESSION['Type']['uid'])) {
    		$arrWhere['pid'] = $_SESSION['Type']['uid'];
    	}
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
    		$arrWhere['pid'] = $v['pid'];
    		$arrDatass = D('Place','Service') ->findOne($arrWhere);
    		$arrData[$k]['address'] = $arrDatass['address'];
    		$arrWheres['code'] = $arrDatass['province'];
    		$arrDatasss = D('Province','Service') -> findOnes($arrWheres);
    		$arrData[$k]['province'] = $arrDatasss['name'];
    		$arrWheres['code'] = $arrDatass['city'];
    		$arrDatassss = D('City','Service') -> findOnes($arrWheres);
    		$arrData[$k]['city'] = $arrDatassss['name'];
    		$arrWheres['code'] = $arrDatass['area'];
    		$arrDatasssss = D('Area','Service') -> findOnes($arrWheres);
    		$arrData[$k]['area'] = $arrDatasssss['name'];
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
    			$this->success('修改成功','/Admin/Student/index');
    		}else {
    			$this->error('修改失败');
    		}
    	}else{
//    		    $arrWhere['sid']=I('get.sid');
//                $arrData=D('Student','Service')->findOne($arrWhere);
//                foreach ($arrData as $k=>$v){
//    			$arrWhere['tid'] = $v['tid'];
//    			$arrDatas=D('Teacher','Service')->findOne($arrWhere);
//    			$arrData[$k]['tname'] = $arrDatas['tname'];

                $arrWhere['sid']=I('get.sid');
                $arrData=D('Student','Service')->findOne($arrWhere);
                $arrWhere1['tid'] = $arrData['tid'];
                $arrData1 = D('Teacher','Service')->findOne($arrWhere1);
                $arrData['tname'] = $arrData1['tname'];
                $this->list=$arrData;
                $this->display();
    		}

    	}

    public function check(){
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
                $this->success('修改成功','/Admin/Student/index');
            }else {
                $this->error('修改失败');
            }
        }else{
//    		    $arrWhere['sid']=I('get.sid');
//                $arrData=D('Student','Service')->findOne($arrWhere);
//                foreach ($arrData as $k=>$v){
//    			$arrWhere['tid'] = $v['tid'];
//    			$arrDatas=D('Teacher','Service')->findOne($arrWhere);
//    			$arrData[$k]['tname'] = $arrDatas['tname'];

            $arrWhere['sid']=I('get.sid');
            $arrData=D('Student','Service')->findOne($arrWhere);
            $arrWhere1['tid'] = $arrData['tid'];
            $arrData1 = D('Teacher','Service')->findOne($arrWhere1);
            $arrData['tname'] = $arrData1['tname'];
        }

        $this->list=$arrData;
        $this->display();
    }
    public function delete(){
    	$arrWhere['sid'] = I('get.sid');
        //？？？？什么东西？Place?
//    	$arrData = D('Place','Service') ->delete($arrWhere);
    	$arrData = D('Student','Service') ->delete($arrWhere);
    	if ($arrData) {
    		$this->success('删除成功','/Admin/Student/index');
    	} else {
    		$this->error('删除失败');
    	}
    }
    
    public function add(){
    	$this->display();
    }
    
    function http_request($url,$data=array()){
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    	// POST数据
    	curl_setopt($ch, CURLOPT_POST, 1);
    	// 把post的变量加上
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    	$output = curl_exec($ch);
    	curl_close($ch);
    	return $output;
    }

}
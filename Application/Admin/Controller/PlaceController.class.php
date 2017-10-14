<?php 
/* 
 * 考点模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class PlaceController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}
    
    public function index(){
    	$intStatus = I('get.status');
    	if (!empty($intStatus)) {
    		$arrWhere['status'] = $intStatus;
    		$this-> status = $intStatus;
    	}
    	$intCount = D('Place','Service') ->count($arrWhere);
    	$Page = new \Think\Page($intCount,10);
    	$show =  $Page ->show();
    	$first =  $Page->firstRow;
    	$list = $Page->listRows;
    	$arrData = D('Place','Service') ->findAll($arrWhere,$first,$list);
    	foreach ($arrData as $k => $v){
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
    		$strpicture = I('picture');
    		$arrWhere['picture'] = implode('、',$strpicture);
    		$arrImage = array($_FILES['picture']);
    		
    		$arrImages = $_FILES['certificate'];
    		$arrWhere['create_time'] = time();
//    		dump($arrWhere);
//    		dump($arrImage);
//    		dump($arrImages);
//    		exit();
    		if (empty($arrImage)&&empty($arrImages)){
    			$strpicture = I('picture');
    			$arrWhere['picture'] = implode('、',$strpicture);
    			$arrData=D('Place','Service')->edit($arrWhere);
    		}elseif (empty($arrImage)&&!empty($arrImages)){  //营业执照改变场地照片不变
    			$upload = new \Think\Upload();// 实例化上传类
    			$upload->maxSize   =     3145728 ;// 设置附件上传大小
    			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    			$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
    			// 上传文件
    			$info   =    $upload->uploadOne($_FILES['certificate']);
    			if(!$info) {// 上传错误提示错误信息
    				$this->error($upload->getError());
    			}else{// 上传成功
    				$arrWhere['certificate'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
    			}
    			$strpicture = I('picture');
    			$arrWhere['picture'] = implode('、',$strpicture);
    			$arrData=D('Place','Service')->edit($arrWhere);
    		}elseif (!empty($arrImage)&&empty($arrImages)){  //营业执照不变场地照片改变
    			$upload = new \Think\Upload();// 实例化上传类
    			$upload->maxSize   =     3145728 ;// 设置附件上传大小
    			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    			$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
    			// 上传文件
    			$info1   =    $upload->upload(array($_FILES['picture']));
    			if(!$info1) {// 上传错误提示错误信息
    				$this->error($upload->getError());
    			}else{// 上传成功
    				$arrWhere['picture'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
    			}

    			
    			$arrData=D('Place','Service')->edit($arrWhere);
    		}elseif (!empty($arrImage)&&!empty($arrImages)){  //营业执照和场地照片都改变
    			$upload = new \Think\Upload();// 实例化上传类
    			$upload->maxSize   =     3145728 ;// 设置附件上传大小
    			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    			$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
    			// 上传文件
    			$info   =    $upload->uploadOne($_FILES['certificate']); // 上传文件
	    	    $info1   =    $upload->upload(array($_FILES['picture'])); // 上传多个文件
    		    if(!empty($info)){
    			$arrWhere['certificate'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
    		     }
    		    if(!empty($info1)){
    			$arrurl= array();
    			foreach ($info1 as $k => $v){
    				$arrurl[] = '/Public/Uploads/'.$v['savepath'].$v['savename']; //每个上传路径重新组合成数组
    				
    			}
    			$dataarrWhere['picture'] = implode('、',$arrurl);
    		}
    			
    			$arrData=D('Place','Service')->edit($arrWhere);
    		}
    		if ($arrData){
    			$this->success('修改成功','/Admin/Place/index');
    		}else {
    			$this->error('修改失败');
    		}
    	}else{
    		$province = M('tg_province')->select();
    		$this->province = $province;
    		$arrWhere['pid']=I('get.pid');
    		$arrData=D('Place','Service')->findOne($arrWhere);
    		$arrPicture = explode('、', $arrData['picture']);
//    		dump($arrPicture);
 //   		dump($arrPicture);
    		$this->list=$arrData;
    		$this-> list1 = $arrPicture;
    		$this->display();
    	}
    }

    public function delete(){
    	$arrWhere['pid'] = I('get.pid');
    	$arrData = D('Place','Service') ->delete($arrWhere);
    	if ($arrData) {
    		$this->success('删除成功','/Admin/Place/index');
    	} else {
    		$this->error('删除失败');
    	}
    }
    
    public function add(){
    	$this->display();
    }



}
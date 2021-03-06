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
    		$strpicture = I('post.picture');
    		$arrImage = array($_FILES['picture']['name']);
            $arrImages = $_FILES['certificate']['name'];
            $isArrImagesEmpty  = true;
            foreach ($arrImage[0] as $key=>$value){
                if (!empty($value)){
                    $isArrImagesEmpty  = false;
                }
            }
            $arrWhere['picture'] = implode('、',$strpicture);
    		$arrWhere['create_time'] = time();

            //不修改图片
    		if ($isArrImagesEmpty&&empty($arrImages)){
    			$strpicture = I('picture');
    			$arrWhere['picture'] = implode('、',$strpicture);
    			$arrData=D('Place','Service')->edit($arrWhere);
    		}

            //营业执照改变  场地照片不变
    		else if ($isArrImagesEmpty && !empty($arrImages)){
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
    		}

            //营业执照不变  场地照片改变
    		else if (!$isArrImagesEmpty && empty($arrImages)){
    			$upload = new \Think\Upload();// 实例化上传类
    			$upload->maxSize   =     3145728 ;// 设置附件上传大小
    			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    			$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
    			// 上传文件
    			$info1   =    $upload->upload(array($_FILES['picture']));
                $pictureUrl = array();
                $pictureUploadUrl = array();

    			if(!$info1) {// 上传错误提示错误信息
                    $this->error($upload->getError());

    			}else{// 上传成功
                    foreach($info1 as $key=>$value){
                        if(!empty($value)){
                            $pictureUploadUrl[] = '/Public/Uploads/'.$value['savepath'].$value['savename'];
                        }
                    }
    			}

                $pictureUrl = array_merge($strpicture, $pictureUploadUrl);
    			$arrWhere['picture'] = implode('、',$pictureUrl);
    			$arrData=D('Place','Service')->edit($arrWhere);
    		}

    		else if (!$isArrImagesEmpty && !empty($arrImages)){  //营业执照和场地照片都改变
    			$upload = new \Think\Upload();// 实例化上传类
    			$upload->maxSize   =     3145728 ;// 设置附件上传大小
    			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    			$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
    			// 上传文件
    			$info   =    $upload->uploadOne($_FILES['certificate']); // 上传文件
	    	    $info1   =    $upload->upload(array($_FILES['picture'])); // 上传多个文件

                $pictureUrl = array();
                $pictureUploadUrl = array();

    		    if(!empty($info)){
    			$arrWhere['certificate'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
    		     }
    		    if(!empty($info1)){
    			foreach ($info1 as $k => $v){
                    $pictureUploadUrl[] = '/Public/Uploads/'.$v['savepath'].$v['savename']; //每个上传路径重新组合成数组
    				
    			}
                $pictureUrl = array_merge($strpicture, $pictureUploadUrl);
                $arrWhere['picture'] = implode('、',$pictureUrl);
    		}
    			
    			$arrData=D('Place','Service')->edit($arrWhere);
    		}
    		if ($arrData){
    			$this->success('修改成功','/Admin/Place/index');
    		}else {
    			$this->error('修改失败');
    		}
    	}
    	else{
    		$province = M('tg_province')->select();
    		$this->province = $province;
    		$arrWhere['pid']=I('get.pid');
    		$arrData=D('Place','Service')->findOne($arrWhere);
            //获取省市区的code,根据code从数据库中查询他们的名字,放在arrData中返回

            //查询字段code
            $provinceCode['code'] = $arrData['province'];
            $cityCode['code'] = $arrData['city'];
            $areaCode['code'] = $arrData['area'];

            //查询结果
            $provinceData = (D('Province','Service')->findOne($provinceCode));
            $areaData = D('Area','Service')->findOne($areaCode);
            $cityData = D('City','Service')->findOne($cityCode);
//            结果存入数组arrData
            $arrData['provinceName'] = $provinceData['name'];
            $arrData['areaName'] = $areaData['name'];
            $arrData['cityName'] = $cityData['name'];

//            查询province code 为$provinceCode['code']的city
//            查询citycode 为$cityCode['code']的city
            $arrWhereCity['provincecode'] = $provinceCode['code'];
            $arrWhereArea['citycode'] = $cityCode['code'];
            $arrCity = D('City','Service')->findAll($arrWhereCity);
            $arrArea = D('Area','Service')->findAll($arrWhereArea);
            $arrPicture = explode('、', $arrData['picture']);
    		$this->list=$arrData;
    		$this-> list1 = $arrPicture;
    		$this->arrCity = $arrCity;
    		$this->arrArea = $arrArea;
    		$this->display();
    	}
    }

    Public function check(){
        if(IS_POST){
            $arrWhere=I('post.');
            $strpicture = I('post.picture');
            $arrImage = array($_FILES['picture']['name']);
            $arrImages = $_FILES['certificate']['name'];
            $isArrImagesEmpty  = true;
            foreach ($arrImage[0] as $key=>$value){
                if (!empty($value)){
                    $isArrImagesEmpty  = false;
                }
            }
            $arrWhere['picture'] = implode('、',$strpicture);
            $arrWhere['create_time'] = time();

            //不修改图片
            if ($isArrImagesEmpty&&empty($arrImages)){
                $strpicture = I('picture');
                $arrWhere['picture'] = implode('、',$strpicture);
                $arrData=D('Place','Service')->edit($arrWhere);
            }

            //营业执照改变  场地照片不变
            else if ($isArrImagesEmpty && !empty($arrImages)){
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
            }

            //营业执照不变  场地照片改变
            else if (!$isArrImagesEmpty && empty($arrImages)){
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
                // 上传文件
                $info1   =    $upload->upload(array($_FILES['picture']));
                $pictureUrl = array();
                $pictureUploadUrl = array();

                if(!$info1) {// 上传错误提示错误信息
                    $this->error($upload->getError());

                }else{// 上传成功
                    foreach($info1 as $key=>$value){
                        if(!empty($value)){
                            $pictureUploadUrl[] = '/Public/Uploads/'.$value['savepath'].$value['savename'];
                        }
                    }
                }

                $pictureUrl = array_merge($strpicture, $pictureUploadUrl);
                $arrWhere['picture'] = implode('、',$pictureUrl);
                $arrData=D('Place','Service')->edit($arrWhere);
            }

            else if (!$isArrImagesEmpty && !empty($arrImages)){  //营业执照和场地照片都改变
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
                // 上传文件
                $info   =    $upload->uploadOne($_FILES['certificate']); // 上传文件
                $info1   =    $upload->upload(array($_FILES['picture'])); // 上传多个文件

                $pictureUrl = array();
                $pictureUploadUrl = array();

                if(!empty($info)){
                    $arrWhere['certificate'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
                }
                if(!empty($info1)){
                    foreach ($info1 as $k => $v){
                        $pictureUploadUrl[] = '/Public/Uploads/'.$v['savepath'].$v['savename']; //每个上传路径重新组合成数组

                    }
                    $pictureUrl = array_merge($strpicture, $pictureUploadUrl);
                    $arrWhere['picture'] = implode('、',$pictureUrl);
                }

                $arrData=D('Place','Service')->edit($arrWhere);
            }
            if ($arrData){
                $this->success('修改成功','/Admin/Place/index');
            }else {
                $this->error('修改失败');
            }
        }
        else{
            $province = M('tg_province')->select();
            $this->province = $province;
            $arrWhere['pid']=I('get.pid');
            $arrData=D('Place','Service')->findOne($arrWhere);
            //获取省市区的code,根据code从数据库中查询他们的名字,放在arrData中返回

            //查询字段code
            $provinceCode['code'] = $arrData['province'];
            $cityCode['code'] = $arrData['city'];
            $areaCode['code'] = $arrData['area'];

            //查询结果
            $provinceData = (D('Province','Service')->findOne($provinceCode));
            $areaData = D('Area','Service')->findOne($areaCode);
            $cityData = D('City','Service')->findOne($cityCode);
//            结果存入数组arrData
            $arrData['provinceName'] = $provinceData['name'];
            $arrData['areaName'] = $areaData['name'];
            $arrData['cityName'] = $cityData['name'];

//            查询province code 为$provinceCode['code']的city
//            查询citycode 为$cityCode['code']的city
            $arrWhereCity['provincecode'] = $provinceCode['code'];
            $arrWhereArea['citycode'] = $cityCode['code'];
            $arrCity = D('City','Service')->findAll($arrWhereCity);
            $arrArea = D('Area','Service')->findAll($arrWhereArea);
            $arrPicture = explode('、', $arrData['picture']);
            $this->list=$arrData;
            $this-> list1 = $arrPicture;
            $this->arrCity = $arrCity;
            $this->arrArea = $arrArea;
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
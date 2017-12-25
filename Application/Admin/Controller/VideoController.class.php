<?php 
/* 
 * 直播模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class VideoController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}


	public function index(){
		$strTitle=I('get.title');
		if (!empty($strTitle)) {
			$arrWhere['title'] = array('like','%'.$strTitle.'%');
			$this->title=$strTitle;
		}
		$intCount = D('Video','Service')->count($arrWhere);
		$Page = new \Think\Page($intCount,7);// 实例化分页类 传入总记录数和每页显示的记录数(7)
		$show = $Page->show();   // 分页显示输出
		$first = $Page->firstRow;
		$list = $Page->listRows;
		$arrData = D('Video','Service')->findAll($arrWhere,$first,$list);
//		dump($arrData);
//		dump($arrData);
		$this->count = $intCount;
		$this->page = $show;
		$this->list = $arrData;
		$this->assign('video',$arrData);
		$this->display();
	}
	
	public function add(){
//		 $live = M('tg_video');
//	  	 $data = $live->create();
//	 	if(IS_POST){
//	 		$upload= new \Think\Upload();// 实例化上传类
//	 		$upload->maxSize=100048000;// 设置附件上传大小 100M
//	 		$upload->exts=array('mp4');// 设置附件上传类型
//	 		$upload->rootPath='./Public/Uploads/'; // 设置附件上传根目录
//// 	 		$upload->savePath=''; // 设置附件上传（子）目录
//// 	 		$upload->subName='';
//// 	 		$upload->saveName='uniqid';
//	 		$info=$upload->uploadOne($_FILES['video']);
//	 		//dump($info);exit;
//	 		if(!$info) {// 上传失败
//	 			$this->error ($upload->getError());
//	 		}
//	 		//if($info['videofile']['savename']!=''){
//	 		//	$_POST['videourl']='/Uploads/Video/'.$info['videofile']['savename'];
//	 		//}
//	 		if($info){
//	 			//$_POST['imgurl']='/Uploads/Video/'.$info['imgfile']['savename'];
//	 			$data['video'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
//	 		}
//		    $data['create_time'] = time();
//			$arrData = $live->data($data)->add();
//			if($arrData){
//			$this->success('添加成功！','/Admin/Video/index');
//			}else {
//			$this->error('添加失败！');
//			}
//		}else{
//			$this->display();
//		}
        if(IS_POST){
            $arrWhere = I('post.');
            $arrWhere['create_time'] = time();
            $arrData = D('Video','Service')->add($arrWhere);
            if ($arrData){
                $this->success('添加成功','/Admin/Video/index');
            }
            else{
                $this->error('添加失败');
            }
//            dump($arrWhere);
        }
        else{
            $this->display();
        }
		
	}
	
	public function edit(){
//	    $live = M('tg_live');
//	  	$data = $live->create();
//	 	if(IS_POST){
//			$data['create_time'] = time();
//			$arrData = $live->data($data)->save();
//			if($arrData){
//			$this->success('修改成功！','/Admin/Live/index');
//			}else {
//			$this->error('修改失败！');
//			}
//
//		}else {
//			$arrWhere['vid'] =I('get.vid');
//			$arrData = D('Video','Service')->findOne($arrWhere);
//			$this->list = $arrData;
//			$this->display();
//		}

        if (IS_POST){
            $arrWhere = I('post.');
            $arrWhere['create_time'] = time();
            $arrData = D('Video','Service')->edit($arrWhere);
            if ($arrData){
                $this->success('修改成功','/Admin/Video/index');
            }
            else{
                $this->error('修改失败');
            }
        }
        else{
            $arrWhere['vid'] =I('get.vid');
			$arrData = D('Video','Service')->findOne($arrWhere);
			$this->list = $arrData;
			$this->display();
        }
		
	}

	public function delete(){
		$arrWhere['vid'] =I('get.vid');
		$arrData = D('Video','Service')->delete($arrWhere);
		if($arrData){
			$this->success('删除成功！','/Admin/Video/index',10);
		}else {
			$this->error('删除失败！');
		}
	}


}
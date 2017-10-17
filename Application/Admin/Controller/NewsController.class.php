<?php 
/*
 * 新闻资讯模块
 *   */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class NewsController extends CheckController{
	
	public function  __construct(){
		parent::__construct();
	} 


	public function index(){
	    //选取状态为发布的新闻打印在index页面
        $arrWhere['status'] = 1;
        $status = I('get.status');
        if ($status != ''){
            $arrWhere['status'] = I('get.status');
        }
	    $intCount = D('News','Service')->count($arrWhere);
	    $Page = new \Think\Page($intCount,10);// 实例化分页类 传入总记录数和每页显示的记录数
	    $show = $Page->show();// 分页显示输出
	    $first = $Page->firstRow;
	    $list = $Page->listRows;
	    $arrData = D('News','Service')->findAll($arrWhere,$first,$list);
	    $this->count = $intCount;
	    $this->page = $show;
	    $this->list = $arrData;
	    $this->list1 = $arrData[0]['status'];
		$this->display();
	}
	
	public function add(){
	    if(IS_POST){
	        $upload  =  new  \Think\Upload();//  实例化上传类
	        $upload->maxSize      =          3145728  ;//  设置附件上传大小
	        $upload->exts            =          array('jpg',  'gif',  'png',  'jpeg');//  设置附件上传类型
	        $upload->rootPath    =            './Public/Uploads/';  //  设置附件上传根目录
	        
	        //  上传文件
	        $info      =        $upload->uploadOne($_FILES['picture']);
	        if(!$info)  {//  上传错误提示错误信息
	            $this->error($upload->getError());
	        }
	        else{
	            $arrWhere = I('post.');
	            $arrWhere['create_time'] = time();
	            $arrWhere['modify_time'] = time();
	            //aid暂时没有，设为1
	            $arrWhere['aid'] = 1;
	            $arrWhere['picture'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
	            $arrData = D('News','Service')->add($arrWhere);
	            /* var_dump($arrData); */
	            if($arrData){
	                $this->success('添加成功','/Admin/News/index');
	            }
	            else{
	                $this->error('添加失败');
	            }
	        }
	        
	    }
	    else{
            $this->display();
        }

	}
	
	public function edit(){
	    if(IS_POST){
	        $arrWhere = I('post.');
	        //创建时间写在前台页面，包含在post.中
	        //需要在后台添加的数据：aid,modify_time,picture如果修改了就重新长传，否则不
	        $arrWhere['modify_time'] = time();
	        $arrWhere['aid'] = 1;
	        $arrImage = $_FILES['picture']['name'];
//	        dump($arrImage);
//	        exit();
	        if(empty($arrImage)){
	            $arrData = D('News','Service')->edit($arrWhere);
	            if($arrData){
	                $this->success('修改成功','/Admin/News/index');
	            }
	            else{
	                $this->error('修改失败');
	            }
	        }
	        else{
	            $upload = new \Think\Upload();// 实例化上传类
	            $upload->maxSize   =     3145728 ;// 设置附件上传大小
	            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	            $upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
	            
	            //上传文件
	            $info = $upload->uploadOne($_FILES['picture']);
	            if (!$info){
	                $this->error($upload->getError());
	            }
	            else{
	                //上传成功
	                $arrWhere['picture'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
	                $arrData = D('News','Service')->edit($arrWhere);
	                if($arrData){
	                    $this->success('修改成功','/Admin/News/index');
	                }
	                else{
	                    $this->error('修改失败');
	                }
	            }
	        }
	    }
	    else{
            $arrWhere['nid'] = I('get.nid');
            $arrData = D('News','Service')->findOne($arrWhere);
            $this->list = $arrData;
            $this->display();
        }

	}
	public function delete(){
	    $arrWhere['nid'] = I('get.nid');
	    $arrWhere['status'] = 2;
	    $arrData = D('News','Service')->edit($arrWhere);
	    if (!$arrData){
	        $this->error('删除失败');
	    }
	    else {
	        redirect('/Admin/News/index');
	    }
	}
}




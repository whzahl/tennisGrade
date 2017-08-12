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
	    $intCount = D('News','Service')->count($arrWhere);
	    $Page = new \Think\Page($intCount,10);
	    $show = $Page->show();
	    $first = $Page->firstRow;
	    $list = $Page->listRows;
	    $arrData = D('News','Service')->findAll($arrWhere,$first,$list);
	    $this->count = $intCount;
	    $this->page = $show;
	    $this->list = $arrData;
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
	    
		$this->display();
	}
	
	public function edit(){
		$this->display();
	}
	
	
	
}




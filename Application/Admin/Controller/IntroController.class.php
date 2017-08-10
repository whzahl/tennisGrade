<?php
/*

 * 介绍模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class IntroController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}

    /*
     * 委员会简介
     *  */
    public function intro(){
        $arrDate = D('Intro','Service')->findOne($arrWhere);
        $this->list = $arrData;
        $this->display();

    }
    
    /*
     * 考试介绍
    *  */
    public function intros(){
    	$this->display();
    }
    /*
     * 考试协议
    *  */
    public function intross(){
    	$this->display();
    }
   
    
    /*
     * 委员会简介添加
     *  */
    public function add(){
        if(IS_POST){
            $arrWhere = I('post.');
            $arrWhere['picture'] = "";
            $arrWhere['type'] = 0;
            $arrWhere['create_time'] = time();
            $arrWhere['modify_time'] = time();
            $arrData = D('Intro',"Service")->add($arrWhere);
            if($arrData){
                $this->success('添加成功','/Admin/Intro/intro');
            }
            else{
                $this->error('添加失败');
            }
        }
        $this->display();
    }
    
    /*
     * 考试介绍添加
     *  */
    public function adds(){
        $this->display();
    }
    
    /*
     * 考试协议添加
     *  */
    public function addss(){
        $this->display();
    }
    
    /*
     * 委员会简介修改
     *  */
    public function edit(){
        if(IS_POST){
            $arrWhere = I('post.');
            $arrWhere['picture'] = "";
            $arrWhere['type'] = 0;
            $arrWhere['modify_time'] = time();
            $arrData = D('Intro','Service')->edit($arrWhere);
            if ($arrData){
                $this->success('修改成功','/Admin/Intro/intro');
            }
            else{
                $this->error('添加失败');
            }
        }
        $arrWhere = I('get.inid');
        $arrData = D('Intro','Service')->findOne($arrWhere);
        $this->list = $arrData;
        $this->display();

    }
    
    /*
     * 考试介绍修改
    *  */

    public function edits(){
        $this->display();

    }
    
    /*
     * 考试协议修改
    *  */
    public function editss(){
    	$this->display();
    }
    
    
    
}


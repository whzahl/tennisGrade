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


<?php 
/* 
 * 考点模块
 *  */

namespace Home\Controller;
use Home\Controller\CheckController;

class PlaceController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}


    public function index(){
	    $province = M('tg_province')->select();
	    $this->province = $province;
        $this->display();
    } 

}
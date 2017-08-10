<?php 
/* 
 * 站长模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class MasterController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$intCount = D('Master','Service') ->count($arrWhere);
		$Page = new \Think\Page($intCount,10);
		$show =  $Page ->show();
		$first =  $Page->firstRow;
		$list = $Page->listRows;
		$arrData = D('Master','Service') ->findAll($arrWhere,$first,$list);
		foreach ($arrData as $k => $v){
			$arrWhere['pid'] = $v['pid'];
			$arrDatas = D('Place','Service') ->findOne($arrWhere);
			$arrData[$k]['pname'] = $arrDatas['pname'];
			$arrData[$k]['manager'] = $arrDatas['manager'];
			$arrData[$k]['address'] = $arrDatas['address'];
		}
		$this-> count = $intCount;
		$this-> page = $show;
		$this-> list = $arrData;
		$this->display();
	}


	public function delete(){
		$arrWhere['mid'] = I('get.mid');
		$arrData = D('Master','Service') ->delete($arrWhere);
		if ($arrData) {
			$this->success('删除成功','/Admin/Master/index');
		} else {
			$this->error('删除失败');
		}
		$this->display();
	}



}
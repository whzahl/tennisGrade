<?php 
/* 
 * 管理员模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class MasterController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}


	public function index(){
		$data = M('tg_master')->order('mid desc')->select();
		$count = M('tg_master')->count();

		$this->assign('data',$data);// 赋值数据集
		$this->display();
	}



	public function add(){
		
		if (IS_POST) {
			
			$arr = I('post.');

			$arr['create_time'] = time();
			$arr['pid'] = mt_rand(1000,9999);
			$arrDate = M('tg_master')->add($arr);
			if ($arrDate) {
				$this->success('添加成功！','/Admin/Master/index');
			}else{
				$this->error('添加失败！');
			}
			$this->assign('city',$city);
			$this->assign('area',$area);
		}else{
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
			//结果存入数组arrData
            $arrData['provinceName'] = $provinceData['name'];
            $arrData['areaName'] = $areaData['name'];
            $arrData['cityName'] = $cityData['name'];

			//查询province code 为$provinceCode['code']的city
			//查询citycode 为$cityCode['code']的city
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

	public function city(){


	}



	public function edit(){
        if (IS_POST) {
			$arr = I('post.');
			$arr['create_time'] = time();
			$arrDate = D('Master','Service')->edit($arr);
			// $arrDate = M('tg_master')->data($arr)->save();
			if($arrDate){
				$this->success('修改成功！','/Admin/Master/index');
			}else{
				$this->error('修改失败！');
			}
		}else{
			$arr['mid'] = I('get.mid');
        	$data = D('Master','Service')->findOne($arr);

        	//省市县三级联动
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
			//结果存入数组arrData
            $arrData['provinceName'] = $provinceData['name'];
            $arrData['areaName'] = $areaData['name'];
            $arrData['cityName'] = $cityData['name'];

			//查询province code 为$provinceCode['code']的city
			//查询citycode 为$cityCode['code']的city
            $arrWhereCity['provincecode'] = $provinceCode['code'];
            $arrWhereArea['citycode'] = $cityCode['code'];
            $arrCity = D('City','Service')->findAll($arrWhereCity);
            $arrArea = D('Area','Service')->findAll($arrWhereArea);
            $arrPicture = explode('、', $arrData['picture']);
    		$this->list=$arrData;
    		$this-> list1 = $arrPicture;
    		$this->arrCity = $arrCity;
    		$this->arrArea = $arrArea;

        	$this->assign('data',$data);
			$this->display();
		}
	}


	public function delete(){
		$arrWhere = I('get.');
    	$arrData =M('tg_master')->where(array('mid'=>$arrWhere['mid']))->delete();
		if (!$arrData){
	        $this->error('删除失败!');
	    }else {
	        $this->success('删除成功！');
	    }
		$this->display();
	}



	public function check(){
		$arr['mid'] = I('get.mid');
    	$arrData = M('tg_master')->where(array('mid'=>$arr['mid']))->find();
    	$pro = M('tg_province')->where(array('code'=>$arrData['province']))->field('name')->find();
    	$city = M('tg_city')->where(array('code'=>$arrData['city']))->field('name')->find();
    	$area = M('tg_area')->where(array('code'=>$arrData['area']))->field('name')->find();
    	$data = array(
    		'mid' => $arr['mid'],
    		'master_name' => $arrData['master_name'],
    		'pro' => $pro['name'],
    		'city' => $city['name'],
    		'area' => $area['name'],
    		'status' => $arrData['status'],
    		'create_time'=>$arrData['create_time'],
    	);
    	$this->assign('data',$data);
		$this->display();
	}


	public function checkm(){

		//不通过
		$arr = I('post.');
		$arr['status'] = 2;
		$arrDate = D('Master','Service')->where(array('mid' => $arr['mid']))->edit($arr);
		if($arrDate){
			$this->success('审核不通过！','/Admin/Master/index');
		}
			
		//通过
		$reason = I('get.');
		$arrDate1 = D('Master','Service')->where(array('mid' => $arr['mid']))->edit($reason);
		if($arrDate1){
			$this->success('审核通过！','/Admin/Master/index');
		}
		$this->display();
	}



}
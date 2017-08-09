<?php 
/* 
 * 直播模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class LiveController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}


	public function index(){
		$strTitle=I('get.title');
		if (!empty($strTitle)) {
			$arrWhere['title'] = array('like','%'.$strTitle.'%');
			$this->title=$strTitle;
		}
		$intCount = D('Live','Service')->count($arrWhere);
		$Page = new \Think\Page($intCount,7);// 实例化分页类 传入总记录数和每页显示的记录数(7)
		$show = $Page->show();   // 分页显示输出
		$first = $Page->firstRow;
		$list = $Page->listRows;
		$arrData = D('Live','Service')->findAll($arrWhere,$first,$list);
		$this->count = $intCount;
		$this->page = $show;
		$this->list = $arrData;
		$this->display();
	}
	
	public function add(){
		 $live = M('tg_live');
	  	 $data = $live->create(); 
	 	if(IS_POST){
			$data['create_time'] = time();
			$arrData = $live->data($data)->add();
			if($arrData){
			$this->success('添加成功！','/Admin/Live/index');
			}else {
			$this->error('添加失败！');
			}
			
		}else{
			$this->display();
		}
		
	}
	
	public function edit(){
	     $live = M('tg_live');
	  	 $data = $live->create(); 
	 	if(IS_POST){
			$data['create_time'] = time();
			$arrData = $live->data($data)->add();
			if($arrData){
			$this->success('修改成功！','/Admin/Live/index');
			}else {
			$this->error('修改失败！');
			}
			
		}else {
			$arrWhere['lid'] =I('get.lid');
			$arrData = D('Live','Service')->findOne($arrWhere);
			$this->list = $arrData;
			$this->display();
		}
		
	}

	public function delete(){
	
		$arrWhere['lid'] =I('get.lid');
		
		$arrData = D('Live','Service')->delete($arrWhere);
		if($arrData){
			$this->success('删除成功！','/Admin/Live/index');
		}else {
			$this->error('删除失败！');
		}
		$this->display();
	}
	public function message(){
		if(IS_POST){
			$arrWhere = I('post.');
			$id = I('post.check');
			$code = M('tg_phone')->where(array('hid'=>$id))->find();
			if($arrWhere['smsCode']!=$code['code']){
				$this->error('验证码错误！');
			}
			dump($arrWhere);
			dump($code);
			exit();
		}
	   else{
	   	$this->display();
	   }
		$this->display();
	}
	 public  function sendSMS(){
	 	$ch = curl_init();
	 	// 必要参数
	 	$apikey = "d0a614ab1e413bb0ef972f42d88fe57f"; //修改为您的apikey(https://www.yunpian.com)登录官网后获取
	 	$mobile =  $_POST['mobile']; //请用手机号代替
	 	$code = $this->createSMSCode();
	 	$text="【天使家教】您的验证码是".$code."，如非本人操作，请忽略本短信";
	 	//将验证码存入数据库
	 	$data['code'] = $code;
	 	$data['creat_time'] = time();
	    $id = M('tg_phone')->data($data)->add();
	 	// 发送短信
	 	$data=array('text'=>$text,'apikey'=>$apikey,'mobile'=>$mobile);
	 	curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/single_send.json');
	 	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	 	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	 	$json_data = curl_exec($ch);
	 	//解析返回结果（json格式字符串）
	 	$array = json_decode($json_data,true);
	 	$array['smsCode'] = $id;
	 	echo json_encode($array);
	 	
	 }
	 /**
	  *  随机生成4位验证码
	  */
	 public function createSMSCode($length = 4){
	 	$min = pow(10 , ($length - 1));
	 	$max = pow(10, $length) - 1;
	 	return rand($min, $max);
	 }
		$this->display();
	}
	
	public function edit(){
		$this->display();
	}


 
}
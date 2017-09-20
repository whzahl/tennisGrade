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
    public function add(){
    	$place = M('tg_place');
    	$data = $place->create();
    	if(IS_POST){
    	$smsCode = I('post.smsCode');
    	$id = I('post.check');
    	$code = M('tg_phone')->where(array('hid'=>$id))->find();
    	if($smsCode!=$code['code']){
    		$this->error('验证码错误！');
    	}else{
	    	  $upload = new \Think\Upload();// 实例化上传类
	    	  $upload->maxSize   =     553145728 ;// 设置附件上传大小
	    	  $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    	  $upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
	    	  $info   =    $upload->uploadOne($_FILES['certificate']); // 上传文件
	    	  $info1   =    $upload->upload(array($_FILES['picture'])); // 上传多个文件
    		if(!empty($info)){
    			$data['certificate'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
    		}
    		if(!empty($info1)){
    			$arrurl= array();
    			foreach ($info1 as $k => $v){
    				$arrurl[] = '/Public/Uploads/'.$v['savepath'].$v['savename']; //每个上传路径重新组合成数组
    				
    			}
    			$data['picture'] = implode('、',$arrurl);
    		}
//    		$wx = M('tg_user')->where($_SESSION['userInfo']['unionid'])->select();
    		$wx = M('tg_user')->where(array('unionid'=>'o_vIF1FGUba-wAN9DyQ9jDoUAEu8'))->find();
 //   		dump($wx);
 //   		dump($wx['id']);
  //  		exit();
    		$data['id'] = $wx['id'];
    		$data['status'] = 2;
    		$data['create_time'] = time();
    	    $arrData = $place->data($data)->add();
    	    if($arrData){
    		    $this->success('提交成功，请等待审核！');
    	    }else {
    		    $this->error('提交失败！');
    	    }
    	}
    }}

	/**
	 *  发送验证码
	 */
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
	
}
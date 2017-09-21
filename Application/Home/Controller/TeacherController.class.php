<?php 
/* 
 * 考官模块
 *  */

namespace Home\Controller;
use Home\Controller\CheckController;

class TeacherController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}

    public function index(){
        $province = M('tg_province')->select();
        $this->province = $province;
        $chTitle = '考官申请';
        $enTitle = 'Examiner Application';
        $this->chTitle = $chTitle;
        $this->enTitle = $enTitle;
        $this->display();
    }

    public function add(){
    	$str = $_SESSION['userInfo'];
    	$place = M('tg_teacher');
    	$data = $place->create();
	    if(IS_POST){
    		$arrWhere = I('post.');
    		$id = I('post.check');
    		$code = M('tg_phone')->where(array('hid'=>$id))->find();
    		if($arrWhere['smsCode']!=$code['code']){
    			$this->error('验证码错误！');
    		}else {
    			$upload = new \Think\Upload();// 实例化上传类
    			$upload->maxSize   =     6145728 ;// 设置附件上传大小
    			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    			$upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录 
    			// 上传文件
    			$info = $upload->uploadOne($_FILES['picture']);
    			$infos = $upload->upload(array($_FILES['certificate']));
	    		if(!empty($info)){
	    			$data['picture'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
	    		}
	    		if(!empty($infos)){
	    			$arrurl= array();
	    			foreach ($infos as $k => $v){
	    				$arrurl[] = '/Public/Uploads/'.$v['savepath'].$v['savename']; //每个上传路径重新组合成数组
	    				
	    			}
	    			$data['certificate'] = implode('、',$arrurl);
	    		}
	    		$wx = M('tg_user')->where(array('unionid'=>$str['unionid']))->find();
	    		$data['pid'] = $arrWhere['pid'];
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
    	}
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

}
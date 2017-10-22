<?php 
/* 
 * 考生模块
 *  */

namespace Home\Controller;
use Home\Controller\CheckController;

class StudentController extends CheckController{
      
	public function __construct(){
		parent::__construct();
	}

    public function index(){
        $province = M('tg_province')->select();
        $this->province = $province;
        $chTitle = '考生报名';
        $enTitle = 'Candidates Application';
        $this->chTitle = $chTitle;
        $this->enTitle = $enTitle;
	    $this->display();
    }

    public function add(){
    	$student = M('tg_student');
    	$data = $student->create();
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
    			$info   =    $upload->uploadOne($_FILES['picture']); // 上传文件
    			if(!empty($info)){
    				$data['picture'] = '/Public/Uploads/'.$info['savepath'].$info['savename'];
    			}
    			$strLevel = I('level');
    			$data['level'] = implode('、',$strLevel);
                $wx = M('tg_user')->where("unionid='%s'", $_SESSION['userInfo']['unionid'])->find();  //从微信登录表里找到对应微信主键
//    			$wx = M('tg_user')->where(array('unionid'=>'o_vIF1FGUba-wAN9DyQ9jDoUAEu8'))->find();
    			$data['id'] = $wx['id'];
    			$data['status'] = 2;
    			$data['create_time'] = time();
    			$arrData = $student->data($data)->add();
    			if($arrData){
    				$this->success('提交成功，请等待！');
    			}else {
    				$this->error('提交失败！');
    			}
    		}
    	}}



}
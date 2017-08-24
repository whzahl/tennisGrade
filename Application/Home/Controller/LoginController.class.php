<?php
/* 
 * 登录模块
 *  */
namespace Home\Controller;
use Home\Controller\CheckController;

class LoginController extends CheckController{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function wxlogin(){
		$str = $_SESSION['userInfo'];
		$arrWhere['unionid'] = $str['unionid'];
		$arrData = D('User','Service')->check($arrWhere);
		session('userInfo', array(
		'unionid' => $arrData['unionid']
		));
		if ($arrData) {
			$this->redirect('/Home/User/index');
		}else {
			$arrWhere['login_time'] = time();
			$arrWhere['nickname'] = $str['nickname'];
			if ($str['sex']  ==1 ) {
				$arrWhere['sex'] = "男";
			}elseif ($str['sex'] ==2 ){
				$arrWhere["sex"] = "女";
			}
			$arrWhere['openid'] = $str['openid'];
			$arrWhere['unionid'] = $str['unionid'];
			$arrWhere['headimgurl'] = $str['headimgurl'];
			$arrWhere['province'] = $str['province'];
			$arrWhere['city'] = $str['city'];
			$arrDatas = D('User','Service')->add($arrWhere);
			session('userInfo', array(
			'unionid' => $arrDatas
			));
			if ($arrDatas) {
				$this->redirect('/Home/User/index');
			}
		}
	}
	
	
	/*
	 * 退出
	*   */
	public function logout(){
		session('userInfo',null);
		$this->success('退出成功','/Home/Index/index');
	}
	
}




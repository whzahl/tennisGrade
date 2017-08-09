<?php
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  min <min_xiaoxie@163.com>
// +----------------------------------------------------------------------
// | 2016-7-2
// +----------------------------------------------------------------------
/**
 *	微信登录
 */
namespace Home\Controller;
use Home\Controller\CheckController;
class WechatController extends CheckController {
	
	public function __construct(){
		parent::__construct();
	}
	
    public function index(){
    	$str = $_SESSION['userInfo'];
    	$arrWhere['username'] = $str['nickname'];
    	if ($str['sex']  ==1 ) {
    		$arrWhere['gen'] = "男";
    	}elseif ($str['sex'] ==2 ){
    		$arrWhere["gen"] = "女";
    	}
    	$arrWhere['headimgurl'] = $str['headimgurl'];
    	$arrWhere['unionid'] = $str['unionid'];
    	$arrWhere['province'] = $str['province'];
    	$arrWhere['city'] = $str['city'];
    	$arrWhere['create_time'] = time();
    	$arrData = D('User','Service') ->add($arrWhere);
    	session('userInfo', array(
    	'userid' => $arrData
    	));
    	if ($arrData) {
    		$this->redirect('Home/User/index');
    	}
        $this->display();
    }
    
    
    public function wechat(){
    	
    	
    	
    	
    }
    
    
    
    
    
    
    
    
    
    
    
    
}
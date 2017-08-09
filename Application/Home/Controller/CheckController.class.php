<?php
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  min <min_wenhao@163.com>
// +----------------------------------------------------------------------
// | 2016-7-2
// +----------------------------------------------------------------------
/**
 *	用户登录检测类
 *	所有的需要用户登录才可以访问和操作的Controller都得继承
 */
namespace Home\Controller;
use Home\Controller\BaseController;
class CheckController extends BaseController {
    
    public function __construct(){
        parent::__construct();
        
        // 获取登录的Session
        $session = $_SESSION['User'];
        
        // 判断是否登录
        if(!$session){
        	//	跳转登录界面
           	$this->redirect('https://open.weixin.qq.com/connect/qrconnect?appid=wx97cea69a39e328a5&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect');
        }
    }
    
}
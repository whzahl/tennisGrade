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
        //gyh 便于开发前端页面 暂时注释 start--- 结束开发后恢复start-end
       $session = $_SESSION['userInfo'];
//
       // 判断是否登录
       if(!$session){
       	$this->redirect('/Home/Index/index');
       }else{
       	$this->unionid = $session['unionid'];
       }
    }
    
}
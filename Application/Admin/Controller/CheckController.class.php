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
namespace Admin\Controller;
use Admin\Controller\BaseController;
class CheckController extends BaseController {
    
    public function __construct(){
        parent::__construct();
        
        // 获取登录的Session
        $arrSession = $_SESSION['Type'];
        $arrSession1 = $_SESSION['TgAdmin'];
        // 判断是否登录
        //        暂时注释


        if(!($arrSession||$arrSession1)){
//            //	跳转登录界面
            $this->redirect('Admin/Login/login');
        }else{
            $this->uid = $arrSession['uid'];
            $this->uname = $arrSession['uname'];
        }
        //        暂时注释


//         $_SESSION['btype'] = $type;
//         $this->btype=$_SESSION['btype'];
    }
    
}
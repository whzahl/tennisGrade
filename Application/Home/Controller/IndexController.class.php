<?php
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  min <min_wenhao@163.com>
// +----------------------------------------------------------------------
// | 2016-7-2
// +----------------------------------------------------------------------
/**
 *	首页
 */
namespace Home\Controller;
use Home\Controller\BaseController;
class IndexController extends BaseController {
	
	public function __construct(){
		parent::__construct();
	}
	
   
    public function index(){
    	$this->display();
    }
    public function test1(){
    	$test = M('tg_weixintest');
    	$data = $_SESSION['userInfo'];
    	$data['time'] = time();
    	$unionid = $data['unionid'];
    	$intid = $test->where(array('id'=>$unionid))->find();
    	if(!empty($intid)){
    		$this->success('登录成功！','/Home/Index/test');
    	}else{
    		$id = $test->data($data)->add();
    		if(!empty($id)){
    			$this->success('登录成功！',U('/Home/Index/test',array('id'=>$id)));
    		}else{
    			$this->error('登录失败！');
    		}
    	}
    	
    }
    public function test(){
    	echo $_SESSION['userInfo']['unionid'];
    	$this->display();
    }
    
}
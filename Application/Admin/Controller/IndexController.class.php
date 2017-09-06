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
namespace Admin\Controller;
use Admin\Controller\CheckController;
class IndexController extends CheckController {
	
	public function __construct(){
		parent::__construct();
	}
	
    public function index(){
//     	$type=I('get.type');
//     	$pid = I('get.pid');
//     	$pdata = M('tg_place')->where(array('pid'=>$pid))->find();
//     	session('Type',array(
//     	'type' => $type,
//     	'uid' => $pid,
//     	'uname'=>$pdata['pname']
//     	));
        $this->display();
    }
}
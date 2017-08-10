<?php
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  min <min_wenhao@163.com>
// +----------------------------------------------------------------------
// | 2016-7-2
// +----------------------------------------------------------------------
/**
 *	用户中心
 */
namespace Home\Controller;
use Home\Controller\CheckController;
class UserController extends CheckController {
	
	public function __construct(){
		parent::__construct();
	}
	
    public function index(){
        $this->display();
    }
}
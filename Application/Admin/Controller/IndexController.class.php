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
        $this->display();
    }
}
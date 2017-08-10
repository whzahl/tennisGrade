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
}
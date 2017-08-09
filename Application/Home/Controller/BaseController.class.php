<?php
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  min <min_wenhao@163.com>
// +----------------------------------------------------------------------
// | 2016-7-2
// +----------------------------------------------------------------------
/**
 *	基类
 *	所有的Controller都得继承
 */
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    
    public function __construct(){
        parent::__construct();
    }
    
}
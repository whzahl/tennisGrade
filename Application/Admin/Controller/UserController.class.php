<?php
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  min <min_wenhao@163.com>
// | Author:  min <min_xiaoxie@163.com>
// | Author:  min <min_wenhao@163.com>
// +----------------------------------------------------------------------
// | 2016-7-2
// +----------------------------------------------------------------------
/**
 *	用户中心
 */
namespace Admin\Controller;
use Admin\Controller\CheckController;
class UserController extends CheckController {
	
	public function __construct(){
		parent::__construct();
	}
	
    public function index(){
        $this->display();
    }
    	$intCount = D('User','Service') ->count($arrWhere);
    	$Page = new \Think\Page($intCount,10);
    	$show =  $Page ->show();
    	$first =  $Page->firstRow;
    	$list = $Page->listRows;
    	$arrData = D('User','Service') ->findAll($arrWhere,$first,$list);
    	$this-> count = $intCount;
    	$this-> page = $show;
    	$this-> list = $arrData;
        $this->display();
    }
    
    public function delete(){
    	$arrWhere['id'] = I('get.id');
    	$arrData = D('User','Service') ->delete($arrWhere);
    	if ($arrData){
    		$this->success('删除成功','/Admin/User/index');
    	}else{
    		$this->error('删除失败');
    	}
    }
    
    
   
        $this->display();
    }
}
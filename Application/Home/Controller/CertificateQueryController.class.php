<?php
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  min <min_wenhao@163.com>
// +----------------------------------------------------------------------
// | 2016-7-2
// +----------------------------------------------------------------------
/**
 *	证书查询
 */
namespace Home\Controller;
use Home\Controller\BaseController;

class CertificateQueryController extends BaseController {
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->display();
    }

    public function student(){
        $arrWhere['sname'] = I('get.sname');
        $arrWhere['creid'] = I('get.creid');
        $arrWhere['cretype'] = I('get.cretype');
        $arrData = D('Student','Service')->findOne($arrWhere);
        if ($arrData){
            $this->ajaxReturn($arrData,'json');
        }
        else{
            $this->error('');
        }
    }

    public function Certificate(){
        $arrWhere['sid'] = I('get.sid');
        $arrData = D('Grade','Service')->findOne($arrWhere);
        if ($arrData){
            $this->ajaxReturn($arrData,'json');
        }
        else{
            $this->error('');
        }
    }
}
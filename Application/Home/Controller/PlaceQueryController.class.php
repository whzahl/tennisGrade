<?php
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  min <min_wenhao@163.com>
// +----------------------------------------------------------------------
// | 2016-7-2
// +----------------------------------------------------------------------
/**
 *	考点查询
 */
namespace Home\Controller;
use Home\Controller\BaseController;

class PlaceQueryController extends BaseController{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $province = M('tg_province')->select();
        $this->province = $province;
        $chTitle = '考点查询';
        $enTitle = 'Test Sites Query';
        $this->chTitle = $chTitle;
        $this->enTitle = $enTitle;
        $this->display();
    }

    public function content(){
        $arrWhere['pid'] = I('get.pid');
        $arrData = D('Place','Service')->findOne($arrWhere);
        $picture = explode('、',$arrData['picture']);
        $chTitle = '考点详情';
        $enTitle = 'Test Sites Details';
        $this->list = $arrData;
        $this->picture = $picture;

        $this->chTitle = $chTitle;
        $this->enTitle = $enTitle;
        $this->display();
    }
}

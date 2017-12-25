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
    	//考生信息
    	$arrWhere['id'] = $_SESSION['userInfo']['id'];
    	$arrWhere['status'] = 1;
    	$arrUser = M('tg_student')->where($arrWhere)->order('create_time desc')->limit(1)->select();
    	
    	if(empty($arrUser)){
    		$arrWheres['id'] = $_SESSION['userInfo']['id'];
    		$arrUsers = M('tg_student')->where($arrWheres)->order('create_time desc')->limit(1)->select();
    	}
    	$arrlevel = explode('、',$arrUser['0']['level']);
    	$i = count($arrlevel);
    	$i=$i-1;
    	$arrWheres['id'] = $_SESSION['userInfo']['id'];
    	$arrData = M('tg_student')->where($arrWheres)->order('create_time desc')->select();
    	foreach ($arrData as $k => $v){
    		$arrlevels = explode('、',$v['level']);
    		$i = count($arrlevels) - 1;
    		$arrData[$k]['level'] = $arrlevels[$i];
    		$pid = $v['pid'];
    		$arrp = M('tg_place')->where(array('pid'=>$pid))->find();
    		$arrData[$k]['place'] = $arrp['pname'];
    	}
    	
    	//考官信息
    	$arrWheret['id'] = $_SESSION['userInfo']['id'];
    	$arrTeach= M('tg_teacher')->where($arrWheret)->order('create_time desc')->select();
    	foreach ($arrTeach as $key => $val){
    	$province = $val['province'];
    	$pro = M('tg_province')->where(array('code'=>$province))->select();
    	$arrTeach[$key]['province'] = $pro['0']['name'];
    	$city = $val['city'];
    	$city = M('tg_city')->where(array('code'=>$city))->select();
    	$arrTeach[$key]['city'] = $city['0']['name'];
    	$area = $val['area'];
    	$area = M('tg_area')->where(array('code'=>$area))->select();
    	$arrTeach[$key]['area'] = $area['0']['name'];
    	$tid = $val['tid'];
    	$count = M('tg_student')->where(array('tid'=>$tid))->count();
    	$arrTeach[$key]['count'] = $count;
    	}
    	
    	//考点信息
    	$arrWherep['id'] = $_SESSION['userInfo']['id'];
    	$arrPlace= M('tg_place')->where($arrWherep)->order('create_time desc')->select();
//    	dump($arrPlace);
//    	dump($arrWherep['id']);
//    	exit();
    	if(empty($arrUser)){
    		$this->user = $arrUsers['0'];
    	}else {
    		$this->user = $arrUser['0'];
    	}
    	$this->level = $arrlevel[$i];
    	$this->list = $arrData;
    	$this->teacher = $arrTeach;
    	$this->place = $arrPlace;
        $chTitle = '用户中心';
        $enTitle = 'User Center';
        $this->chTitle = $chTitle;
        $this->enTitle = $enTitle;
    	$this->display();
    }
    
    public function sqtk(){
    	$type = I('get.type');
    	$userid = I('get.userid');
    	if($type == 1){
    		$arrWhere['sid'] = $userid;
    		$arrWhere['pay'] = 2;
    		$arrData = M('tg_student')->data($arrWhere)->save();
    		$arrWheres['sid'] = $userid;
    		$arrDatas = M('tg_order')->where($arrWheres)->select();
    		$arrOrders['oid'] = $arrDatas['0']['oid'];
    		$arrOrders['status'] = 2;
    		$arrOrder = M('tg_order')->data($arrOrders)->save();
    	}elseif ($type == 2){
    		$arrWhere['tid'] = $userid;
    		$arrWhere['pay'] = 2;
    		$arrData = M('tg_teacher')->data($arrWhere)->save();
    		$arrWheres['tid'] = $userid;
    		$arrDatas = M('tg_order')->where($arrWheres)->select();

    		$arrOrders['oid'] = $arrDatas['0']['oid'];
    		$arrOrders['status'] = 2;
    		$arrOrder = M('tg_order')->data($arrOrders)->save();
    	}elseif ($type == 3){
    		$arrWhere['pid'] = $userid;
    		$arrWhere['pay'] = 2;
    		$arrData = M('tg_place')->data($arrWhere)->save();
    		$arrWheres['pid'] = $userid;
    		$arrDatas = M('tg_order')->where($arrWheres)->select();
    		$arrOrders['oid'] = $arrDatas['0']['oid'];
    		$arrOrders['status'] = 2;
    		$arrOrder = M('tg_order')->data($arrOrders)->save();
    	}
    	
    	if(!empty($arrData)&&!empty($arrOrder)){
    		$this->success('申请成功，请等待管理员审核！');
    	}else {
    		$this->error('申请失败，请重试！');
    	}
    }
    
    
}
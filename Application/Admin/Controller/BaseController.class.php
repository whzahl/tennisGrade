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
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
    
    public function __construct(){
        parent::__construct();
    }
    
    
    public function city(){
    	$arrWhere['provincecode'] = I('get.code');
    	$city = M('tg_city')->where($arrWhere)->select();
    	$city = json_encode($city);
    	echo $city;
    }
    
    public function area(){
    	$arrWhere['citycode'] = I('get.code');
    	$area = M('tg_area')->where($arrWhere)->select();
    	$area = json_encode($area);
    	echo $area;
    }
    
    public function place(){
    	$arrWhere['area'] = I('get.code');
    	//        $place = D('Place','Service')->findAll($arrWhere);
    	$place = M('tg_place')->where($arrWhere)->select();
    	$place = json_encode($place);
    	echo $place;
    
    }
    
}
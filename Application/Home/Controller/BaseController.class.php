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
    public function uploadPic(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
        $info =  $upload->upload();
        if($info){
            // 水印
            $url = $info['upfile']['savepath'].$info['upfile']['savename'];
            echo json_encode(array(
                'url'=>$url,
                'title'=>htmlspecialchars($_POST['pictitle'], ENT_QUOTES),
                'original'=>$info['upfile']['name'],
                'state'=>'SUCCESS',
                'info' => $info
            ));
        }else{
            echo json_encode(array(
                'state'=>$upload->getError()
            ));
        }
    }

    public function city(){
        $arrWhere['provincecode'] = I('get.code');
        $city = M('tg_city')->where($arrWhere)->select();
        $this->ajaxReturn($city,"json");
    }

    public function area(){
        $arrWhere['citycode'] = I('get.code');
        $area = M('tg_area')->where($arrWhere)->select();
        //thinkphp内置的方法
        $this->ajaxReturn($area,"json");
//        php原生方法
//        $area = json_encode($area);
//        echo $area;
    }

    public function place(){
        $arrWhere['area'] = I('get.code');
        $arrWhere['status'] = 1;
        $place = D('Place','Service')->findAll($arrWhere);
        $this->ajaxReturn($place,"json");
    }

    public function teacher(){
        $arrWhere['pid'] = I('get.pid');
        $arrWhere['status'] = 1;
        $teacher = D('Teacher','Service')->findAll($arrWhere);
        $this->ajaxReturn($teacher,"json");
    }

//     public function teacher(){
//     	$arrWhere['pid'] = I('get.pid');
//     	//        $place = D('Place','Service')->findAll($arrWhere);
//     	$teacher = M('tg_teacher')->where($arrWhere)->select();
//     	$teacher = json_encode($teacher);
//     	echo $teacher;
    
//     }

}
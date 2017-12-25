<?php
/**
 *视频中心
 */
namespace Home\Controller;
use Home\Controller\BaseController;
class VideoController extends BaseController{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $chTitle = '视频中心';
        $enTitle = 'Video Center';
        $this->chTitle = $chTitle;
        $this->enTitle = $enTitle;
        $this->display();
    }
    public function content(){
        $chTitle = '视频播放';
        $enTitle = 'Video Play';
        $this->chTitle = $chTitle;
        $this->enTitle = $enTitle;
        $this->display();
    }
}
<?php
/* 
 * 订单模块
 *  */

namespace Admin\Controller;
use Admin\Controller\CheckController;

class OrderController extends CheckController{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$intCount = D('Order','Service') ->count($arrWhere);
		$Page = new \Think\Page($intCount,10);
		$show =  $Page ->show();
		$first =  $Page->firstRow;
		$list = $Page->listRows;
		$arrData = D('Order','Service') ->findAll($arrWhere,$first,$list);
		foreach($arrData as $k=>$v){
			if(!empty($v['sid'])){
				$sid =$v['sid'];
				$arrDatas = M('tg_student')->where(array('sid'=>$sid))->find();
				$arrData[$k]['state'] = 1;
				$arrData[$k]['name'] = $arrDatas['sname'];
				$arrData[$k]['phone'] = $arrDatas['phone'];
				$arrData[$k]['pay'] = $arrDatas['pay'];
				
			}
			if(!empty($v['tid'])){
				$tid =$v['tid'];
				$arrDatas = M('tg_teacher')->where(array('tid'=>$tid))->find();
				$arrData[$k]['state'] = 2;
				$arrData[$k]['name'] = $arrDatas['tname'];
				$arrData[$k]['phone'] = $arrDatas['phone'];
				$arrData[$k]['pay'] = $arrDatas['pay'];
			}
			if(!empty($v['pid'])){
				$pid =$v['pid'];
				$arrDatas = M('tg_place')->where(array('pid'=>$pid))->find();
				$arrData[$k]['state'] = 2;
				$arrData[$k]['name'] = $arrDatas['pname'];
				$arrData[$k]['phone'] = $arrDatas['phone'];
				$arrData[$k]['pay'] = $arrDatas['pay'];
			}
		}
		$this-> count = $intCount;
		$this-> page = $show;
		$this-> list = $arrData;
		$this->display();
	}
	
	public function refund(){
		vendor('Weixinpay.WxPayPubHelper');
		$out_trade_no = I('get.oid');
		$refund_fee = I('get.price');
		//商户退款单号，商户自定义，此处仅作举例
		$time_stamp = time();
		$out_refund_no = "$out_trade_no"."$time_stamp";
		//总金额需与订单号out_trade_no对应，demo中的所有订单的总金额为1分
		//$total_fee = "1";
		$refund_fee = $refund_fee*100;
		$total_fee = $refund_fee;
		//使用退款接口
		$refund = new \Refund_pub();
		//设置必填参数
		//appid已填,商户无需重复填写
		//mch_id已填,商户无需重复填写
		//noncestr已填,商户无需重复填写
		//sign已填,商户无需重复填写
		$refund->setParameter("out_trade_no","$out_trade_no");//商户订单号
		$refund->setParameter("out_refund_no","$out_refund_no");//商户退款单号
		$refund->setParameter("total_fee","$total_fee");//总金额
		$refund->setParameter("refund_fee","$refund_fee");//退款金额
		$refund->setParameter("op_user_id",\WxPayConf_pub::MCHID);//操作员
		//非必填参数，商户可根据实际情况选填
		//$refund->setParameter("sub_mch_id","XXXX");//子商户号
		//$refund->setParameter("device_info","XXXX");//设备号
		//$refund->setParameter("transaction_id","XXXX");//微信订单号
		
		//调用结果
		$refundResult = $refund->getResult();
		
		//商户根据实际情况设置相应的处理流程,此处仅作举例
		if ($refundResult["return_code"] == "FAIL") {
			echo "通信出错：".$refundResult['return_msg']."<br>";
		}else{
			if($refundResult['result_code'] == "FAIL"){
			  echo "错误代码：".$refundResult['err_code']."<br>";
			  echo "错误代码描述：".$refundResult['err_code_des']."<br>";
			}else {
				$arrWhere['oid'] = $refundResult['out_trade_no'];
				$arrWhere['status'] = 3;
				M('tg_order')->data($arrWhere)->save();
				$arrOrder = M('tg_order')->where(array('oid'=>$refundResult['out_trade_no']))->find();
				if(!empty($arrOrder['sid'])){
					$arrWheres['sid'] = $arrOrder['sid'];
					$arrWheres['pay'] = 3;
					M('tg_student')->data($arrWheres)->save();
				}
				if(!empty($arrOrder['tid'])){
					$arrWheres['tid'] = $arrOrder['tid'];
					$arrWheres['pay'] = 3;
					M('tg_teacher')->data($arrWheres)->save();
				}
				if(!empty($arrOrder['pid'])){
					$arrWheres['pid'] = $arrOrder['pid'];
					$arrWheres['pay'] = 3;
					M('tg_place')->data($arrWheres)->save();
				}
				$this->success('退款成功！');
			}
			
// 			echo "业务结果：".$refundResult['result_code']."<br>";
// 			echo "错误代码：".$refundResult['err_code']."<br>";
// 			echo "错误代码描述：".$refundResult['err_code_des']."<br>";
// 			echo "公众账号ID：".$refundResult['appid']."<br>";
// 			echo "商户号：".$refundResult['mch_id']."<br>";
// 			echo "子商户号：".$refundResult['sub_mch_id']."<br>";
// 			echo "设备号：".$refundResult['device_info']."<br>";
// 			echo "签名：".$refundResult['sign']."<br>";
// 			echo "微信订单号：".$refundResult['transaction_id']."<br>";
// 			echo "商户订单号：".$refundResult['out_trade_no']."<br>";
// 			echo "商户退款单号：".$refundResult['out_refund_no']."<br>";
// 			echo "微信退款单号：".$refundResult['refund_idrefund_id']."<br>";
// 			echo "退款渠道：".$refundResult['refund_channel']."<br>";
// 			echo "退款金额：".$refundResult['refund_fee']."<br>";
// 			echo "现金券退款金额：".$refundResult['coupon_refund_fee']."<br>";
		}
	}
}



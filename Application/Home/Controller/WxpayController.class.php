<?php
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  min <min_wenhao@163.com>
// +----------------------------------------------------------------------
// | 2016-7-2
// +----------------------------------------------------------------------
/**
 *	用户登录检测类
 *	所有的需要用户登录才可以访问和操作的Controller都得继承
 */
namespace Home\Controller;
use Home\Controller\BaseController;
class WxpayController extends BaseController {
    
    public function __construct(){
        parent::__construct();
    }
    
    public function weixinpay(){
        //判断该报名用户是否有未支付的订单存在，存在取出他的信息，不存在就创建新的订单
        $arrWhere = I('get.');
        $where = array(
            'id' => $arrWhere['id'],
            'status' => 0
        );
        if($arrWhere['type'] == 1){
            $where['sid'] = $arrWhere['userid'];
        }
        if($arrWhere['type'] == 2){
            $where['tid'] = $arrWhere['userid'];
        }
        if($arrWhere['type'] == 3){
            $where['pid'] = $arrWhere['userid'];
        }
        $data = D('Order','Service')->findOne($where);
        if($data){
            $order_sn = $data['oid'];
        }

//        凡姐的代码
//    	$order_sn = I('get.order_sn');

//    	dump(I('get.order_sn'));
//    	exit();
    	if(empty($order_sn)){
    		//    添加订单
    		$type = I('get.type');
    		$id = I('get.id');
    		$userid = I('get.userid');
    		/* 	dump($type);
    		 dump($id);
    		dump($userid);
    		exit(); */
    		if ($type == 1){
    			//  生成订单
    			$arrOrder['id'] = $id;
    			$arrOrder['sid'] = $userid;
    			$arrOrder['title'] = "考生交费";
    			$arrOrder['price'] = "0.01";
    			$arrOrder['type'] = "PC";
    			$arrOrder['create_time'] = time();
    			$order_sn = M('tg_order')->data($arrOrder)->add();
    				
    			// 传送微信支付参数
    			$res = array(
    					'order_sn' => $order_sn,
    					'order_amount' => $arrOrder['price'],
    					'order_title' => "考生交费"
    			);
    		}
    		elseif ($type == 2){
    			//  生成订单
    			$arrOrder['id'] = $id;
    			$arrOrder['tid'] = $userid;
    			$arrOrder['title'] = "考官交费";
    			$arrOrder['price'] = "0.02";
    			$arrOrder['type'] = "PC";
    			$arrOrder['create_time'] = time();
    			$order_sn = M('tg_order')->data($arrOrder)->add();
    				
    			// 传送微信支付参数
    			$res = array(
    					'order_sn' => $order_sn,
    					'order_amount' => $arrOrder['price'],
    					'order_title' => "考官交费"
    			);
    		}
    		elseif($type == 3){
    			//  生成订单
    			$arrOrder['id'] = $id;
    			$arrOrder['pid'] = $userid;
    			$arrOrder['title'] = "考点交费";
    			$arrOrder['price'] = "0.03";
    			$arrOrder['type'] = "PC";
    			$arrOrder['create_time'] = time();
    			$order_sn = M('tg_order')->data($arrOrder)->add();
    	
    			// 传送微信支付参数
    			$res = array(
    					'order_sn' => $order_sn,
    					'order_amount' => $arrOrder['price'],
    					'order_title' => "考点交费"
    			);
    		}
    		 
    	}else{
    		$arrWhere['oid'] = $order_sn;
    		$result = M('tg_order')->where(array('oid'=>$arrWhere['oid']))->find();
    		$res = array(
    				'order_sn' => $result['oid'],
    				'order_amount' => $result['price'],
    				'order_title' => $result['title']
    		);
    	
    	}
    	
    	vendor('Weixinpay.WxPayPubHelper');
    	//使用统一支付接口
    	$unifiedOrder = new \UnifiedOrder_pub();
    
    	//设置统一支付接口参数
    	//设置必填参数
    	//appid已填,商户无需重复填写
    	//mch_id已填,商户无需重复填写
    	//noncestr已填,商户无需重复填写
    	//spbill_create_ip已填,商户无需重复填写
    	//sign已填,商户无需重复填写
    	$total_fee = $res['order_amount']*100;
    	$body = $res['order_title'];
    	$unifiedOrder->setParameter("body", $body);//商品描述
    	//自定义订单号，此处仅作举例
    	$out_trade_no = $res['order_sn'];
    	$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号
    	$unifiedOrder->setParameter("total_fee","$total_fee");//总金额
    	$unifiedOrder->setParameter("notify_url",\WxPayConf_pub::NOTIFY_URL);//通知地址
    	$unifiedOrder->setParameter("trade_type","NATIVE");//交易类型
    	//非必填参数，商户可根据实际情况选填
    	//$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号
    	//$unifiedOrder->setParameter("device_info","XXXX");//设备号
    	//$unifiedOrder->setParameter("attach","XXXX");//附加数据
    	//$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
    	//$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间
    	//$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记
    	//$unifiedOrder->setParameter("openid","XXXX");//用户标识
    	//$unifiedOrder->setParameter("product_id","XXXX");//商品ID
    
    	//获取统一支付接口结果
    	$unifiedOrderResult = $unifiedOrder->getResult();
    
    	//商户根据实际情况设置相应的处理流程
    	if ($unifiedOrderResult["return_code"] == "FAIL")
    	{
    		//商户自行增加处理流程
    		echo "通信出错：".$unifiedOrderResult['return_msg']."<br>";
    	}
    	elseif($unifiedOrderResult["result_code"] == "FAIL")
    	{
    		//商户自行增加处理流程
    		echo "错误代码：".$unifiedOrderResult['err_code']."<br>";
    		echo "错误代码描述：".$unifiedOrderResult['err_code_des']."<br>";
    	}
    	elseif($unifiedOrderResult["code_url"] != NULL)
    	{
    		//从统一支付接口获取到code_url
    		$code_url = $unifiedOrderResult["code_url"];
    		//商户自行增加处理流程
    		//......
    	}
    	$this->assign('out_trade_no',$out_trade_no);
    	$this->assign('code_url',$code_url);
    	$this->assign('unifiedOrderResult',$unifiedOrderResult);

    	$this->display('qrcode');
    }

    public function notify(){
    	vendor('Weixinpay.WxPayPubHelper');

    	//使用通用通知接口
    	$notify = new \Notify_pub();
    	
    	//存储微信的回调
    	$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        $notify->saveData($xml);
    	 
    	//验证签名，并回应微信。
    	//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
    	//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
    	//尽可能提高通知的成功率，但微信不保证通知最终能成功。
        if($notify->checkSign() == FALSE){
            $notify->setReturnParameter("return_code", "FAIL");//返回状态码
            $notify->setReturnParameter("return_msg", "签名失败");//返回信息
        }else{
            $notify->setReturnParameter("return_code", "SUCCESS");//设置返回码
        }
    	 $returnXml = $notify->returnXml();
    	 $parameter = $notify->xmlToArray($xml);
//        echo $returnXml;
    
    	//==商户根据实际情况设置相应的处理流程，此处仅作举例=======
    	 
    	//以log文件形式记录回调信息
    	//         $log_ = new Log_();
        if($notify->checkSign() == TRUE){
            if ($notify->data["return_code"] == "FAIL") {
                //此处应该更新一下订单状态，商户自行增删操作
                //$this->log_result($log_name, "【通信出错】:\n".$xml."\n");
                //更新订单数据【通信出错】设为无效订单
                echo 'error';
            }
            else if($notify->data["result_code"] == "FAIL"){
                //此处应该更新一下订单状态，商户自行增删操作
                //$this->log_result($log_name, "【业务出错】:\n".$xml."\n");
                //更新订单数据【通信出错】设为无效订单
                echo 'error';
            }
    		else{
    			//此处应该更新一下订单状态，商户自行增删操作
    		$parameters = array(
	    				"out_trade_no"     => $parameter['out_trade_no'], //商户订单编号；
	    				"trade_no"     => $parameter['transaction_id'],     //微信交易号；
	    				"total_fee"     => $parameter['total_fee'],    //交易金额；
	    				"trade_status"  => $parameter['result_code'], //交易状态
	    				"notify_id"     => $parameter['nonce_str'],    //通知校验ID。
	    				"notify_time"   => $parameter['time_end'],  //通知的发送时间。
	    				"buyer_email"   => $parameter['openid'],  //买家支付帐号；
	    		);
	    		$out_trade_no = $parameters['out_trade_no'];
	    
	    		//处理成功后输出success，微信就不会再下发请求了
	                //  更新订单
	                $arrOrders['oid'] = $out_trade_no;
	                $arrOrders['status'] = 1;
	                $arrOrders['trade_no'] = $parameters['trade_no'];
	                $arrOrders['trade_status'] = $parameters['trade_status'];
	                $arrOrders['total_fee'] = $parameters['total_fee'];
	                $arrOrders['notify_id'] = $parameters['notify_id'];
	                $arrOrders['notify_time'] = $parameters['notify_time'];
	                $arrOrders['buyer_email'] = $parameters['buyer_email'];
	                $arrOrders['create_time'] = time();
	                M('tg_order')->data($arrOrders)->save();
	                //D('Orders','Service')->update($arrOrders);
	                //  更新商品状态
	                $arrWhere['oid'] = $out_trade_no;
	                $arrData=M('tg_order')->where(array('oid'=>$arrWhere['oid']))->find();
	                if(!empty($arrData['sid'])){
	                	//  更新答疑的状态
	                	$arrWheress['sid'] = $arrData['sid'];
	                	$arrWheress['pay'] = 1;
	                	M('tg_student')->data($arrWheress)->save();
	                	/* D('Question','Service')->editQuestion($arrWheres); */
	                }elseif (!empty($arrData['tid'])){
	                	//  更新作文状态
	                	$arrWherest['tid'] = $arrData['tid'];
	                	$arrWherest['pay'] = 1;
	                	M('tg_teacher')->data($arrWherest)->save();
	                }elseif (!empty($arrData['pid'])){
	                	//  更新作文状态
	                	$arrWheresp['pid'] = $arrData['pid'];
	                	$arrWheresp['pay'] = 1;
	                	M('tg_place')->data($arrWheresp)->save();
	                }
		    	echo 'success';
    		}
    		 
    		//商户自行增加处理流程,
    		//例如：更新订单状态
    		//例如：数据库操作
    		//例如：推送支付完成信息
    	}
    }
    

    public function js_api_call() {
    	$order_sn = I('get.order_sn');
//     	dump($order_sn);
//     	exit();
    	if(empty($order_sn)){
    		//    添加问题
    		if(IS_POST) {
    			$arrWhere['price'] = I('post.price');
    			//  生成订单
    			$arrOrder['id'] = 11;
    			$strTitle = "车行";
    			$arrOrder['title'] = $strTitle;
    			$arrOrder['price'] = $arrWhere['price'];
    				
    			$arrOrder['create_time'] = time();
    			$order_sn = M('tg_order')->data($arrOrder)->add();
    			
    			// 传送微信支付参数
    			$res = array(
    					'order_sn' => $order_sn,
    					'order_amount' => $arrWhere['price'],
    					'order_title' => "车行"
    			);
    		}
    	}else{
    		$arrWhere['oid'] = $order_sn;
    		$result = M('tg_order')->where(array('oid'=>$arrWhere['oid']))->find();
    		$res = array(
    				'order_sn' => $result['oid'],
    				'order_amount' => $result['price'],
    				'order_title' => $result['title']
    		);
    		 
    	}
    	vendor('Wechar.WxPayPubHelper');
    	//使用jsapi接口
    	$jsApi = new \JsApi_pub();
    	//=========步骤1：网页授权获取用户openid============
    	//通过code获得openid
    	if (!isset($_GET['code'])){
    		//触发微信返回code码
    		$url = $jsApi->createOauthUrlForCode('http://tennis.laigl.com/Home/Wxpay/js_api_call?order_sn='.$order_sn);
    		//$url = $jsApi->createOauthUrlForCode(\WxPayConf_pub::JS_API_CALL_URL);
    		Header("Location: $url");
    	}else{
    		//获取code码，以获取openid
    		$code = $_GET['code'];
    		$jsApi->setCode($code);
    		$openid = $jsApi->getOpenId();
    	}
    	 
    	//=========步骤2：使用统一支付接口，获取prepay_id============
    	//使用统一支付接口
    	$unifiedOrder = new \UnifiedOrder_pub();
    	//设置统一支付接口参数
    	//设置必填参数
    	//appid已填,商户无需重复填写
    	//mch_id已填,商户无需重复填写
    	//noncestr已填,商户无需重复填写
    	//spbill_create_ip已填,商户无需重复填写
    	//sign已填,商户无需重复填写
    	$total_fee = $res['order_amount']*100;
    	//$total_fee = 1;
    	$body = $res['order_title'];
    	$unifiedOrder->setParameter("openid", $openid);//用户标识
    	$unifiedOrder->setParameter("body", $body);//商品描述
    	//自定义订单号，此处仅作举例
    	$out_trade_no = $res['order_sn'];
    	$unifiedOrder->setParameter("out_trade_no", $out_trade_no);//商户订单号
    	$unifiedOrder->setParameter("total_fee", $total_fee);//总金额
    	//$unifiedOrder->setParameter("attach", "order_sn={$res['order_sn']}");//附加数据
    	$unifiedOrder->setParameter("notify_url", \WxPayConf_pub::NOTIFY_URL);//通知地址
    	$unifiedOrder->setParameter("trade_type", "JSAPI");//交易类型
    	//非必填参数，商户可根据实际情况选填
    	//$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号
    	//$unifiedOrder->setParameter("device_info","XXXX");//设备号
    	//$unifiedOrder->setParameter("attach","XXXX");//附加数据
    	//$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
    	//$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间
    	//$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记
    	//$unifiedOrder->setParameter("openid","XXXX");//用户标识
    	//$unifiedOrder->setParameter("product_id","XXXX");//商品ID
    	$prepay_id = $unifiedOrder->getPrepayId();
    	//=========步骤3：使用jsapi调起支付============
    	$jsApi->setPrepayId($prepay_id);
    	$jsApiParameters = $jsApi->getParameters();
    	//         $wxconf = json_decode($jsApiParameters, true);
    	//         if ($wxconf['package'] == 'prepay_id=') {
    	//             $this->error('当前订单存在异常，不能使用支付');
    	//         }
    	$this->assign('res', $res);
    	$this->assign('jsApiParameters', $jsApiParameters);
    	 
    	$this->display('jsapi');
    	 
    
    }
    
    /**
     *	支付成功
     */
    public function successs(){
    
    	$this->display();
    }
    
    /**
     *	支付失败
     */
    public function errors(){
    	$this->display();
    }
    
     
    //异步通知url，商户根据实际开发过程设定
    public function notify_url() {
    	vendor('Wechar.WxPayPubHelper');
    	//使用通用通知接口
    	$notify = new \Notify_pub();
    	//存储微信的回调
    	$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
    	$notify->saveData($xml);
    	//验证签名，并回应微信。
    	//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
    	//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
    	//尽可能提高通知的成功率，但微信不保证通知最终能成功。
    	if($notify->checkSign() == FALSE){
    		$notify->setReturnParameter("return_code", "FAIL");//返回状态码
    		$notify->setReturnParameter("return_msg", "签名失败");//返回信息
    	}else{
    		$notify->setReturnParameter("return_code", "SUCCESS");//设置返回码
    	}
    	$returnXml = $notify->returnXml();
    	//==商户根据实际情况设置相应的处理流程，此处仅作举例=======
    	//以log文件形式记录回调信息
    	//$log_name = "notify_url.log";//log文件路径
    	//$this->log_result($log_name, "【接收到的notify通知】:\n".$xml."\n");
    	$parameter = $notify->xmlToArray($xml);
    	//$this->log_result($log_name, "【接收到的notify通知】:\n".$parameter."\n");
    	if($notify->checkSign() == TRUE){
    		if ($notify->data["return_code"] == "FAIL") {
    			//此处应该更新一下订单状态，商户自行增删操作
    			//$this->log_result($log_name, "【通信出错】:\n".$xml."\n");
    			//更新订单数据【通信出错】设为无效订单
    			echo 'error';
    		}
    		else if($notify->data["result_code"] == "FAIL"){
    			//此处应该更新一下订单状态，商户自行增删操作
    			//$this->log_result($log_name, "【业务出错】:\n".$xml."\n");
    			//更新订单数据【通信出错】设为无效订单
    			echo 'error';
    		}
    		else{
    			//$this->log_result($log_name, "【支付成功】:\n".$xml."\n");
    			//我这里用到一个process方法，成功返回数据后处理，返回地数据具体可以参考微信的文档
    			$parameters = array(
    					"out_trade_no"     => $parameter['out_trade_no'], //商户订单编号；
    					"trade_no"     => $parameter['transaction_id'],     //微信交易号；
    					"total_fee"     => $parameter['total_fee'],    //交易金额；
    					"trade_status"  => $parameter['result_code'], //交易状态
    					"notify_id"     => $parameter['nonce_str'],    //通知校验ID。
    					"notify_time"   => $parameter['time_end'],  //通知的发送时间。
    					"buyer_email"   => $parameter['openid'],  //买家支付帐号；
    			);
    			$out_trade_no = $parameters['out_trade_no'];
    
    			//处理成功后输出success，微信就不会再下发请求了
    
    			//  更新订单
    			$arrOrders['oid'] = $out_trade_no;
    			$arrOrders['type'] = 'Wxpay';
    			$arrOrders['status'] = 1;
    			$arrOrders['trade_no'] = $parameters['trade_no'];
    			$arrOrders['trade_status'] = $parameters['trade_status'];
    			$arrOrders['total_fee'] = $parameters['total_fee'];
    			$arrOrders['notify_id'] = $parameters['notify_id'];
    			$arrOrders['notify_time'] = $parameters['notify_time'];
    			$arrOrders['buyer_email'] = $parameters['buyer_email'];
    			$arrOrders['create_time'] = time();
    			M('tg_order')->data($arrOrders)->save();
    
    			//  更新商品状态
    			$arrWhere['oid'] = $out_trade_no;
    
    			echo 'success';
    		}
    	}
    }
    
}
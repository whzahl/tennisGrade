<?php 
$code = isset($_GET('code')) ? $_GET['code'] :NULL;
$state = isset($_GET('state')) ? $_GET['state'] :NULL;

if(!$code || !$state){
	exit();
}

if ($state != 'STATE') {
	exit();
}
//使用code获取access_token
$appid = 'wx15359136cf22a1ed';
$AppSecret = '66947dfc5e9ed296b224353a94713ccc';
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$AppSecret&code=$code&grant_type=authorization_code";

/* $res = getHttps($url); */
echo '<pre/>';
print_r($url);
exit;
//使用获取到的oppenID和access_token换取用户个人信息
$urll = "https://api.weixin.qq.com/sns/userinfo?access_token=".$res['access_token']."&openid=".$res['oppenid'];
$userInfo = getHttps($urll);
 echo '<pre/>';
 print_r($userInfo);
 exit;
 
function getHttps($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$res = curl_exec($ch);
	curl_close($ch);
	//使用json转换成数组
	$res = json_decode($res,1);
	return $res;
}
 
 
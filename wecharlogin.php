<?php 
$code = isset($_GET['code']) ? $_GET['code'] : NULL;
$state = isset($_GET['state']) ? $_GET['state'] : NULL;
if (!$code || !$state) {
	exit();
}

if ($state != 'STATE') {
	exit();
}

$appid='wx73a44bbd78e9cf99' ;
$AppSecret ='44b9b9f7e6be29b58e2f14227bf29b3a';
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$AppSecret&code=$code&grant_type=authorization_code";
$res = getHttps($url);


$url1 = "https://api.weixin.qq.com/sns/userinfo?access_token=".$res['access_token']."&openid=".$res['openid']."&lang=zh_CN";
$userInfo = getHttps($url1);

session_start();
$_SESSION['userInfo'] = $userInfo;

header("Location:http://tennis.laigl.com/Home/Login/wxlogin");


function getHttps($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	$res = json_decode($output,1);
	return $res;
}













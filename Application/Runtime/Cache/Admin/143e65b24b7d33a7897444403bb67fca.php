<?php if (!defined('THINK_PATH')) exit();?><style>
.smessage {
	width:580px;
	margin:20px auto;
	border:1px solid #ddd;
	/*background:#fff;*/
	border-radius:5px;
	box-shadow:3px 5px 3px rgba(0,0,0,0.1);
}
.smessage .sheader {
	border-radius:5px 5px 0px 0px;
	padding:6px 10px;
	font-size:14px;
	border-bottom:1px solid #ddd;
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff',endColorstr='#f5f5f5',GradientType='0');
	background-image:-ms-linear-gradient(top,#ffffff,#f5f5f5);
	background-image:-moz-linear-gradient(top,#ffffff,#f5f5f5);
	background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0,#ffffff),color-stop(1,#f5f5f5));
}
.smessage .scontent {
	padding:20px;
	overflow:hidden;
	color:#666;
	background:#fff;
}
.smessage .scontent .success,.smessage .scontent .error {
	font-size:25px;
	text-indent:10px;
}
.smessage .scontent .jump {
	color:#999;
	font-size:12px;
	padding:10px;
	padding-left:70px;
}
.smessage .scontent .jump a {
	color:#00c;
}
</style>
<div class="smessage">
	<div class="sheader">系统提示</div>
	<div class="scontent">
		<?php if(isset($message)): ?><p class="success"><span class="AI-Succ"></span><?php echo($message); ?></p>
		<?php else: ?>
		<p class="error"><span class="AI-Err"></span><?php echo($error); ?></p><?php endif; ?>
		<p class="jump">页面将在 <b id="wait"><?php echo($waitSecond); ?></b> 秒后自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a></p>
	</div>
</div>

<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
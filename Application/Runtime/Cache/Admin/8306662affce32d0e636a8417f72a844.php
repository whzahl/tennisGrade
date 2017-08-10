<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>全国网球等级考试平台后台管理系统</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/Public/Admin/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/Public/Admin/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="/Public/Admin/css/amazeui.min.css" />
    <link rel="stylesheet" href="/Public/Admin/css/admin.css">
    <link rel="stylesheet" href="/Public/Admin/css/app.css">
    <script src="/Public/Admin/js/echarts.min.js"></script>
    
</head>

<body data-type="generalComponents">

    <header class="am-topbar am-topbar-inverse admin-header">
        <div class="am-topbar-brand">
            <a href="javascript:;" class="tpl-logo">
                <img src="/Public/Admin/images/logo.png" alt="">
            </a>
        </div>
        <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right">

        </div>

        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

        <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

            <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="am-icon-bell-o"></span> 提醒 <span class="am-badge tpl-badge-success am-round">5</span></span>
                    </a>
                    <ul class="am-dropdown-content tpl-dropdown-content">
                        <li class="tpl-dropdown-content-external">
                            <h3>你有 <span class="tpl-color-success">5</span> 条提醒</h3><a href="###">全部</a></li>
                        <li class="tpl-dropdown-list-bdbc"><a href="#" class="tpl-dropdown-list-fl"><span class="am-icon-btn am-icon-plus tpl-dropdown-ico-btn-size tpl-badge-success"></span> 【预览模块】移动端 查看时 手机、电脑框隐藏。</a>
                            <span class="tpl-dropdown-list-fr">3小时前</span>
                        </li>
                        <li class="tpl-dropdown-list-bdbc"><a href="#" class="tpl-dropdown-list-fl"><span class="am-icon-btn am-icon-check tpl-dropdown-ico-btn-size tpl-badge-danger"></span> 移动端，导航条下边距处理</a>
                            <span class="tpl-dropdown-list-fr">15分钟前</span>
                        </li>
                        <li class="tpl-dropdown-list-bdbc"><a href="#" class="tpl-dropdown-list-fl"><span class="am-icon-btn am-icon-bell-o tpl-dropdown-ico-btn-size tpl-badge-warning"></span> 追加统计代码</a>
                            <span class="tpl-dropdown-list-fr">2天前</span>
                        </li>
                    </ul>
                </li>
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="am-icon-comment-o"></span> 消息 <span class="am-badge tpl-badge-danger am-round">9</span></span>
                    </a>
                    <ul class="am-dropdown-content tpl-dropdown-content">
                        <li class="tpl-dropdown-content-external">
                            <h3>你有 <span class="tpl-color-danger">9</span> 条新消息</h3><a href="###">全部</a></li>
                        <li>
                            <a href="#" class="tpl-dropdown-content-message">
                                <span class="tpl-dropdown-content-photo">
                      <img src="/Public/Admin/images/user02.png" alt=""> </span>
                                <span class="tpl-dropdown-content-subject">
                      <span class="tpl-dropdown-content-from"> 禁言小张 </span>
                                <span class="tpl-dropdown-content-time">10分钟前 </span>
                                </span>
                                <span class="tpl-dropdown-content-font"> Amaze UI 的诞生，依托于 GitHub 及其他技术社区上一些优秀的资源；Amaze UI 的成长，则离不开用户的支持。 </span>
                            </a>
                            <a href="#" class="tpl-dropdown-content-message">
                                <span class="tpl-dropdown-content-photo">
                      <img src="/Public/Admin/images/user03.png" alt=""> </span>
                                <span class="tpl-dropdown-content-subject">
                      <span class="tpl-dropdown-content-from"> Steam </span>
                                <span class="tpl-dropdown-content-time">18分钟前</span>
                                </span>
                                <span class="tpl-dropdown-content-font"> 为了能最准确的传达所描述的问题， 建议你在反馈时附上演示，方便我们理解。 </span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="am-icon-calendar"></span> 进度 <span class="am-badge tpl-badge-primary am-round">4</span></span>
                    </a>
                    <ul class="am-dropdown-content tpl-dropdown-content">
                        <li class="tpl-dropdown-content-external">
                            <h3>你有 <span class="tpl-color-primary">4</span> 个任务进度</h3><a href="###">全部</a></li>
                        <li>
                            <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc">Amaze UI 用户中心 v1.2 </span>
                                <span class="percent">45%</span>
                                </span>
                                <span class="progress">
                        <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-success" style="width:45%"></div></div>
                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc">新闻内容页 </span>
                                <span class="percent">30%</span>
                                </span>
                                <span class="progress">
                       <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-secondary" style="width:30%"></div></div>
                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc">管理中心 </span>
                                <span class="percent">60%</span>
                                </span>
                                <span class="progress">
                        <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-warning" style="width:60%"></div></div>
                    </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen" class="tpl-header-list-link"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>

                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="tpl-header-list-user-nick">禁言小张</span><span class="tpl-header-list-user-ico">
                        <img src="/Public/Admin/images/user01.png"></span>
                    </a>
                    <ul class="am-dropdown-content">
                        <li><a href="#"><span class="am-icon-bell-o"></span> 资料</a></li>
                        <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>
                        <li><a href="#"><span class="am-icon-power-off"></span> 退出</a></li>
                    </ul>
                </li>
                <li><a href="###" class="tpl-header-list-link"><span class="am-icon-sign-out tpl-header-list-ico-out-size"></span></a></li>
            </ul>
        </div>
    </header>

    <div class="tpl-page-container tpl-page-header-fixed">
        <div class="tpl-left-nav tpl-left-nav-hover">
           <div class="tpl-left-nav-title">
                Amaze UI 列表
           </div>
           <div class="tpl-left-nav-list">
		   <ul class="tpl-left-nav-menu">
		      <li class="tpl-left-nav-item">
		           <a href="/Admin/Index/index" class="nav-link active">
		               <i class="am-icon-home"></i>
		               <span>首页</span>
		           </a>
		      </li>
<!-- 		      <li class="tpl-left-nav-item">
		           <a href="chart.html" class="nav-link tpl-left-nav-link-list">
		               <i class="am-icon-bar-chart"></i>
		               <span>数据表</span>
		               <i class="tpl-left-nav-content tpl-badge-danger">12</i>
		           </a>
		     </li> -->
		     <li class="tpl-left-nav-item">
		           <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
		               <i class="am-icon-wpforms"></i>
		               <span>介绍板块</span>
		               <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
		          </a>
		          <ul class="tpl-left-nav-sub-menu">
		               <li>
		                   <a href="/Admin/Intro/intro">
		                       <i class="am-icon-angle-right"></i>
		                       <span>委员会简介</span>
		                       <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
		                   </a>
		                   <a href="/Admin/Intro/intros">
		                       <i class="am-icon-angle-right"></i>
		                       <span>考试介绍</span>
		                       <i class="tpl-left-nav-content tpl-badge-success">18</i>
		                   </a>
		                   <a href="/Admin/Intro/intross">
	                           <i class="am-icon-angle-right"></i>
	                           <span>考试协议</span>
	                           <i class="tpl-left-nav-content tpl-badge-primary">5</i>
		                   </a>
		              </li>
		          </ul>
		    </li> <li class="tpl-left-nav-item">
		           <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
		               <i class="am-icon-bars"></i>
		               <span>申请板块</span>
		               <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
		          </a>
		          <ul class="tpl-left-nav-sub-menu">
		               <li>
		                   <a href="/Admin/Place/index">
		                       <i class="am-icon-angle-right"></i>
		                       <span>考点列表</span>
		                       <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
		                   </a>
		                   <a href="/Admin/Teacher/index">
		                       <i class="am-icon-angle-right"></i>
		                       <span>考官列表</span>
		                       <i class="tpl-left-nav-content tpl-badge-success">18</i>
		                   </a>
		                   <a href="/Admin/Student/index">
	                           <i class="am-icon-angle-right"></i>
	                           <span>考生列表</span>
	                           <i class="tpl-left-nav-content tpl-badge-primary">5</i>
		                   </a>
		              </li>
		          </ul>
		    </li>
		    <li class="tpl-left-nav-item">
		           <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
		               <i class="am-icon-table"></i>
		               <span>内容板块</span>
		               <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
		          </a>
		          <ul class="tpl-left-nav-sub-menu">
		               <li>
		                   <a href="/Admin/News/index">
		                       <i class="am-icon-angle-right"></i>
		                       <span>新闻资讯列表</span>
		                       <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
		                   </a>
		                   <a href="/Admin/Notice/index">
		                       <i class="am-icon-angle-right"></i>
		                       <span>考试公告列表</span>
		                       <i class="tpl-left-nav-content tpl-badge-success">18</i>
		                   </a>
		                   <a href="/Admin/Grade/index">
	                           <i class="am-icon-angle-right"></i>
	                           <span>证书录入列表</span>
	                           <i class="tpl-left-nav-content tpl-badge-primary">5</i>
		                   </a>
			               <a href="/Admin/Live/index">
			                   <i class="am-icon-angle-right"></i>
			                   <span>考试直播列表</span>
			                   <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
			               </a>
		              </li>
		          </ul>
		    </li>
		    <li class="tpl-left-nav-item">
		           <a href="/Admin/Order/index" class="nav-link tpl-left-nav-link-list">
		               <i class="am-icon-fa-jpy"></i>
		               <span>订单信息记录表</span>
		               <i class="tpl-left-nav-content tpl-badge-danger">12</i>
		           </a>
		    </li>
		    <li class="tpl-left-nav-item">
		           <a href="/Admin/User/index" class="nav-link tpl-left-nav-link-list">
		               <i class="am-icon-weixin"></i>
		               <span>微信信息记录表</span>
		               <i class="tpl-left-nav-content tpl-badge-danger">12</i>
		           </a>
		    </li>
		    <li class="tpl-left-nav-item">
		           <a href="/Admin/Master/index" class="nav-link tpl-left-nav-link-list">
		               <i class="am-icon-user-plus"></i>
		               <span>站长信息记录表</span>
		               <i class="tpl-left-nav-content tpl-badge-danger">12</i>
		           </a>
		    </li>
		    <li class="tpl-left-nav-item">
		           <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
		               <i class="am-icon-group"></i>
		               <span>管理员板块</span>
		               <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
		          </a>
		          <ul class="tpl-left-nav-sub-menu">
		               <li>
		                   <a href="/Admin/Admin/index">
		                       <i class="am-icon-angle-right"></i>
		                       <span>超级管理员列表</span>
		                       <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
		                   </a>
		                   <a href="/Admin/Admin/indexs">
		                       <i class="am-icon-angle-right"></i>
		                       <span>站长管理员列表</span>
		                       <i class="tpl-left-nav-content tpl-badge-success">18</i>
		                   </a>
		                   <a href="/Admin/Admin/indexss">
	                           <i class="am-icon-angle-right"></i>
	                           <span>考点管理员列表</span>
	                           <i class="tpl-left-nav-content tpl-badge-primary">5</i>
		                   </a>
		              </li>
		          </ul>
		    </li>
<!-- 		    <li class="tpl-left-nav-item">
		        <a href="login.html" class="nav-link tpl-left-nav-link-list">
		            <i class="am-icon-key"></i>
		            <span>登录</span>
		        </a>
		    </li> -->
		</ul>
        </div>
    </div>
</div>





<script type="text/javascript">  

var InterValObj; //timer变量，控制时间  
var count = 90; //间隔函数，1秒执行  
var curCount;//当前剩余秒数  
  
function sendMessage() {  
	// 判断数据是否为空
     var mobile = $("input[name='phone']").val();

     if(mobile == ""){
    	 alert("手机号码不能为空！");
    	 return false;
     }
	
  　curCount = count;  
　　//设置button效果，开始计时  
     $("#btnSendCode").attr("disabled", "true");  
     $("#btnSendCode").val(curCount + " S");  
     InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次  
　　  //向后台发送处理数据  
     
     $.ajax({  
	     　　type: "POST", //用POST方式传输  
	     　　dataType: "json", //数据格式:JSON  
	     　　url: '/Admin/Live/sendSMS', //目标地址  
	    　　 data: {mobile:mobile},  
	    　　 error: function (XMLHttpRequest, textStatus, errorThrown) { },  
	     　　success: function (msg){ 
	    	 	 console.log(msg);
	    	 	/*  console.log(msg.smsCode); */
		    	 /* if(msg.code == 0){ */
		    		 $("input[name='check']").val(msg.smsCode);
		    	 /* } */
	     　　}  
     });  
}  

	//timer处理函数  
	function SetRemainTime() {  
        if (curCount == 0) {                  
            window.clearInterval(InterValObj);//停止计时器  
            $("#btnSendCode").removeAttr("disabled");//启用按钮  
            $("#btnSendCode").val("获取验证码");  
        }  
        else {  
            curCount--;  
            $("#btnSendCode").val(curCount + " S");  
        }  
    }  
	
	$(document).ready(function(){
	   $("#J-Submit").on('click',function(){
		  /*   var check = $("input[name='check']").val(); */
			var smsCode = $("input[name='smsCode']").val();
			if($("input[name='phone']").val() == ""){
				alert("请输入手机号");return false;
			}else if(smsCode == ""){
				 alert("请输入验证码");
			}else{
				 $("#validStudents").submit();
			}
	    })
	})
</script> 
<form style="margin:8px" action="/Admin/Live/message" method="post" id="validStudents">
 <div class="weui_cell" style="padding:8px;">
    <div class="weui_cell_hd">
      <lab el class="weui_label" style="width:65px;">手机号：</label>
    </div>
    <div class="weui_cell_bd weui_cell_primary">
      <input class="weui_input" type="tel" id="tell" name="phone" placeholder="请输入手机号">
    </div>
  </div>
 <div class="weui_cell" style="padding:8px;">
    <div class="weui_cell_hd">
      <label class="weui_label" style="width:65px;">验证码：</label>
    </div>
    <div class="weui_cell_bd weui_cell_primary">
      <input class="weui_input" type="tel" id="certifycode" name="smsCode" placeholder="请输入验证码">
    </div>
    <div class="weui_cell_ft"> 
    <input name="check" value="" type="hidden">
    
    <input id="btnSendCode" style="width:117px;" type="button" class="weui_btn weui_btn weui_btn_mini weui_btn_primary" value="获取验证码"  onclick="sendMessage()"/>  </div>
  </div>
<input name="check" value="" type="hidden">
<div class="weui_btn_area" style="margin-top:80px"> <a class="weui_btn weui_btn_primary"  id="J-Submit">提交</a> </div>
</form>


</div>

    <script src="/Public/Admin/js/jquery-2.1.1.js"></script>
    <script src="/Public/Admin/js/amazeui.min.js"></script>
    <script src="/Public/Admin/js/iscroll.js"></script>
    <script src="/Public/Admin/js/app.js"></script>

</body>
</html>
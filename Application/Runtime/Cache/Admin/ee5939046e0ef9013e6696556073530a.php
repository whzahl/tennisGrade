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
<script type="text/javascript"> 
	function del(){ 
		if(confirm("确认要删除？")){ 
			return true;
		} else{
			return false;
		}
	} 
</script> 
<script type="text/javascript"> 
	function rec(){ 
		if(confirm("确认要发布？")){ 
			return true;
		} else{
			return false;
		}
	} 
</script> 
    
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
                                                   管理 列表
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
		           <a href="/Admin/User/index" class="nav-link tpl-left-nav-link-list">
		               <i class="am-icon-balance-scale"></i>
		               <span>订单信息记录表</span>
		               <i class="tpl-left-nav-content tpl-badge-danger">12</i>
		           </a>
		    </li>
		    <li class="tpl-left-nav-item">
		           <a href="/Admin/User/index" class="nav-link tpl-left-nav-link-list">
		               <i class="am-icon-weixin"></i>&nbsp;
		               <span> 微信信息记录表</span>
		               <i class="tpl-left-nav-content tpl-badge-danger">12</i>
		           </a>
		    </li>
		    <li class="tpl-left-nav-item">
		           <a href="/Admin/Master/index" class="nav-link tpl-left-nav-link-list">
		               <i class="am-icon-user-plus"></i>&nbsp;
		               <span> 站长记录表</span>
		               <i class="tpl-left-nav-content tpl-badge-danger">12</i>
		           </a>
		    </li>
		    <li class="tpl-left-nav-item">
		           <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
		               <i class="am-icon-group"></i>&nbsp;
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







        <div class="tpl-content-wrapper" style="margin:0 20px">
            <div class="tpl-content-page-title">
                                                      考生信息修改列表
            </div>
            <ol class="am-breadcrumb">
                <li><a href="/Admin/Index/index" class="am-icon-home">首页</a></li>
                <li class="am-active">申请板块</li>
                <li class="am-active">考生信息修改页</li>
            </ol>
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-font-awesome"></span> 考生信息修改
                    </div>
<!--                     <div class="tpl-portlet-input tpl-fz-ml">
                        <div class="portlet-input input-small input-inline">
                            <div class="input-icon right">
                                <i class="am-icon-search"></i>
                                <input type="text" class="form-control form-control-solid" placeholder="搜索..."> </div>
                        </div>
                    </div> -->
                 </div>
                <div class="tpl-block">
                    <div class="am-g">
                        <div class="tpl-form-body tpl-form-line">
                            <form class="am-form tpl-form-line-form"  action="/Admin/Student/edit" method="post">
                                <input name="sid" type="hidden"  value="<?php echo ($list["sid"]); ?>" >
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">姓名 <span class="tpl-form-line-small-title">Sname</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input"  name="sname"  value="<?php echo ($list["sname"]); ?>" placeholder="请输入考生名字">
                                        <!-- <small>请填写标题文字10-20字左右。</small> -->
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">性别<span class="tpl-form-line-small-title">Sex</span></label>
                                    <div class="am-u-sm-9">
                                        <input name="sex" type="radio" value="男" checked="checked" /><span style="color:#888;font-size:16px;margin-right:100px;">男</span>
                                        <input name="sex" type="radio" value="女"  /><span style="color:#888;font-size:16px;">女</span>
                                        <!-- <small>发布时间为必填</small> -->
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-email" class="am-u-sm-3 am-form-label">出生年月日<span class="tpl-form-line-small-title">Birthday</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="am-form-field tpl-form-no-bg"  name="birthday"  value="<?php echo ($list["birthday"]); ?>" placeholder="请选择年月日" data-am-datepicker="" readonly/>
                                        <!-- <small>发布时间为必填</small> -->
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">证件类型 <span class="tpl-form-line-small-title">Cretype</span></label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="{searchBox: 1}">
										  <option value="a">-The.CC</option>
										  <option value="b">夕风色</option>
										  <option value="o">Orange</option>
										</select>
										<input type="text" name="creid"  value="<?php echo ($list["creid"]); ?>"  placeholder="请输入证件号">
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-weibo" class="am-u-sm-3 am-form-label">个人照片 <span class="tpl-form-line-small-title">Picture</span></label>
                                    <div class="am-u-sm-9">
                                        <div class="am-form-group am-form-file">
                                            <div class="tpl-form-file-img">
                                                <?php if(empty($list['picture'])): ?><img src="/Public/Admin/images/2.jpg" class="ml50 mt20">
			                                	<?php else: ?>
												<img src="<?php echo ($list["picture"]); ?>" class="ml50 mt20" style="width:103px;height:107px;">
												<input type="hidden" name="picture" value="<?php echo ($list["picture"]); ?>"><?php endif; ?>
                                            </div>
                                            <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                            <i class="am-icon-cloud-upload"></i> 添加个人图片</button>
                                            <input id="doc-form-file" type="file" name="picture" multiple>
                                        </div>

                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">手机号码<span class="tpl-form-line-small-title">Phone</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="phone"  value="<?php echo ($list["phone"]); ?>" placeholder="请输入手机号码">
                                    </div>
                                </div>
                                
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">邮箱<span class="tpl-form-line-small-title">Email</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="email"  value="<?php echo ($list["email"]); ?>" placeholder="请输入邮箱">
                                    </div>
                                </div>
                                
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">所在学校<span class="tpl-form-line-small-title">School</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="school"  value="<?php echo ($list["school"]); ?>" placeholder="请输入学校">
                                    </div>
                                </div>
                                
<!--                                 <div class="am-form-group">
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">隐藏文章</label>
                                    <div class="am-u-sm-9">
                                        <div class="tpl-switch">
                                            <input type="checkbox" class="ios-switch bigswitch tpl-switch-btn" checked />
                                            <div class="tpl-switch-btn-view">
                                                <div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                
                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">等级<span class="tpl-form-line-small-title">Level</span></label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="{searchBox: 1}">
										  <option value="a">-The.CC</option>
										  <option value="b">夕风色</option>
										  <option value="o">Orange</option>
										</select>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">陪考<span class="tpl-form-line-small-title">Tname</span></label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="{searchBox: 1}">
										  <option value="a">-The.CC</option>
										  <option value="b">夕风色</option>
										  <option value="o">Orange</option>
										</select>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success ">修改</button>
                                        <a href=""  class="am-btn am-btn-primary tpl-btn-bg-color-success " onclick ="javascript:history.go(-1);" style="margin-left:20px;">返回</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>




</div>

    <script src="/Public/Admin/js/jquery-2.1.1.js"></script>
    <script src="/Public/Admin/js/amazeui.min.js"></script>
    <script src="/Public/Admin/js/iscroll.js"></script>
    <script src="/Public/Admin/js/app.js"></script>
    
</body>
</html>
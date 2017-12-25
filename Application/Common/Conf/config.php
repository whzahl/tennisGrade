<?php
return array(
	
	// 数据库配置信息
	'DB_TYPE'      =>  'mysql',     // 数据库类型
	'DB_HOST'      =>  '127.0.0.1',     // 服务器地址
	'DB_NAME'      =>  'tennisgrade',     // 数据库名
	'DB_USER'      =>  'root',     // 用户名
	'DB_PWD'       =>  '1234567',     // 输入安装MySQL时设置的密码
	'DB_PORT'      =>  '3306',     // 端口
	'DB_PREFIX'    =>  '',     // 数据库表前缀
	'DB_CHARSET'   =>  'utf8', 		// 数据库编码默认采用utf8
	
	// 绑定URL模板相关配置
	'TMPL_PARSE_STRING'  => array(
		'__STATIC__' => __ROOT__ . '/Public/static/',
	),

    'DEFAULT_CHARSET'       =>  'utf-8', // 默认输出编码
	'DEFAULT_MODULE' => 'Home',    //默认模块
	'MODULE_ALLOW_LIST'    =>    array('Home','Admin'),
// 	'URL_PARAMS_BIND'       =>  true, // URL变量绑定到操作方法作为参数
// 	'URL_MODEL' => 2,  // URL重写  去掉中间的index.php
		
);
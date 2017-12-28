<?php
//QWERTyuiop
define('QINIU_ACCESS_KEY', 'lDXeAAdaPJ2eSqI6c6qm_QR2LMMzx8lMtOdEg47z');
define('QINIU_SECRET_KEY' , 'CPlluEcx-sVBTfzoOekWlU2fI158lypf1yow6QZ8');
define('QINIU_BUCKET' , 'mocuzapp1');
define('QINIU_RES_URL','https://file1.iappsgame.com/');

Yii::setPathOfAlias('extensions', dirname(dirname(__FILE__)) . '/extensions');

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'timeZone' => 'Asia/Shanghai',
	'basePath'=>dirname(dirname(__FILE__)),
	'name'=>'H5 游戏',

	// preloading 'log' component
	'preload'=>array('log'),
    'defaultController'=>'index',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	    'application.extensions.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

        'backend',
        'admin',
        'api'

	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
// 		    'loginUrl'=>array('admin/login'),
		),

		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
	    	        'urlFormat'=>'path',
                // 'enablePrettyUrl' => true,
	    	        'showScriptName' => false, //去除index.php
                'appendParams'=>true,
	    	        // 'urlSuffix'=>'/', //加上.html
                // 'appendParams'=true,
	    	        'rules'=>array(
                  // RewriteRule ^notify.php$ index.php?r=user/notify
                  // RewriteRule ^payback.php$ index.php?r=user/jinbi
                  '^notify'  =>  'user/notify',
                  '^alnotify' =>  'pay/alnotify',
                  '^wxnotify' =>  'pay/wxnotify',
                  '^payback'  =>  'user/jinbi',

                  // RewriteRule ^(\d+)/news/ index.php?r=index/gamezixun&gid=$1&type=1
                  // RewriteRule ^(\d+)/gl/ index.php?r=index/gamezixun&gid=$1&type=2
                  // RewriteRule ^games/(\d+)/news/ index.php?r=index/gamezixun&gid=$1&type=1
                  // RewriteRule ^games/(\d+)/gl/ index.php?r=index/gamezixun&gid=$1&type=2
                  '^(<gid:\d+>)/news'=>'index/gamezixun/type/1',
                  '^(<gid:\d+>)/gl'=>'index/gamezixun/type/2',
                  '^games/(<gid:\d+>)/news'=>'index/gamezixun/type/1',
                  '^games/(<gid:\d+>)/gl'=>'index/gamezixun/type/2',

                  // RewriteRule ^wangyou index.php?r=index/list
                  // RewriteRule ^games/\d+/(\d+) index.php?r=index/newsdetail&id=$1
                  // RewriteRule ^games/\d+/(\d+).html index.php?r=index/newsdetail&id=$1
                  // RewriteRule ^games/(\d+) index.php?r=index/gamedetail&id=$1
                  // RewriteRule ^games/type/(\d+) index.php?r=index/games&type=$1
                  // RewriteRule ^games/hot index.php?r=index/games&type=2
                  '^wangyou' => 'index/list',
                  '^games/<id:\d+>/(\d+)' => 'index/newsdetail',
                  '^games/\d+/(<id:\d+>).html' => 'index/newsdetail',
                  '^games/(<id:\d+>)' => 'index/gamedetail',
                  '^games/<type:\d+>' =>'index/games',
                  '^games/hot' =>'index/games/type/2',



                  // RewriteRule ^games/flwangyou index.php?r=index/gamesfl&type=1
                  // RewriteRule ^games/fldanji index.php?r=index/gamesfl&type=2
                  // RewriteRule ^games/fl index.php?r=index/gamesfl
                  '^games/flwangyou' => 'index/gamesfl/type/1',
                  '^games/fldanji' => 'index/gamesfl/type/2',
                  '^games/fl' => 'index/gamesfl',

                  // RewriteRule ^news/(\d+) index.php?r=index/zixun&page=$1
                  // RewriteRule ^news index.php?r=index/zixun
                  // RewriteRule ^gl/(\d+) index.php?r=index/zixun&type=2&page=$1
                  // RewriteRule ^gl index.php?r=index/zixun&type=2&%{QUERY_STRING}
                  '^news/<page:\d+>' => 'index/zixun',
                  '^news' => 'index/zixun',
                  '^gl/<page:\d+>' => 'index/zixun/type/2',
                  '^gl' => "index/zixun/type/2",     //需要处理...


                  // RewriteRule ^libaoget.html index.php?r=index/libaoget
                  // RewriteRule ^libao/(\d*).html index.php?r=index/libaodetail&id=$1
                  // RewriteRule ^libao index.php?r=index/libao&%{QUERY_STRING}
                  // RewriteRule ^games index.php?r=index/gamesfl&type=1
                  // RewriteRule ^shangcheng index.php?r=index/shop

                  '^libaoget.html' => 'index/libaoget',
                  '^libao/(<id:\d*>).html' => 'index/libaodetail',
                  '^libao' => "index/libao",       //需要处理...
                  '^games' => 'index/gamesfl/type/1',
                  '^shangcheng'=> 'index/shop',

                  // RewriteRule ^fl/(\w+)/ index.php?r=index/type&t=$1
                  // RewriteRule ^dfl/(\w+)/ index.php?r=index/type&t=$1&danji=1
                  //
                  // RewriteRule ^payegret index.php?r=user/pay2&%{QUERY_STRING}
                  //
                  // RewriteRule ^gotoegret.php index.php?r=user/gotoegret&%{QUERY_STRING}
                  //
                  // RewriteRule ^search index.php?r=index/search&%{QUERY_STRING}
                  //
                  // RewriteRule ^payv3 index.php?r=user/pay3&%{QUERY_STRING}
                  //
                  //
                  // RewriteRule ^danji index.php?r=index/danji
                  //
                  // RewriteRule ^collection index.php?r=user/collection
                  // RewriteRule ^user/collectionlist index.php?r=user/collectionlist

                  '^fl/(<t:\w+>)' => 'index/type',
                  '^dfl/(<t:\w+>)' => 'index/type/danji/1',
                  '^payegret' => "user/pay2",   //需要处理...
                  '^gotoegret' => "user/gotoegret",
                  '^search' => "index/search",
                  '^payv3' => "user/pay3",
                  '^pay' => "pay/topay",
                  '^danji' => 'index/danji',
                  '^collection' => 'user/collection',

                  'cp' =>'backend/site/login',
                  'admin'=>'admin/houtai/login',

                  '^user/collectionlist' => 'user/collectionlist',

                  '<controller:\w+>/<id:\d+>'=>'<controller>/view',
//                  '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//                  '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                  // '<controller:(post|comment)>/<id:\d+>/<action:(create|update|delete)>'=> '<controller>/<action>',
                //   "jitapu/<artist:\w+>/<id:\d+>"                                   => "jitapu/view",
                // "<controller:\w+>/<action:\w+>/<id:\d+>"                         => "<controller>/<action>",
                // "<controller:\w+>/<action:\w+>"                                  => "<controller>/<action>",
	    	        ),
	    	    ),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
        'hostUrl'=>'http://192.168.20.16:8383',
        'rootPath'=>dirname(dirname(dirname(__FILE__))),

        // this is used in contact page
		'adminEmail'=>'gaoxuan_zheng@163.com',
	    'bititle' => '金币',
	    'qq'=>'3246660',
	    'wangyoufenlei' => array(
	        "jsby"=>array(
	            'name'=>'角色扮演',
	            'img'=>'/static/fl/juese.png'
	        ),
	        "cltf"=>array(
	            'name'=>'策略塔防',
	            'img'=>'/static/fl/celue.png'
	        ),
	        "tyjj"=>array(
	            'name'=>'体育竞技',
	            'img'=>'/static/fl/tiyu.png'
	        ),
	        "zzcl"=>array(
	            'name'=>'战争策略',
	            'img'=>'/static/fl/xiaochu.png'
	        ),
	        "dcmx"=>array(
	            'name'=>'动作冒险',
	            'img'=>'/static/fl/dongzuo.png'
	        ),
	        "mljy"=>array(
	            'name'=>'模拟经营',
	            'img'=>'/static/fl/jinyin.png'
	        ),
	        "jjfz"=>array(
	            'name'=>'挂机放置',
	            'img'=>'/static/fl/fangzhi.png'
	        ),
	        "fxsj"=>array(
	            'name'=>'飞行射击',
	            'img'=>'/static/fl/sehji.png'
	        ),
	        "yzxx"=>array(
	            'name'=>'益智休闲',
	            'img'=>'/static/fl/xiuxian.png'
	        ),
	        "qpzy"=>array(
	            'name'=>'棋牌桌游',
	            'img'=>'/static/fl/qipai.png'
	        ),
	        "syxz"=>array(
	            'name'=>'手游下载',
	            'img'=>'/static/fl/weiwangyou.png'
	        ),
	        "qt"=>array(
	            'name'=>'其他',
	            'img'=>'/static/fl/yizhi.png'
	        ),
	    ),
	    'danjifenlei'=>array(
	        "xiuxian"=>array(
                'name'=>'休闲类',
                'img'=>'/static/fl/xiuxian.png'
            ),
            "naoli"=>array(
                'name'=>'脑力类',
                'img'=>'/static/fl/naoli.png'
            ),
            "mingjie"=>array(
                'name'=>'敏捷类',
                'img'=>'/static/fl/mingjie.png'
            ),
            "yizhi"=>array(
                'name'=>'益智类',
                'img'=>'/static/fl/yizhi.png'
            ),
            "chuangguan"=>array(
                'name'=>'闯关类',
                'img'=>'/static/fl/chuanguan.png'
            ),
            "xiaochu"=>array(
                'name'=>'消除类',
                'img'=>'/static/fl/xiaochu.png'
            ),
            "zhuangban"=>array(
                'name'=>'装扮类',
                'img'=>'/static/fl/zhubanlie.png'
            ),
            "dongzuo"=>array(
                'name'=>'动作类',
                'img'=>'/static/fl/dongzuo.png'
            ),
            "celue"=>array(
                'name'=>'策略类',
                'img'=>'/static/fl/celue.png'
            ),
            "saiche"=>array(
                'name'=>'赛车类',
                'img'=>'/static/fl/saiche.png'
            ),
            "sheji"=>array(
                'name'=>'射击类',
                'img'=>'/static/fl/sehji.png'
            ),
            "tiyu"=>array(
                'name'=>'体育类',
                'img'=>'/static/fl/tiyu.png'
            ),
            "jingying"=>array(
                'name'=>'经营类',
                'img'=>'/static/fl/jinyin.png'
            ),
            "juese"=>array(
                'name'=>'角色类',
                'img'=>'/static/fl/juese.png'
            ),
            "miaoxian"=>array(
                'name'=>'冒险类',
                'img'=>'/static/fl/maoxian.png'
            ),
            "qipai"=>array(
                'name'=>'棋牌类',
                'img'=>'/static/fl/qipai.png'
            ),
            "fangzhi"=>array(
                'name'=>'放置类',
                'img'=>'/static/fl/fangzhi.png'
            ),
            "qita"=>array(
                'name'=>'其他',
                'img'=>'/static/fl/xiaochu.png'
            ),
	    )
	),
);

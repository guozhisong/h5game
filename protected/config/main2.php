<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'timeZone' => 'Asia/Shanghai',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
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
 	    	        'showScriptName' => false, //去除index.php
                    'appendParams' => true,
// 	    	        'urlSuffix'=>'/', //加上.html
                    'rules'=>array(
                        'notify' => 'user/notify',
                        'payback.php' => 'user/jinbi',

                        '<gid:\d+>/news/' => 'index/gamezixun/type/1',
                        '<gid:\d+>/gl/' => 'index/gamezixun/type/2',
                        'games/<gid:\d+>/news/' => 'index/gamezixun/type/1',
                        'games/<gid:\d+>/gl/' => 'index/gamezixun/type/2',

                        'wangyou' => 'index/list',
                        'games/\d+/<id:\d+>/' => 'index/newsdetail',
                        'games/\d+/<id:\d+>.html' => 'index/newsdetail',
                        'games/<id:\d+>' => 'index/gamedetail',
                        'games/type/<type:\d+>' => 'index/games',
                        'games/hot' => 'index/games/type/2',

                        'games/flwangyou' => 'index/gamesfl/type/1',
                        'games/fldanji' => 'index/gamesfl/type/2',
                        'games/fl' => 'index/gamesfl',

                        'news/<page:\d+>' => 'index/zixun',
                        'news' => 'index/zixun',
                        'gl/<page:\d+>' => 'index/zixun/type/2',
                        'gl' => 'index/zixun/type/2/%{QUERY_STRING}',

                        'libaoget.html' => 'index/libaoget',
                        'libao/<id:\d*>.html' => 'index/libaodetail',
                        'libao' => 'index/libao/%{QUERY_STRING}',
                        'games' => 'index/gamesfl/type/1',
                        'shangcheng' => 'index/shop',

                        'fl/<t:\w+>/' => 'index/type',
                        'dfl/<t:\w+>/' => 'index/type/danji/1',
                        'payegret' => 'user/pay2/%{QUERY_STRING}',
                        'gotoegret.php' => 'user/gotoegret/%{QUERY_STRING}',
                        'search' => 'index/search/%{QUERY_STRING}',
                        'payv3' => 'user/pay3/%{QUERY_STRING}',

                        'danji' => 'index/danji',
                        'collection' => 'user/collection',
                        'user/collectionlist' => 'user/collectionlist',

                        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
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
				array(
					'class'=>'CWebLogRoute',                                                                            'levels'=>'trace, info, error, warning, xdebug',
                    'categories' =>'system.db.*'
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
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

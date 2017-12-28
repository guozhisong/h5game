<?php

class UserController extends Controller
{
    public $layout='//layouts/page';

    public $logincss=true;

	public function actionIndex()
	{
	    $this->checkLogin();
	    $user = Users::model()->findByPk(Yii::app()->session['user_id']);
	    $this->render('index', array(
	        'user'=>$user
	    ));
	}

	public function actionLogin(){
	    if(Yii::app()->session['user_login']){
	        $this->redirect('/');
	    }
	    $error = '';
	    if (Yii::app()->request->isPostRequest){
	        $default=array(
	            'user_login'=>'',
	            'user_pass'=>''
	        );
	        $postValues = array_merge($default, $_POST);
	        $user_login = $postValues['user_login'];
	        $user_pass = $postValues['user_pass'];
	        if($user_login == '' || $user_pass == ''){
	            $error = '信息不全';
	        }else{
	            $exists = Users::model()->find('user_login=:user_login', array(':user_login'=>$user_login));
                if($exists){
	                if(md5($user_pass) == $exists->user_pass){
                    doLog(Yii::app()->session['backto'],'cc');
	                    Yii::app()->session['user_login']=$user_login;
	                    Yii::app()->session['user_id']=$exists->id;

	                    //存储当前登录的网站的主域名
//                      if(YII_DEBUG){
//                        $mem = new Memcached();             //线上：new Memcache   本地:new Memcached()
//                        $mem->addServer('127.0.0.1', 11211);  //线上:$mem->connect  本地:$mem->addServer
//                          $mem->set('login_host_'.$exists->id, $_SERVER['HTTP_HOST'], 0);
//                      }else{
//                        $mem = new Memcache();             //线上：new Memcache   本地:new Memcached()
//                        $mem->connect('127.0.0.1', 11211);  //线上:$mem->connect  本地:$mem->addServer
//                        $mem->set('login_host_'.$exists->id, $_SERVER['HTTP_HOST'], MEMCACHE_COMPRESSED, 0);
//                        $mem->close();             //线上:不注释  本地:注释
//                      }

	                    if(isset(Yii::app()->session['backto']) && Yii::app()->session['backto']){
	                        $backid = Yii::app()->session['backto'];
                          if(strlen(Yii::app()->session['backto']) == 32) $to = 1;
                          else $to = 0;
	                        unset(Yii::app()->session['backto']);

                          if($to)  $this->redirect($this->createUrl('game/login',array('appid'=>$backid)));
	                        else    $this->redirect($this->createUrl('index/play',array('id'=>$backid)));
	                        exit;
	                    }
	                    $this->redirect(array('user/index'));
	                }else{
	                    $error = '密码不正确';
	                }
	            }else{
	                $error = '用户名不存在';
	            }
	        }
	    }
	    $this->render('login', array(
	        'error'=>$error
	    ));
	}

	public function actionRegister(){
	    if(Yii::app()->session['user_login']){
	        $this->redirect(array('/'));
	    }
	    $error = '';
	    if (Yii::app()->request->isPostRequest){
	        $default=array(
	            'user_sex'=>'',
	            'user_login'=>'',
	            'user_pass'=>''
	        );
	        $postValues = array_merge($default, $_POST);
	        $user_login = $postValues['user_login'];
	        $user_pass = $postValues['user_pass'];
	        if($user_login == '' || $user_pass == ''){
	            $error = '信息不全';
	        }else{
    	        $exists = Users::model()->find('user_login=:user_login', array(':user_login'=>$user_login));
    		    if(!$exists){
    		        $user = new Users();
    		        $user->user_login = $user_login;
    		        $user->user_nicename = '这家伙没写';
    		        $user->user_pass = md5($user_pass);
    		        $user->user_sex = (int) $postValues['user_sex'];
    		        $user->user_lastlogin = date('Y-m-d H:i:s');
    		        $user->user_registered = date('Y-m-d H:i:s');
    		        if($user->save()){
    		            Yii::app()->session['user_login'] = $user_login;
    		            Yii::app()->session['user_id'] = $user->id;

                    //存储当前登录的网站的主域名
//                    if(YII_DEBUG){
//                      $mem = new Memcached();             //线上：new Memcache   本地:new Memcached()
//                      $mem->addServer('127.0.0.1', 11211);  //线上:$mem->connect  本地:$mem->addServer
//                      $mem->set('login_host_'.$user->id, $_SERVER['HTTP_HOST'], 0);
//                    }else{
//                      $mem = new Memcache();             //线上：new Memcache   本地:new Memcached()
//                      $mem->connect('127.0.0.1', 11211);  //线上:$mem->connect  本地:$mem->addServer
//                      $mem->set('login_host_'.$user->id, $_SERVER['HTTP_HOST'], MEMCACHE_COMPRESSED, 0);
//                      $mem->close();                      //线上:不注释  本地:注释
//                    }

    		            if(isset(Yii::app()->session['backto']) && Yii::app()->session['backto']){
    		                $backid = Yii::app()->session['backto'];
    		                unset(Yii::app()->session['backto']);
    		                $this->redirect($this->createUrl('index/play',array('id'=>$backid)));
    		                exit;
    		            }

    		            $this->redirect(array('user/index'));
    		        }
    		    }else{
    		        $error = '用户名已经存在';
    		    }
	        }
	    }
	    $this->render('register', array(
	        'error'=>$error
	    ));
	}

	public function actionXy(){
	    $this->render('xy');
	}

	public function actionLogout(){
	    unset(Yii::app()->session['user_login']);
	    unset(Yii::app()->session['user_id']);
	    $this->redirect(array('index/index'));
	}

	public function actionJinbi(){
	    $this->checkLogin();
	    $user = Users::model()->findByPk(Yii::app()->session['user_id']);
	    $this->render('jinbi', array(
	        'user'=>$user
	    ));
	}
	public function actionJinbidetail(){
	    $this->checkLogin();
	    $user = Users::model()->findByPk(Yii::app()->session['user_id']);
	    $jinbidetails = Jinbilog::model()->findAllByAttributes(array('user_id'=>$user->id));
	    $this->render('jinbidetail', array(
	        'user'=>$user,
	        'jinbidetails' => $jinbidetails
	    ));
	}
	public function actionChongzhi(){
	    $this->checkLogin();
	    $user = Users::model()->findByPk(Yii::app()->session['user_id']);
	    $this->render('chongzhi', array(
	        'user'=>$user
	    ));
	}

	/**
	 * 支付
	 * @param unknown $yuan
	 */
	public function actionPay(){
	    $yuan = (int) $_POST['amount'];
	    if($yuan <=0){
	        $yuan = 1;
	    }
	    $path = Yii::app()->basePath.'/extensions/alipay/';
	    require_once $path . 'alipay.config.php';
	    require_once $path . 'lib/alipay_submit.class.php';
	    $mydomain = 'http://h5.91yxq.com';
	    $payment_type = "1";
	    $notify_url = $mydomain . "/notify";
	    $return_url = $mydomain . "/payback";
	    $out_trade_no = 'NJLL_'.time() . '_CZ';
	    $subject = '充值';
	    $total_fee = $yuan;//支付金额
	    $body =  '充值';
	    $show_url = $mydomain . '/order.html';
	    $anti_phishing_key = "";
	    $exter_invoke_ip = "";
	    $it_b_pay = 60;
	    $extern_token= '';
	    $parameter = array(
	        "service" => "alipay.wap.create.direct.pay.by.user",
	        "partner" => trim($alipay_config['partner']),
	        "seller_id" => trim($alipay_config['seller_id']),
	        "payment_type"	=> $payment_type,
	        "notify_url"	=> $notify_url,
	        "return_url"	=> $return_url,
	        "out_trade_no"	=> $out_trade_no,
	        "subject"	=> $subject,
	        "total_fee"	=> $total_fee,
	        "show_url"	=> $show_url,
	        "body"	=> $body,
	        "it_b_pay"	=> $it_b_pay,
	        "extern_token"	=> $extern_token,
	        "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
	    );

	    $pay = new Pay();
	    $pay->user_id = Yii::app()->session['user_id'];
	    $pay->jinbi = $total_fee * 100;
	    $pay->amount = $total_fee;
	    $pay->out_trade_no = $out_trade_no;
	    $pay->date = date('Y-m-d H:i:s');
	    $pay->status = 1;
	    $pay->save();

	    //建立请求
	    $alipaySubmit = new AlipaySubmit($alipay_config);
	    $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
	    //echo $html_text;
	    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>等等跳转到支付宝</title></head>';
	    echo "不要刷新，耐心等待页面跳转";
	    echo $html_text;
	    exit;
	}
	public function actionNotify(){
	    $path = Yii::app()->basePath.'/extensions/alipay/';
	    require_once $path . 'alipay.config.php';
	    require_once $path . 'lib/alipay_notify.class.php';
	    $alipayNotify = new AlipayNotify($alipay_config);
	    $verify_result = $alipayNotify->verifyNotify();
	    logResult("----------------alipay back----------------");
	    if($verify_result) {
	        logResult("from alipay");
	        $out_trade_no = $_POST['out_trade_no'];
	        $trade_no = $_POST['trade_no'];
	        logResult("out_trade_no: $out_trade_no");
	        logResult("trade_no: $trade_no");
	        $trade_status = $_POST['trade_status'];
	        logResult("trade_no: $trade_no");
	        if($_POST['trade_status'] == 'TRADE_FINISHED') {
	            //注意：
	            //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
	        }
	        else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
    	        $pay = Pay::model()->findByAttributes(array('out_trade_no'=>$out_trade_no,'status'=>1));
    	        if($pay){
                if($_POST['total_fee'] != $pay->amount){
                  $pay->trade_no = $trade_no;
                  $pay->verify_msg = "支付金额{$_POST['total_fee']}与订单金额不符";
                  $pay->save();
                }else{
                  $pay->status = 2;
    	            $pay->trade_no = $trade_no;
    	            $pay->save();
    	            if($pay->backurl){
    	                //游戏直接过来的
    	                logResult("----------------post Pay Result To egrat s----------------");
    	                $returnStr = $this->postPayResultToegrat($pay->id, $pay->user_id, $pay->amount, $pay->extra, $pay->backurl);
    	                logResult($returnStr);
    	                logResult("----------------post Pay Result To egrat e----------------");
    	            }else{
    	                //充金币的
    	                $user = Users::model()->findByPk($pay->user_id);
    	                if($user){
    	                    $user->jinbi = $user->jinbi + $pay->jinbi;
    	                    $user->huiyuan = 1;
    	                    $user->save();
    	                    $jinbilog = new Jinbilog;
    	                    $jinbilog->user_id = $user->id;
    	                    $jinbilog->desc = '充值';
    	                    $jinbilog->jinbi = $pay->jinbi;
    	                    $jinbilog->date = date('Y-m-d H:i:s');
    	                    $jinbilog->save();
    	                }
    	            }
                }

    	        }
	        }
	        echo "success";		//请不要修改或删除
	    } else {
	        //验证失败
	        echo "fail";
	        logResult("fail");
	    }
	}

	public function actionChangepwd(){
	    $this->checkLogin();
	    $message = '';
	    if (Yii::app()->request->isPostRequest){
	        $pwd1 = $_POST['pwd1'];
	        $pwd2 = $_POST['pwd2'];
	        $user = Users::model()->findByPk(Yii::app()->session['user_id']);
	        if($user->user_pass == md5($pwd1)){
	            $user->user_pass = md5($pwd2);
	            $user->save();
	            $message = '更新成功';
	        }else{
	            $message = '原密码不正确';
	        }
	    }
	    $this->render('changepwd', array('message'=>$message));
	}

	function checkLogin(){
	    if(!Yii::app()->session['user_login']){
	        $this->redirect(array('user/login'));exit;
	    }
	}


	function actionUedit(){
	    $this->checkLogin();
	    $user = Users::model()->findByPk(Yii::app()->session['user_id']);
	    if (Yii::app()->request->isPostRequest){
	        $user->user_sex = $_POST['user_sex'];
	        $user->user_nicename= $_POST['user_nicename'];
	        $user->user_phone= $_POST['user_phone'];
	        $user->user_qq= $_POST['user_qq'];
	        $user->user_email= $_POST['user_email'];
	        if($user->save()){
	            $this->redirect(array('user/index'));
	        }
	    }
	    $this->render('uedit', array('user'=>$user));
	}

	function actionPhoto(){
	    $this->checkLogin();
	    $user = Users::model()->findByPk(Yii::app()->session['user_id']);
	    $newfile = $this->getUploadFile('head_img');
	    if($newfile) {
	        $user->photo = $newfile['small'];
	        if($user->save())
	        {
	            echo  json_encode(array('status'=>'success','photo'=>$user->photo));
	            exit;
	        }
	    }
	    echo  json_encode(array('status'=>'error'));
	}

	public function actionPay2(){
// 	    var_dump($_GET);
// 	    userId	是	玩家在渠道上的用户id
// 	    userName	是	玩家在渠道上的用户昵称
// 	    gameId	是	游戏Id TODO
// 	    goodsId	是	游戏商品Id TODO
// 	    goodsName	是	游戏商品名称 TODO
// 	    money	是	支付金额（大陆统一为人民币元 float类型）
// 	    egretOrderId	是	egret的订单Id TODO
// 	    channelExt	否	渠道在用户登录进入游戏时的透传参数原样在此回传给渠道
// 	    ext	是	此参数为透传参数，通知支付结果接口调用的时候原样返回 TODO
// 	    gameUrl	是	游戏地址，渠道完成支付流程后跳转回游戏地址 TODO
// 	    time	是	时间戳
// 	    sign
	    if(isset($_GET['userId']) && isset($_GET['money']) && isset($_GET['gameUrl'])){
	        $path = Yii::app()->basePath.'/extensions/alipay/';
	        $fp = fopen($path."log_from_egret.txt","a");
	        fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n");

	        $getData = json_encode($_GET);

	        fwrite($fp,"GET 参数：".$getData."\n");
	        fclose($fp);
	    }else{
	        echo "支付参数不对";exit;
	    }

	    $ext = isset($_GET['ext']) ?  $_GET['ext'] : '';
	    $yuan = (int) $_GET['money'];
	    if($yuan <=0){
	        $yuan = 1;
	    }
	    $userId = (int)$_GET['userId'];
	    $gameid = (int)$_GET['gameId'];
	    $gameUrl =  isset($_GET['gameUrl']) ?  $_GET['gameUrl'] : '';




	    $path = Yii::app()->basePath.'/extensions/alipay/';
	    require_once $path . 'alipay.config.php';
	    require_once $path . 'lib/alipay_submit.class.php';
	    $mydomain = 'http://h5.91yxq.com';
	    $payment_type = "1";
	    $notify_url = $mydomain . "/notify";
	    $return_url = $mydomain . "/gotoegret";
	    $out_trade_no = 'NJLL_EGRET_'.time() . '_CZ';
	    $subject = $_GET['goodsName'];
	    $total_fee = $yuan;//支付金额
	    $body =  $_GET['goodsName'];
	    $show_url = $mydomain . '/order.html';
	    $anti_phishing_key = "";
	    $exter_invoke_ip = "";
	    $it_b_pay = 60;
	    $extern_token= '';
	    $parameter = array(
	        "service" => "alipay.wap.create.direct.pay.by.user",
	        "partner" => trim($alipay_config['partner']),
	        "seller_id" => trim($alipay_config['seller_id']),
	        "payment_type"	=> $payment_type,
	        "notify_url"	=> $notify_url,
	        "return_url"	=> $return_url,
	        "out_trade_no"	=> $out_trade_no,
	        "subject"	=> $subject,
	        "total_fee"	=> $total_fee,
	        "show_url"	=> $show_url,
	        "body"	=> $body,
	        "it_b_pay"	=> $it_b_pay,
	        "extern_token"	=> $extern_token,
	        "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
	    );



	    $pay = new Pay();
	    $pay->user_id = $userId;
	    $pay->jinbi = $total_fee * 100;
	    $pay->amount = $total_fee;
	    $pay->out_trade_no = $out_trade_no;
	    $pay->date = date('Y-m-d H:i:s');
	    $pay->status = 1;
	    $pay->backurl = $gameUrl;
	    $pay->extra = $ext;
	    $pay->save();

	    //建立请求
	    $alipaySubmit = new AlipaySubmit($alipay_config);
	    $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
	    //echo $html_text;
	    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>等等跳转到支付宝</title></head>';
	    echo "不要刷新，耐心等待页面跳转";
	    echo $html_text;
	    exit;


	}

	/**
	 * 充道具进去
	 * @param unknown $orderId
	 * @param unknown $userId
	 * @param unknown $money
	 * @param unknown $ext
	 * @return Ambigous <string, mixed>
	 */
	function postPayResultToegrat($orderId, $userId, $money, $ext, $backurl){
// 	    orderId	是	渠道订单id
// 	    userId	是	玩家在渠道的用户Id
// 	    money	是	玩家在渠道上的实际充值金额（大陆统一为人民币元 float类型）
// 	    ext	是	egret透传参数，此参数在调用渠道支付页面地址时的透传参数
// 	    time	是	时间戳
// 	    sign	是	验证签名，签名生成方式详见附录1


	    $extArr = explode('::', $ext);
	    if(count($extArr) != 2){

	        $backurl = preg_replace('/\?.*$/', '', $backurl);

	        $postUrl = 'http://api.egret-labs.org/v2/pay/20437/';
	        preg_match('/game_20437_(\d+)/', $backurl, $matchs);

	        if($matchs){
	            $postUrl .= $matchs[1];
	        }else{
	            //http://api.egret-labs.org/v2/game/20437/642
	            preg_match('/game\/20437\/(\d+)/', $backurl, $matchs);
	            $postUrl .= $matchs[1];
	        }
	        //         $postUrl = ''; //TODO
	        $time = time();

	        $params = array(
	            'orderId'=>$orderId,
	            'userId'=>$userId,
	            'money'=>$money,
	            'ext'=>$ext,
	            'time' => $time
	        );
	        $canshu = '';
	        foreach ($params as $key => $value) {
	            if($key=='appId'){
	                continue;
	            }
	            $canshu .="$key=$value&";
	        }
	        $sign = $this->createSign($params, $this->appkey);
	        $postdata = $canshu.'sign='.$sign;

	        $path = Yii::app()->basePath.'/extensions/alipay/';
	        $fp = fopen($path."log_submit_to_egret.txt","a");
	        fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n");


	        fwrite($fp,"postUrl: ".$postUrl."\n");
	        fwrite($fp,"postdata: ".$postdata."\n");

	        $returnResult =  $this->postdata($postUrl, $postdata);

	        fwrite($fp,"returnResult: ".$returnResult."\n");

	        fclose($fp);

	    }else{

	        //第三方的，不是白鹭的
// 	        $postUrl = "http://open.juhesdk.twan.cn/paycallback.php?url_flag=10_64";

	        $postUrl = str_replace('game', 'paycallback', $backurl);

// 	        $postUrl = "http://open.juhesdk.twan.cn/paycallback.php?url_flag=10_64";


	        $time = time();
	        $params = array(
	            'orderId'=>$extArr[1],
	            'userId'=>$userId,
	            'money'=>$money,
	            'ext'=>$extArr[0],
	            'time' => $time
	        );
	        $canshu = '';
	        foreach ($params as $key => $value) {
	            $canshu .="$key=$value&";
	        }
	        $secret = "69ab069c3a16ea5b962faa42b073bb2d";
	        $sign = md5($secret . $time . $userId);
	        $postdata = $canshu.'sign='.$sign;

	        $path = Yii::app()->basePath.'/extensions/alipay/';
	        $fp = fopen($path."log_submit_to_tianwan.txt","a");
	        fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n");


	        fwrite($fp,"postUrl: ".$postUrl."\n");
	        fwrite($fp,"postdata: ".$postdata."\n");

	        $returnResult =  $this->postdata($postUrl, $postdata);

	        fwrite($fp,"returnResult: ".$returnResult."\n");

	        fclose($fp);


	    }
	    return true;
	}

	function actionGotoegret(){
	    $out_trade_no = $_GET['out_trade_no'];
	    $pay = Pay::model()->findByAttributes(array(
	       'out_trade_no'=>$out_trade_no
	    ));
	    $this->redirect($pay->backurl);
	    exit;
	}

	///*************第三方***/////
	public function actionPay3(){
	    // 	    var_dump($_GET);
	    // 	    userId	是	玩家在渠道上的用户id
	    // 	    userName	是	玩家在渠道上的用户昵称
	    // 	    gameId	是	游戏Id TODO
	    // 	    goodsId	是	游戏商品Id TODO
	    // 	    goodsName	是	游戏商品名称 TODO
	    // 	    money	是	支付金额（大陆统一为人民币元 float类型）
	    // 	    OrderId	是	egret的订单Id TODO ------
	    // 	    channelExt	否	渠道在用户登录进入游戏时的透传参数原样在此回传给渠道
	    // 	    ext	是	此参数为透传参数，通知支付结果接口调用的时候原样返回 TODO
	    // 	    gameUrl	是	游戏地址，渠道完成支付流程后跳转回游戏地址 TODO
	    // 	    time	是	时间戳
	    // 	    sign
	    if(isset($_GET['userId']) && isset($_GET['money']) && isset($_GET['gameUrl'])){
	        $path = Yii::app()->basePath.'/extensions/alipay/';
	        $fp = fopen($path."log_from_tianwan.txt","a");
	        fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n");

	        $getData = json_encode($_GET);

	        fwrite($fp,"GET 参数：".$getData."\n");
	        fclose($fp);
	    }else{
	        echo "支付参数不对";exit;
	    }

	    $ext = isset($_GET['ext']) ?  $_GET['ext'] : '';

	    $OrderId = isset($_GET['OrderId']) ?  $_GET['OrderId'] : '';
	    $gameId = isset($_GET['gameId']) ?  $_GET['gameId'] : '';
	    $ext = $ext . "::" . $OrderId ;

	    $yuan = (int) $_GET['money'];
	    if($yuan <=0){
	        $yuan = 1;
	    }
	    $userId = (int)$_GET['userId'];
	    $gameid = (int)$_GET['gameId'];
	    $gameUrl =  isset($_GET['gameUrl']) ?  $_GET['gameUrl'] : '';




	    $path = Yii::app()->basePath.'/extensions/alipay/';
	    require_once $path . 'alipay.config.php';
	    require_once $path . 'lib/alipay_submit.class.php';
	    $mydomain = 'http://h5.91yxq.com';
	    $payment_type = "1";
	    $notify_url = $mydomain . "/notify";
	    $return_url = $mydomain . "/gotoegret";
	    $out_trade_no = 'NJLL_EGRET_'.time() . '_CZ';
	    $subject = $_GET['goodsName'];
	    $total_fee = $yuan;//支付金额
	    $body =  $_GET['goodsName'];
	    $show_url = $mydomain . "/index/play?id=12470";
	    $anti_phishing_key = "";
	    $exter_invoke_ip = "";
	    $it_b_pay = 60;
	    $extern_token= '';
	    $parameter = array(
	        "service" => "alipay.wap.create.direct.pay.by.user",
	        "partner" => trim($alipay_config['partner']),
	        "seller_id" => trim($alipay_config['seller_id']),
	        "payment_type"	=> $payment_type,
	        "notify_url"	=> $notify_url,
	        "return_url"	=> $return_url,
	        "out_trade_no"	=> $out_trade_no,
	        "subject"	=> $subject,
	        "total_fee"	=> $total_fee,
	        "show_url"	=> $show_url,
	        "body"	=> $body,
	        "it_b_pay"	=> $it_b_pay,
	        "extern_token"	=> $extern_token,
	        "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
	    );



	    $pay = new Pay();
	    $pay->user_id = $userId;
	    $pay->jinbi = $total_fee * 100;
	    $pay->amount = $total_fee;
	    $pay->out_trade_no = $out_trade_no;
	    $pay->date = date('Y-m-d H:i:s');
	    $pay->status = 1;
	    $pay->backurl = $gameUrl;
	    $pay->extra = $ext;
	    $pay->save();

	    //建立请求
	    $alipaySubmit = new AlipaySubmit($alipay_config);
	    $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
	    //echo $html_text;
	    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>等等跳转到支付宝</title></head>';
	    echo "不要刷新，耐心等待页面跳转";
	    echo $html_text;
	    exit;


	}

	/**
	 * 用户收藏接口
	 */
	public function actionCollection(){
	    if(!Yii::app()->session['user_login']){
	        echo 'needlogin'; exit;
	    }
	    $user = Users::model()->findByPk(Yii::app()->session['user_id']);
	    if (Yii::app()->request->isPostRequest){
	       $isCollection = $_POST['iscollection'];
	       $gameId = (int)$_POST['gameid'];
	       $userC = UserCollection::model()->findByAttributes(array(
	           'gameid' => $gameId,
	           'userid' => $user->id
	       ));
	       if($isCollection){
	           if(!$userC){
	               $userC = new UserCollection();
	               $userC->gameid = $gameId;
	               $userC->userid = $user->id;
	               $userC->save();
	           }
	       }else{
	           if($userC){
	               $userC->delete();
	           }
	       }
	    }
	    echo "ok";exit;
	}

	/**
	 * 用户收藏接口
	 */
	public function actionCollectionlist(){
	    $this->checkLogin();
	    $user = Users::model()->findByPk(Yii::app()->session['user_id']);
	    $list = UserCollection::model()->findAllByAttributes(array('userid' => $user->id));

	    $this->render('collectionlist', array(
	        'list'=>$list
	    ));
	}

}

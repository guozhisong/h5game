<?php

class PayController extends Controller
{
    public $layout='/';

    public $logincss=true;

    public $host ='';

    /**
      * 2:自己支付宝  3:第三方支付宝   4:第三方微信  5:自己微信
      * ALP  wap      WXS  wap
      * ALM  app      WXM  app
      */
    public function actionTopay(){
        $this->layout = '/';

        if(isset($_REQUEST['data']) && isset($_REQUEST['pay_method'])){
          $this->host = "http://h5.mpyouxi.com";
          $this->checkLogin();
          $data = decrypt(urldecode($_REQUEST['data']));
          parse_str($data);

          if(isset($appid) && isset($userOrderid) && isset($uid) && isset($gameUrl) && isset($money) && isset($sign) && in_array($_REQUEST['pay_method'],[1,2])){
            $game = Games::model()->find('appid=:appid', array(':appid'=>$appid));
            if(!$game)  echojson(false,'应用不存在');

            $appkey = $game->appkey;
            $time = isset($time) ? $time :'';
            $resign = md5($userOrderid.$appid.$money.$time.$uid.$appkey);
            if($resign !== $sign) echojson(false,'验签失败');

            if($_REQUEST['pay_method'] == 1)  $this->alipay($data);
            else $this->wx_scan($data);
          }else{
            echojson(false,'支付参数错误');
          }
        }else{
//          $uid = get_uid($_GET['uid']);
//          if(YII_DEBUG){
//            /***********本地**************/
//            $mem = new Memcached();             //线上：new Memcache   本地:new Memcached()
//            $mem->addServer('127.0.0.1', 11211);  //线上:$mem->connect  本地:$mem->addServer
//            $this->host = $mem->get("login_host_$uid");
//            /************本地end****************/
//          }else{
//            /*********生产*************/
//            $mem = new Memcache();                    //线上：new Memcache   本地:new Memcached()
//            $mem->addServer('127.0.0.1', 11211);      //线上:$mem->connect  本地:$mem->addServer
//            $this->host = $mem->get("login_host_$uid");
//            $mem->close();                            //线上:不注释  本地:注释
//            /**********生产end*********/
//          }

//          if($this->host == 'www.81900.com' && !isset($_GET['flag'])){
//            header("Location:http://www.81900.com{$_SERVER['REQUEST_URI']}&flag=1");
//          }else{
            $this->checkLogin();
//          }
          // doLog($this->host,'host1');
//          $this->host = $this->host ? "http://{$this->host}" : "http://h5.91yxq.com";
          // doLog($this->host,'host2');

          /****预留第三方接入平台 $game表单对象根据具体的第三方接入参数查询获取*****/
//          if($func = $game->plat_form){
//            if (method_exists($this,$func)) {
//              $this->$func();
//              exit;
//            } else {
//              exit("<script>alert('SDK支付接入中...');</script>");
//            }
//          }
          /***预留第三方接入平台 end*****/

          /***********测试数据**************/
          // $userOrderid = date('YmdHis');
          // $money = 0.02;
          // $time = time();
          // $_GET = [
          //   'appid' => '6ccdf6e6f272176c04407150bcb14e76',//
          //   'userOrderid'=>$userOrderid, //
          //   'goodsName' =>'钻石',
          //   'uid' =>'cpd13168',        //
          //   'ext' => '',
          //   'gameUrl'=>'http://h5.91yxq.com/game/login?appid=6ccdf6e6f272176c04407150bcb14e76', //
          //   'time' => time(),
          //   'money'=>$money,   //
          //   'sign'=>md5("{$userOrderid}6ccdf6e6f272176c04407150bcb14e76{$money}{$time}cpd13168a2ca40dceaea0d49f50b6a5f21d4eb02"),  //
          // ];
          /*************测试数据end**************/

          if(!$_GET['appid'] || !$_GET['userOrderid'] || !$_GET['money'] || !$_GET['sign']){
            exit("<script>alert('非法请求');</script>");
          }else{
            $game = Games::model()->find('appid=:appid', array(':appid'=>$_GET['appid']));
            if(!$game)    exit("<script>alert('非法请求');</script>");
            $appkey = $game->appkey;
            $sign = md5("{$_GET['userOrderid']}{$_GET['appid']}{$_GET['money']}{$_GET['time']}{$_GET['uid']}{$appkey}");
            if($sign != $_GET['sign'] ) exit("<script>alert('非法请求');</script>");
          }

          //验证金额合法
          if(!preg_match("/^[0-9]+(.[0-9]{2})?$/",$_GET['money']) || $_GET['money'] <= 0)
              exit("<script>alert('非法请求!');</script>");

          //折后价
          $discount = $game->discount ? $game->discount : 1;
          $discount_pay = sprintf("%.2f",$_GET['money']*$discount);

          $_GET['discount_pay'] = $discount_pay;
          $_GET['discount'] = $discount;

          $data = http_build_query($_GET);
          $data = encrypt($data);
          $this->render('topay', array(
    	        'data'=>urlencode($data),
              'goodsName' => isset($_GET['goodsName']) && $_GET['goodsName'] ? $_GET['goodsName'] : '游戏商品',
              'oldMoney' => $_GET['money'],
              'discount' => sprintf("%.1f", $discount * 10),
              'newMoney' => $discount_pay,
              'userOrderid' => $_GET['userOrderid'],
              'appid' => $_GET['appid'],
              'is_mobile' => is_mobile()
    	    ));
        }
  	}


    /**
      *   支付宝 （官方）
      */
    private function alipay($data){
      parse_str($data);

      $goodsName = isset($goodsName) && $goodsName ? $goodsName : 'h5游戏商品';

      $userId = (int)get_uid($uid);

      $path = Yii::app()->basePath.'/extensions/alipay/';
      require_once $path . 'alipay.config.php';
      require_once $path . 'lib/alipay_submit.class.php';
      // doLog($this->host,'host3');
      $mydomain = $this->host;//Yii::app()->params['hostUrl'];
      $payment_type = "1";
      $notify_url = $mydomain . "/alnotify";
      $out_trade_no ='ALP'.date('YmdHis').rand(1000, 9999);
      $subject = $goodsName;
      $total_fee = $discount_pay;//实际支付金额
      $org_amount = $money;       //折前价格

      if($discount_pay != sprintf("%.2f",$money*$discount)){    //再次验证
        echo "<script>alert('数据异常')</script>";
        exit;
      }
      $body =  $goodsName;

      $gameUrl = "$mydomain/game/login?appid=$appid";
      $show_url = $gameUrl;                   //前台地址
      $return_url = "$mydomain/pay/alstatus"; //支付成功返回地址


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
      // doLog($parameter,'parameter');
      $pay = new Pay();
      $pay->appid = $appid;
      $pay->user_id = $userId;
      $pay->jinbi = $total_fee * 100;
      $pay->amount = $total_fee;
      $pay->org_amount = $org_amount;
      $pay->discount = $discount;
      $pay->goods_name = $goodsName;
      $pay->out_trade_no = $out_trade_no;
      $pay->user_orderid = $userOrderid;
      $pay->date = date('Y-m-d H:i:s');
      $pay->status = 1;
      $pay->payed_type = 2;     //自己支付宝wap
      $pay->extra = isset($ext) ? $ext : '';


      if($pay->save()){
        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>等等跳转到支付宝</title></head>';
        echo "不要刷新，耐心等待页面跳转";
        echo $html_text;
        exit;
      }

    }

    /**
      *    微信扫码 (官方)
      */
    private function wx_scan($data){
      parse_str($data);
      $goodsName = isset($goodsName) && $goodsName ? $goodsName : 'h5游戏商品';
      $pay = new Pay();
      $pay->appid = $appid;
      $pay->user_id = (int)get_uid($uid);
      $pay->jinbi = $discount_pay * 100;
      $pay->amount = $discount_pay;//实际支付金额
      $pay->org_amount = $money;
      $pay->discount = $discount;

      if($discount_pay != sprintf("%.2f",$money*$discount)){    //再次验证
        echo "<script>alert('数据异常')</script>";
        exit;
      }
      $pay->goods_name = $goodsName;
      $pay->out_trade_no = 'WXS'.date('YmdHis').rand(1000, 9999);
      $pay->user_orderid = $userOrderid;
      $pay->date = date('Y-m-d H:i:s');
      $pay->status = 1;
      $pay->payed_type = 5;   //自己的微信扫码
      $pay->extra = $ext;

      if($pay->save()) {
        $path = Yii::app()->basePath.'/extensions/WxpayAPI';
        require_once $path . '/lib/WxPay.Api.php';
        require_once $path . '/api/WxPay.NativePay.php';
        require_once $path . '/api/log.php';
        require_once $path . '/api/phpqrcode/phpqrcode.php';
        $input = new WxPayUnifiedOrder();
        $notify = new NativePay();
        $input->SetBody($goodsName);
        $input->SetAttach($goodsName);
        $input->SetOut_trade_no($pay->out_trade_no);
        $input->SetTotal_fee($discount_pay*100);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("h5");
        $input->SetNotify_url($this->host.'/wxnotify');
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id('');
        $result = $notify->GetPayUrl($input);
        $url = urlencode($result["code_url"]);
        $url = urldecode($url);
        QRcode::png($url);
      }

    }

    //微信扫码支付异步通知   游戏直充

    // $xml = '<xml><appid><![CDATA[wxe137c5c7bf0dbd87]]></appid>
    // <bank_type><![CDATA[CFT]]></bank_type>
    // <cash_fee><![CDATA[1]]></cash_fee>
    // <fee_type><![CDATA[CNY]]></fee_type>
    // <is_subscribe><![CDATA[N]]></is_subscribe>
    // <mch_id><![CDATA[1480384592]]></mch_id>
    // <nonce_str><![CDATA[frxi2lm276xdu69tsg7iyogt3x0tmhz6]]></nonce_str>
    // <openid><![CDATA[oyhPm00NV1hUXOOgMDxc2SRJ22og]]></openid>
    // <out_trade_no><![CDATA[WX201706191544139339]]></out_trade_no>
    // <result_code><![CDATA[SUCCESS]]></result_code>
    // <return_code><![CDATA[SUCCESS]]></return_code>
    // <sign><![CDATA[EE3C70C44A2E61C5CA00BDB8995BA31B]]></sign>
    // <time_end><![CDATA[20170619154429]]></time_end>
    // <total_fee>1</total_fee>
    // <trade_type><![CDATA[JSAPI]]></trade_type>
    // <transaction_id><![CDATA[4007882001201706196454064095]]></transaction_id>
    // </xml>';
    public function actionWxnotify(){
      $path = Yii::app()->basePath.'/extensions/WxpayAPI';
      include_once $path.'/api/notify.php';
      $notify = new \PayNotifyCallBack();
      echo $notify->Handle(false);

      $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
      doLog($xml,'wxnotify');
      $xml_to_array = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
      $total_fee = (int)$xml_to_array['total_fee']/100;
      if($xml_to_array['result_code'] == 'SUCCESS'){
        $pay = Pay::model()->findByAttributes(array('out_trade_no'=>$xml_to_array['out_trade_no'],'status'=>1));
        if($pay){
          if($total_fee != $pay->amount){
            $pay->trade_no = $trade_no;
            $pay->verify_msg = "支付金额{$total_fee}与订单金额不符";
            $pay->save();
          }else{
            $pay->status = 2;
            $pay->trade_no = $xml_to_array['transaction_id'];
            $pay->payed_time = time();
            if($pay->save())  $returnStr = $this->get_app_response_post($pay);
            // if($pay->backurl){
                //通知发货

            // }
            $this->redirect($this->createUrl('game/login',array('appid'=>$pay->appid)));
          }
      }
    }
  }

  //支付宝异步通知
  public function actionAlnotify(){
//     $_POST = array (
//   'payment_type' => '1',
//   'trade_no' => '2017112321001104930589674403',
//   'subject' => '钻石',
//   'buyer_email' => '18251886945',
//   'gmt_create' => '2017-11-23 16:55:08',
//   'notify_type' => 'trade_status_sync',
//   'quantity' => '1',
//   'out_trade_no' => 'ALP201711231654485054',
//   'seller_id' => '2088421259046560',
//   'notify_time' => '2017-11-23 16:55:10',
//   'body' => '钻石',
//   'trade_status' => 'TRADE_SUCCESS',
//   'is_total_fee_adjust' => 'N',
//   'total_fee' => '0.01',
//   'gmt_payment' => '2017-11-23 16:55:10',
//   'seller_email' => '3073553515@qq.com',
//   'price' => '0.01',
//   'buyer_id' => '2088702684255935',
//   'notify_id' => '9af4120b5286dd71e04ebc026003036n6h',
//   'use_coupon' => 'N',
//   'sign_type' => 'MD5',
//   'sign' => 'c2e518ce95ef096db574018d29af1cea',
// );
      doLog($_POST,'alnotify');
      $path = Yii::app()->basePath.'/extensions/alipay/';
      require_once $path . 'alipay.config.php';
      require_once $path . 'lib/alipay_notify.class.php';
      $alipayNotify = new AlipayNotify($alipay_config);
      $verify_result = $alipayNotify->verifyNotify();

      if($verify_result) {
          $out_trade_no = $_POST['out_trade_no'];
          $trade_no = $_POST['trade_no'];
          $trade_status = $_POST['trade_status'];

          $total_fee = $_POST['total_fee'];
          if($_POST['trade_status'] == 'TRADE_FINISHED') {
              //注意：
              //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
          }
          else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
              $pay = Pay::model()->findByAttributes(array('out_trade_no'=>$out_trade_no,'status'=>1));
              if($pay){
                  if($total_fee != $pay->amount){
                    $pay->trade_no = $trade_no;
                    $pay->verify_msg = "支付金额{$total_fee}与订单金额不符";
                    $pay->save();
                  }else{
                    $pay->status = 2;
                    $pay->trade_no = $trade_no;
                    $pay->payed_time = time();
                    if($pay->save())
                      $returnStr = $this->get_app_response_post($pay);
                    // if($pay->backurl){
                    //     //游戏直接过来的
                    //     $returnStr = $this->get_app_response_post($pay);
                    // }else{
                    //     //充金币的
                    //     $user = Users::model()->findByPk($pay->user_id);
                    //     if($user){
                    //         $user->jinbi = $user->jinbi + $pay->jinbi;
                    //         $user->huiyuan = 1;
                    //         $user->save();
                    //         $jinbilog = new Jinbilog;
                    //         $jinbilog->user_id = $user->id;
                    //         $jinbilog->desc = '充值';
                    //         $jinbilog->jinbi = $pay->jinbi;
                    //         $jinbilog->date = date('Y-m-d H:i:s');
                    //         $jinbilog->save();
                    //     }
                    // }
                  }
              }
          }
          echo "success";		//请不要修改或删除
      } else {
          //验证失败
          echo "fail";
      }
  }


  //通知发货
  function get_app_response_post($data){
    doLog(json_decode(CJSON::encode($data),TRUE),'pay');
    $t = time();
    $game = Games::model()->findByAttributes(array('appid'=>$data->appid));

    /********************************/
    $notify_time   = urlencode(date("Y-m-d H:i:s"));
    $user_orderid  = urlencode($data->user_orderid);
    $total_fee     = urlencode($data->org_amount);
    $trade_status  = 1;
    $goods_subject = urlencode($data->goods_name);
    $userparam = $data->extra;
    $appkey = $game->appkey;
    $notify_url = $game->notify_url;


    //整理url链接
    $para = "n_time={$notify_time}&o_id={$user_orderid}&t_fee={$total_fee}";
    $para .= "&g_name={$goods_subject}&t_status={$trade_status}";
    $sign = strtoupper(md5("{$para}{$appkey}"));

    $postdata['n_time'] = $notify_time;
    $postdata['o_id'] = $user_orderid;
    $postdata['t_fee'] = $total_fee;
    $postdata['g_name'] = $goods_subject;
    $postdata['t_status'] = $trade_status;
    $postdata['o_sign'] = $sign;
    $postdata['u_param'] = $userparam;
    /******************************/

    if($notify_url){
        $responseText = $this->curl_option(0,$notify_url,json_encode($postdata,JSON_UNESCAPED_UNICODE),1);
    }
  }

  //回调操作
  private function curl_option($id=0,$url='',$param='',$cnt=1){
      if($url && $param){
          $curl = curl_init($url);
          curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
          curl_setopt($curl, CURLOPT_POST,true); // post传输数据
          curl_setopt($curl, CURLOPT_TIMEOUT, 5); // 超时时间
          curl_setopt($curl, CURLOPT_POSTFIELDS,$param);// post传输数据
          $responseText = strtolower(curl_exec($curl));
          $responseText = trim($responseText);
          curl_close($curl);
          doLog($responseText, 'notify_log');
          if($id == 0){
              //第一次请求
              if($responseText != 'success'){
                  $notify = new Notify();
                  $notify->url = $url;
                  $notify->param = $param;
                  $notify->cnt = 1;
                  $notify->save();
                  $this->set_send_notify_log($url,$param,'0','1',$responseText);
              }else{
                  $this->set_send_notify_log($url,$param,'1','1',$responseText);
              }
          }else{
              if($responseText == 'success' || $cnt == 5){
                  if ($responseText == 'success') {
                      $this->set_send_notify_log($url,$param,'1',$cnt,$responseText);
                  }
                  //关闭此请求
                  Notify::model()->deleteByPk($id);
              }else{
                  //计数+1
                  $notify = Notify::model()->findByPk($id);
                  $notify->cnt++;
                  $notify->save();
                  $this->set_send_notify_log($url,$param,'0',++$cnt,$responseText);
              }
          }
          return $responseText;
      }
  }

    //回调操作记录
  private function set_send_notify_log($url, $param='', $status='0', $cnt='1',$error_msg=''){
      $motify_log = new NotifyLog();
      $param_arr = json_decode($param,true);
      $motify_log->url = $url;
      $motify_log->cnt = $cnt;
      $motify_log->back_status = $status;
      $motify_log->out_trade_no = $param_arr['o_id'];
      $motify_log->total_fee = $param_arr['t_fee'];
      $motify_log->subject = $param_arr['g_name'];
      $motify_log->trade_status = $param_arr['t_status'];
      $motify_log->sign = $param_arr['o_sign'];
      $motify_log->add_time = time();
      $motify_log->para = $param;
      $motify_log->error_msg = $error_msg;
      $motify_log->save();
  }

  //每2分钟回调一次应用服务器
  function actionSend_notify(){
      $notify = Notify::model()->findAll();
      if(isset($notify) && $notify){
        foreach($notify as $row){
            $this->curl_option($row['id'],$row['url'],$row['param'],$row['cnt']);
        }
      }
  }

  //支付宝同步通知
  public function ActionAlstatus(){
    doLog($_GET,'alstatus');
    $this->status(http_build_query($_GET));
  }

  //微信扫码提示
  public function ActionWxstatus(){
    doLog($_GET,'wxstatus');
    if(isset($_GET['data']) && $_GET['data']){
      $this->status(decrypt(urldecode($_GET['data'])));
    }
  }

  private function status($data){
    doLog($data,'status');
    parse_str($data);
    if(isset($trade_status) && ($trade_status== 'TRADE_SUCCESS' || $trade_status=='TRADE_FINISHED')){
      $status= 1;
      $total_fee = $total_fee;
    }else{
      $status= 0;
    }

    if(isset($out_trade_no)) {
      $order = Pay::model()->find('out_trade_no=:out_trade_no',[':out_trade_no'=>$out_trade_no]);
      $this->render('notify', array(
          'goods_name' => $order->goods_name,
          'total_fee' => $total_fee ? $total_fee : $order->amount,
          'order_time' => $order->date,
          'status' => $status,
          'return_url' => $this->host."/game/login?appid=".$order->appid
      ));
    }else{
      $this->render('notify', array(
          'status' => $status,
          'return_url' => $this->host
      ));
    }
  }

  public function ActionOrder_status(){
    if($_POST['id']){
      $pay = Pay::model()->find('user_orderid=:user_orderid',array(':user_orderid'=>$_POST['id']));
      doLog(json_decode(CJSON::encode($pay),TRUE),'order');
      if(!$pay)  echojson(0,'');
      if($pay && $pay->status == 2) {
        $str = encrypt("trade_status=TRADE_SUCCESS&total_fee={$pay->amount}&out_trade_no={$pay->out_trade_no}");
        echojson(1,'',['params'=>urlencode($str)]);
      }
    }else{
      echojson(0,'');
    }
  }

  function checkLogin(){
      if(!Yii::app()->session['user_login']){
          $this->redirect(array('user/login'));exit;
      }
  }

}

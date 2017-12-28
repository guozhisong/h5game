<?php

class VersionController extends Controller
{

   /**
    *     为了方便，客户端的版本号必须最多一个小数点的数字  合法：2.1   不合法：2.1.1
    */
    public function actionUpdate()
    {

      $v = isset($_GET['v']) ? $_GET['v'] : '';
      if(preg_match("/^[0-9]*$/",$v)){
        $latest_version = 1;
        $latest_apk = "http://www.81900.com/81900.apk";
        // doLog($v,'sdkversion');
        if($v < $latest_version){
          $data['resultcode'] = 200;
          $data['msg'] = "success";
          $data['result']=[
            "url"=> $latest_apk,
            'is_force'=>0
          ];
        }else{
          $data['resultcode'] = 200;
          $data['msg'] = "success";
          $data['result']=[
            "url"=> '',
            'is_force'=>''
          ];
        }
        echo json_encode($data);
        exit;
      }
    }

}

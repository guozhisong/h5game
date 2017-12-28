<?php

use yii\helpers\VarDumper;

function P($vars, $simple = false) {
	echo "apiP:\n";
	print_r($vars);
	exit;
  if($simple)
    print_r($vars);
  else
    VarDumper:: dump($vars, 10, true);
  exit;
}

/*-------------------------------------------------------------------------------------------
 截取用户名字数
 @param     anything     任意内容
 @return    终止并输出
--------------------------------------------------------------------------------------------*/
function cnickname($nickname) {
  if( strlen($nickname) > 5 ) {
      return csubstr($nickname, 0, 4);
  }
  return $nickname;
}

/*-------------------------------------------------------------------------------------------
 应用程序独有的md5 和 sha1
 @param     str     字符串
 @return    终止并输出
--------------------------------------------------------------------------------------------*/
function app_md5($str = '') {
  return md5( Yii:: app()->params['key'].$str.Yii:: app()->params['key'] );
}
function app_sha1($str = '') {
  return sha1( Yii:: app()->params['key'].$str.Yii:: app()->params['key'] );
}

/*-------------------------------------------------------------------------------------------
 生成一个验证key
 @param     str     字符串
 @return    终止并输出
--------------------------------------------------------------------------------------------*/
function app_get_key($string = '') {
  return app_sha1( json_encode($string).get_timestamp().mt_rand(1, 999).json_encode($_GET).json_encode($_POST) );
}

//干掉所有链接
function kill_all_link($content) {
  #$content = "你说什么呢 youku.com/呵 ，测试嘛 http://sohu.com http://www.taobao.com youku.com/nidayede/呵呵/id=5 还有这个网址，很可爱的哦  abc.com/123";
  $content = "分享个网址哦哦哦http://weibo.com/guojikai/home#_rnd1406471374886";
  preg_match_all('/((http|https|ftp|ftps):\/\/)?([a-zA-Z0-9-]+\.){1,5}(com|cn|net|org|hk|tw)((\/(\w|-)+(\.([a-zA-Z]+))?)+)?(\/)?(\??([\.%:a-zA-Z0-9_-]+=[#\.%:a-zA-Z0-9_-]+(&amp;)?)+)?/', $content, $results);
  $results = $results[0];
  foreach($results as $rs) {
  P($rs);
    $domain = get_domain($rs);
    if(get_domain($rs) == 'tuanpu.com') { //这个是站内的哦
      #$content = str_replace($rs, "http://", $content);
    } else {
      $content = str_replace($rs, '<a href="javascript:;" onclick="TP.deadlink();">http://********</a>', $content);
    }
  }
  P($content);
  return $content;
}

//替换所有链接
function replace_all_link($content) {
  $content = "分享个网址哦哦哦http://weibo.com/guojikai/home#_rnd1406471374886";
  preg_match_all('/((http|https|ftp|ftps):\/\/)?([a-zA-Z0-9-]+\.){1,5}(com|cn|net|org|hk|tw)((\/(\w|-)+(\.([a-zA-Z]+))?)+)?(\/)?(\??([\.%:a-zA-Z0-9_-]+=[#\.%:a-zA-Z0-9_-]+(&amp;)?)+)?/', $content, $results);
  foreach($results[0] as $rs) {
    $domain = get_domain($rs);
    if(get_domain($rs) == 'tuanpu.com') { //这个是站内的哦
      $content = str_replace($rs, '<a href="javascript:;" onclick="TP.deadlink();">http://********</a>', $content);
    } else {
      $content = str_replace($rs, "http://", $content);
    }
  }
  return $content;
}

//根据长网址获取短网址
function long2short($url_long) {
  $md5 = md5($url_long);
  $t = T:: model()->find("`md5` = '$md5'");
  if(!$t) {
    $response = Yii:: app()->http->get('http://api.weibo.com/2/short_url/shorten.json?source=4048254003&url_long='.$url_long);
    $json = json_decode($response);
    $t = new T;
    $t->md5 = $md5;
    $t->url_short = $json[0]->url_short;
    $t->url_long = $json[0]->url_long;
    $t->save();
  }
  return $t->url_short;
}

/*-------------------------------------------------------------------------------------------
 根据中文生成一个网址cname
 @param     str     字符串
 @return    终止并输出
--------------------------------------------------------------------------------------------*/
function get_cname($str) {
  $pinyin = Yii:: app()->pinyin->replace($str);
  return csubstr(strtolower($pinyin), 0, 14, false).mt_rand(10, 99).mt_rand(10, 99);
}

//获取模糊年纪
function get_age_days($num) {
  $now = get_timestamp();
  $years = (int)(($now-$num) / 86400 / 365 );
  $days = (int)(($now-$num) / 86400) % 365;
  if($years < 0) return '小于1岁';
  return $years.'岁';
}

//在视图渲染时河蟹一下
function hexie($str) {
  $hexie = Yii:: app()->hexie;
  return $hexie->replace($str);
}

//高亮
function highlight($str, $word) {
  $str = hexie($str);
  $str = str_replace($word, '<span class="f-red">'.$word.'</span>', $str);
  return $str;
}

//在视图渲染时将表情代码转换成HTML  例：<img src="[:可爱]" width="30" ....
function emote_render($str, $size = 30) {
  preg_match_all("/\[([a-zA-Z0-9]{0,12}[:]+(.{1,11}))?\]/", $str, $results);
  if( !count($results[0]) ) return $str;
  $static_url = Yii:: app()->params['static_url'];
  $all_code = Emote:: model()->getCode();

  foreach($results[0] as $k => $v) {
    $name = str_replace(array('[', ']'), '', $v);
    $code = explode(':', $name);
    $code = $code[0];
    $file = '';
    foreach($all_code as $k2 => $v2) {
      if($name == $v2['name']) {
        $file = $v2['file'];
        break;
      }
    }
    $str = str_replace($v, '<img src="'.$static_url.'/emote/default/i_f'.$file.'.png" width="'.$size.'" height="'.$size.'" title="'.str_replace(':','',$name).'" alt="'.str_replace(':','',$name).'" />', $str);
  }
  return $str;
}

//显示宠物说的换行符
function show_say_content($content) {
  $content = hexie($content);
  $content = str_replace(chr(10), '<br />', $content);
  return $content;
}

//显示问题的换行符和图片
function show_ask_content($content, $photos) {
  $content = hexie($content);
  $content = str_replace(chr(10), '<br />', $content);
  $photos_count = count($photos);
  for($i=1; $i<=$photos_count; $i++) {
    $content = str_replace('[图'.$i.']', '<img src="http://photo.tuancdn.com'.$photos[$i-1]['fullname'].'_w520.jpg" border="0" alt="图'.$i.'" />', $content);
  }
  return $content;
}


//数字ID与字符互转（基于 base.php 的 dec2hex）
function tp_dec2hex($num) {
  if(!$num) $num = 100000;
  $dict = 'Cz5Za3Bx1Ub4Dw0Ec2Fu9Sd7Gv6Xe8KfAyVgHsWhIrJiLqRjMpNlOtTmPoYnQk';
  return 'T'.dec2hex($num).$dict[mt_rand(1,61)].$dict[mt_rand(1,61)].$dict[mt_rand(1,61)];
}
function tp_hex2dec($string) {
  $string = substr($string, 1, strlen($string)-4);
  $dict = 'Cz5Za3Bx1Ub4Dw0Ec2Fu9Sd7Gv6Xe8KfAyVgHsWhIrJiLqRjMpNlOtTmPoYnQk';
  return hex2dec($string);
}

//生成随机文件名（简单的生成一个文件名，不包括后缀）
function get_filename($lenght = 16) {
  $filename = chr(mt_rand(97,122)).mt_rand(0,9).substr(uniqid(), 6, 4).time().chr(mt_rand(97,122)).mt_rand(0,9);
  return $filename;
}


//判断是否赞过
function is_liked($key) {
  P( Yii:: app()->Account->data );
  P($key);

}

//取首字母
function get_initial($string) {
	$pinyin = Yii::$app->pinyin->convert($string);
	$initial = substr($pinyin, 0, 1);
	$initial = strtoupper($initial);

	if(!preg_match("/^[A-Z]$/", $initial) ) {
		$initial = '#';
	}
	return $initial;
}

//抓取远程图片，保存到runtime目录，返回图片路径
function get_temp_image($image_url) {
	$image = Yii::$app->http->get($image_url);
	if(strlen($image) < 50) return null;
	$filename = Yii::getAlias('@runtime').'/temp_image_'.get_timestamp().'_'.mt_rand(101001,989898).'.jpg';
	$fp = @fopen($filename, "w");
	fwrite($fp, $image);
	fclose($fp);
	return $filename;
}

//toWs
function to_ws($params) {
}

function encode_geohash($latitude, $longitude, $deep)
{
    $BASE32 = '0123456789bcdefghjkmnpqrstuvwxyz';
    $bits = array(16,8,4,2,1);
    $lat = array(-90.0, 90.0);
    $lon = array(-180.0, 180.0);

    $bit = $ch = $i = 0;
    $is_even = 1;
    $i = 0;
    $mid;
    $geohash = '';
    while($i < $deep) {
        if ($is_even) {
            $mid = ($lon[0] + $lon[1]) / 2;
            if($longitude > $mid){
                $ch |= $bits[$bit];
                $lon[0] = $mid;
            }else{
                $lon[1] = $mid;
            }
        } else{
            $mid = ($lat[0] + $lat[1]) / 2;
            if($latitude > $mid){
                $ch |= $bits[$bit];
                $lat[0] = $mid;
            }else{
                $lat[1] = $mid;
            }
        }

        $is_even = !$is_even;
        if ($bit < 4)
            $bit++;
        else {
            $i++;
            $geohash .= $BASE32[$ch];
            $bit = 0;
            $ch = 0;
        }
    }
    return $geohash;
}

function decode_geohash($geohash)
{
    $geohash = strtolower($geohash);
    $BASE32 = '0123456789bcdefghjkmnpqrstuvwxyz';
    $bits = array(16,8,4,2,1);
    $lat = array(-90.0, 90.0);
    $lon = array(-180.0, 180.0);
    $hashlen = strlen($geohash);
    $is_even = 1;

    for($i = 0; $i < $hashlen; $i++ ){
        $of = strpos($BASE32,$geohash[$i]);
        for ($j=0; $j<5; $j++) {
            $mask = $bits[$j];
            if ($is_even) {
                $lon[!($of&$mask)] = ($lon[0] + $lon[1])/2;
            } else {
                $lat[!($of&$mask)] = ($lat[0] + $lat[1])/2;
            }
            $is_even = !$is_even;
        }
    }
    $point = array( 0 => ($lat[0] + $lat[1]) / 2, 1 => ($lon[0] + $lon[1]) / 2);
    return $point;
}

//解密 base32
function decode_base32($geohash){//wm3yr31d2524   28193302331122524
		$length = strlen($geohash);
		$BASE32 = ['0','1','2','3','4','5','6','7','8','9','b','c','d','e','f','g','h','j','k','m','n','p','q','r','s','t','u','v','w','x','y','z'];
		$data = '';
		for($i = 0;$i<$length;$i++){
				$data .= array_search($geohash[$i],$BASE32);
		}
		return $data;
}

/**
 * 计算两个坐标之间的距离(返回字符串)
 * @param float $fP1Lat 起点(纬度)
 * @param float $fP1Lon 起点(经度)
 * @param float $fP2Lat 终点(纬度)
 * @param float $fP2Lon 终点(经度)
 * @return string
 */
function distance_between($fP1Lat, $fP1Lon, $fP2Lat, $fP2Lon) {
	$fEARTH_RADIUS = 6378137;
	//角度换算成弧度
	$fRadLon1 = deg2rad($fP1Lon);
	$fRadLon2 = deg2rad($fP2Lon);
	$fRadLat1 = deg2rad($fP1Lat);
	$fRadLat2 = deg2rad($fP2Lat);
	//计算经纬度的差值
	$fD1 = abs($fRadLat1 - $fRadLat2);
	$fD2 = abs($fRadLon1 - $fRadLon2);
	//距离计算
	$fP = pow(sin($fD1/2), 2) +
				cos($fRadLat1) * cos($fRadLat2) * pow(sin($fD2/2), 2);
	$between = intval($fEARTH_RADIUS * 2 * asin(sqrt($fP)) + 0.5);
	if($between < 100) return t('within_100_meters');
	if($between < 1000) return $between.t('meters');
	return (int)($between/1000).t('km');
}

/**
 * 百度坐标系转换成标准GPS坐系
 * @param float $lnglat 坐标(如:106.426, 29.553404)
 * @return string 转换后的标准GPS值:
 */
function bd09ll_to_wgs84($fLat, $fLng){ // 纬度, 经度
	$lnglat = explode(',', $lnglat);
	list($x,$y) = $lnglat;
	$Baidu_Server = "http://api.map.baidu.com/ag/coord/convert?from=0&to=4&x={$x}&y={$y}";
	$result = @file_get_contents($Baidu_Server);
	$json = json_decode($result);
	if($json->error == 0){
			$bx = base64_decode($json->x);
			$by = base64_decode($json->y);
			$GPS_x = 2 * $x - $bx;
			$GPS_y = 2 * $y - $by;
			return $GPS_x.','.$GPS_y;//经度,纬度
	}else
			return $lnglat;
}


/*
*function:二维数组按指定的键值排序
*/
function array_sort($array,$keys,$type='asc'){
	if(!isset($array) || !is_array($array) || empty($array)){
		return [];
	}
	if(!isset($keys) || trim($keys)==''){
		return [];
	}
	if(!isset($type) || $type=='' || !in_array(strtolower($type),array('asc','desc'))){
		return [];
	}
	$keysvalue=array();
	foreach($array as $key=>$val){
		$val[$keys] = str_replace('-','',$val[$keys]);
		$val[$keys] = str_replace(' ','',$val[$keys]);
		$val[$keys] = str_replace(':','',$val[$keys]);
		$keysvalue[] =$val[$keys];
	}
	asort($keysvalue); //key值排序
	reset($keysvalue); //指针重新指向数组第一个
	foreach($keysvalue as $key=>$vals) {
		$keysort[] = $key;
	}
	$keysvalue = array();
	$count=count($keysort);
	if(strtolower($type) != 'asc'){
		for($i=$count-1; $i>=0; $i--) {
			$keysvalue[] = $array[$keysort[$i]];
		}
	}else{
		for($i=0; $i<$count; $i++){
			$keysvalue[] = $array[$keysort[$i]];
		}
	}
	return $keysvalue;
}

/**
 * @todo   转换XML
 * @param unknown $str
 * @return boolean|mixed
 */
function xml_parser($str){
	$xml_parser = xml_parser_create();
	if(!xml_parse($xml_parser,$str,true)){
		xml_parser_free($xml_parser);
		return false;
	}else {
		return (json_decode(json_encode(simplexml_load_string($str)),true));
	}
}

/**
 * @todo生成随机的字符串
 * @param int  $length
 * @return string
 */
function randomkeys($length,$types = 1){
	$pattern='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$key = '';
	for($i=0;$i<$length;$i++)
	{
		//     		$key .= $pattern{mt_rand(0,9)};    //生成php随机数
		$key .= $pattern{mt_rand(0,$types == 1?9:57)};    //生成php随机数
	}
	return $key;
}

/**
 * @todo向文件中写入异常
 * @param array/string   $log
 */
function doLog($log,$filename){
	$dir = Yii::app()->basePath."/runtime/logs/$filename";
  if(is_array($log)){
      file_put_contents($dir, date('Y-m-d H:i:s',time()).':',FILE_APPEND);
      file_put_contents($dir, var_export($log,TRUE),FILE_APPEND);
  }else{
      $log = date('Y-m-d H:i:s',time()).":".$log."\r\n";
      file_put_contents($dir, $log,FILE_APPEND);
  }
}

/**
 * @todo随机增加
 *$tag:true、false
 */
 function randomadd($base,$tag=true){
	 if($tag){
		 if($base && $base >= 500)
				return $base + mt_rand(0, 2);
			else
				return mt_rand(500,2000) + mt_rand(0, 2);
	 }else{

	 }
 }

 /**
 *  国际化
 */
 function t($key){
	 return Yii::t('app', $key);
 }




 	 function sys_auth($string, $operation = 'ENCODE', $key = '', $expiry = 0) {
 		$key_length = 4;
 		$key = md5($key != '' ? $key : "asfwexaloq");
 		$fixedkey = md5($key);
 		$egiskeys = md5(substr($fixedkey, 16, 16));
 		$runtokey = $key_length ? ($operation == 'ENCODE' ? substr(md5(microtime(true)), -$key_length) : substr($string, 0, $key_length)) : '';
 		$keys = md5(substr($runtokey, 0, 16) . substr($fixedkey, 0, 16) . substr($runtokey, 16) . substr($fixedkey, 16));
 		$string = $operation == 'ENCODE' ? sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$egiskeys), 0, 16) . $string : base64_decode(substr($string, $key_length));

 		$i = 0; $result = '';
 		$string_length = strlen($string);
 		for ($i = 0; $i < $string_length; $i++){
 			$result .= chr(ord($string{$i}) ^ ord($keys{$i % 32}));
 		}
 		if($operation == 'ENCODE') {
 			return $runtokey . str_replace('=', '', base64_encode($result));
 		} else {
 			if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$egiskeys), 0, 16)) {
 				return substr($result, 26);
 			} else {
 				return '';
 			}
 		}
  }

  function encrypt($data,$key='h5_game_abcf09665'){

 	return base64_encode(sys_auth(serialize($data), 'ENCODE', $key));
  }

  function decrypt($data,$key='h5_game_abcf09665'){
 	return unserialize(sys_auth(base64_decode($data), 'DECODE', $key));
  }

 	 /**
 	 * @todo向文件中写入异常
 	 * @param array/string   $log
 	 */
 // 	function doLog($log,$filename){
 // 		$day = date('Y-m-d H:i:s');
 // 		$dir = __DIR__.'/../logs/'.$filename.'-'.date('Y-m-d');
 // 		// if(file_exists($dir) && filesize($dir)>1024*1024) rename($dir,$dir.'_'.$day);
 // 		if(is_array($log)){
 // 		  file_put_contents($dir, $day.':',FILE_APPEND);
 // 		  file_put_contents($dir, var_export($log,TRUE),FILE_APPEND);
 // 		}else{
 // 		  $log = $day.":".$log."\r\n";
 // 		  file_put_contents($dir, $log,FILE_APPEND);
 // 		}
 // 	}

 	function echojson($code,$msg,$data=[]){
 		exit(json_encode(['code'=>$code ? 200 : 500,'msg'=>$msg,'data'=>$data],JSON_UNESCAPED_UNICODE));
 	}

	function get_uid($cpd){
		$cpd = str_replace('cpd','',$cpd);
		return ($cpd+2)/2;
	}

	/**
 * 发送HTTP请求方法
 * @param  string $url    请求URL
 * @param  array  $params 请求参数
 * @param  string $method 请求方法GET/POST
 * @return array  $data   响应数据
 */
function http($url, $params, $method = 'GET', $header = array(), $multi = false){
    $opts = array(
            CURLOPT_TIMEOUT        => 50,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER     => $header
    );
    /* 根据请求类型设置特定参数 */
    switch(strtoupper($method)){
        case 'GET':
            $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
            break;
        case 'POST':
            //判断是否传输文件
            $params = $multi ? $params : urldecode(http_build_query($params));
            doLog($params,'http请求数据');
            $opts[CURLOPT_URL] = $url;
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $params;
            break;
        default:
            throw new Exception('不支持的请求方式！');
    }
    /* 初始化并执行curl请求 */
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $data  = curl_exec($ch);
    $error = curl_error($ch);
    doLog(curl_getinfo($ch,CURLINFO_HTTP_CODE),'http_code');
    curl_close($ch);
    if($error) doLog($params,'http错误');//throw new Exception('请求发生错误：' . $error);
    return  $data;
}


    function is_mobile(){

        // returns true if one of the specified mobile browsers is detected
        // 如果监测到是指定的浏览器之一则返回true

        $regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";

       $regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";

        $regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";

        $regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";

        $regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";

        $regex_match.=")/i";

        // preg_match()方法功能为匹配字符，既第二个参数所含字符是否包含第一个参数所含字符，包含则返回1既true
        return preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
   }

if( ! function_exists('array_column'))
{
    function array_column($input, $columnKey, $indexKey = NULL)
    {
        $columnKeyIsNumber = (is_numeric($columnKey)) ? TRUE : FALSE;
        $indexKeyIsNull = (is_null($indexKey)) ? TRUE : FALSE;
        $indexKeyIsNumber = (is_numeric($indexKey)) ? TRUE : FALSE;
        $result = array();

        foreach ((array)$input AS $key => $row)
        {
            if ($columnKeyIsNumber)
            {
                $tmp = array_slice($row, $columnKey, 1);
                $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : NULL;
            }
            else
            {
                $tmp = isset($row[$columnKey]) ? $row[$columnKey] : NULL;
            }
            if ( ! $indexKeyIsNull)
            {
                if ($indexKeyIsNumber)
                {
                    $key = array_slice($row, $indexKey, 1);
                    $key = (is_array($key) && ! empty($key)) ? current($key) : NULL;
                    $key = is_null($key) ? 0 : $key;
                }
                else
                {
                    $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;
                }
            }

            $result[$key] = $tmp;
        }

        return $result;
    }
}

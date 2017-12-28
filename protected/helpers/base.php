<?php

/*-------------------------------------------------------------------------------------------
 SQL AddSlashes
 @param     string     需过滤的字符串
 @return    string
--------------------------------------------------------------------------------------------*/
function temps_saddslashes($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = saddslashes($val);
		}
	} else {
		$string = addslashes($string);
	}
	return $string;
}

/*-------------------------------------------------------------------------------------------
 翻转数组并检查空值
 @param     array     数组
 @return    string
--------------------------------------------------------------------------------------------*/
function flip_array($arr) {
	if(!is_array($arr)) exit($arr);
	foreach($arr as $key => $val) {
		if(empty($val)) $val = '0'; //空值就赋值字符串0
		$arr[$key] = $val;
	}
	$arr = array_flip(array_flip($arr));
	return $arr;
}



/*-------------------------------------------------------------------------------------------
 截取中文字符串的函数
 @param   string      $str        字符串
 @param   int         $start      开始的位置
 @param   int         $len        截取的长度
 @param   bool        $append     是否附加省略号
 @return  string
--------------------------------------------------------------------------------------------*/
function csubstr($str, $start = 0, $length, $suffix = true, $charset = "utf-8") {
  if(function_exists("mb_substr")) {
    if(mb_strlen($str, $charset) <= $length) return $str;
    $slice = mb_substr($str, $start, $length, $charset);
  } else {
    $re["utf-8"]  = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re["gb2312"] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re["gbk"]     = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re["big5"]     = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    if(count($match[0]) <= $length) return $str;
    $slice = join("",array_slice($match[0], $start, $length));
  }
  if($suffix) return $slice."...";
  return $slice;
}

/*-------------------------------------------------------------------------------------------
 计算混合字符串的长度
 @param   string      $str        字符串
 @return  int
--------------------------------------------------------------------------------------------*/
function cstrlen($str) {
  if( empty($str) ) return 0;
  return (strlen($str) + mb_strlen($str, 'UTF8'))/2;
}


//转换HTML字符
function HTMLEncode($str){
  $str=str_replace("<","&lt;",$str);
  $str=str_replace(">","&gt;",$str);
  $str=str_replace(chr(34),"&quto;",$str);
  $str=str_replace(chr(39),"&#39;",$str);
  $str=str_replace(chr(13),"",$str);
  $str=str_replace(chr(10),"&lt;br /&gt;",$str);
  $str=preg_replace('/ +/', " ", $str);
  return $str;
}

//清除HTML特殊字符
function stripTSZF($str){
  $str = str_replace('&lt;','',$str);
  $str = str_replace('&gt;','',$str);
  $str = str_replace('&nbsp;','',$str);
  $str = str_replace('&quto;','',$str);
  $str = str_replace('&#39;','',$str);
  $str = str_replace('&ldquo;','',$str);
  $str = str_replace('&rdquo;','',$str);
  return $str;
}


//清除所有标点符号和脑残符号
function strip_puns($str) {
	$puns = array(",", ".", "_", "+", "\\", "/", "|", ";", "\"", "!", "?", "%", "^", "(", ")", "?", "-", "=", "<", ">",
								"$", "&", "#", "@", "{", "}", "[", "]", "~", "*", "`", //单字节结束
								"　", "：", "（", "）", "．", "。", "，", "？", "‘", "’", "、", "—", "…", "★", "☆", "◆", "█",
								"◢", "◣", "♀", "※", "□", "◇", "〓", "◥", "◤", "●", "▲", "；", "！", "の", "㊣", //单符号结束
								"『", "』", "「", "」", "【", "】", "〖", "〗", "《", "》", "“", "”", "［", "］",
								);
	foreach($puns as $pun) {
		$str = cstr_replace($pun, ' ', $str);
	}
  return trim($str);
}


/*-------------------------------------------------------------------------------------------
 格式化中文星期
 @param   string      $format     日期的格式化形式
 @param   timestamp   $time       时间戳
 @return  string
--------------------------------------------------------------------------------------------*/
function cdate($format, $time = null) {
  if(empty($time)) $time = $_SERVER['REQUEST_TIME'];
  $date = date($format, $time);
  $arr1 = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
  $arr2 = array("星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日");
	$date = str_replace($arr1, $arr2, $date);
	return $date;
}


/*-------------------------------------------------------------------------------------------
 恶心的中文乱码字符替换
 @param   string   $needle   做替换的字符
 @param   string   $str      被替换的字符串
 @return  string
--------------------------------------------------------------------------------------------*/
function cstr_replace($needle, $str, $haystack, $charset = 'utf-8') {
  if(strlen($needle) == 0 || strlen($haystack) == 0) return $haystack;
	$re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
	$re['gb2312']  = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
	$re['gbk']     = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
	$re['big5']    = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";

	preg_match_all($re[$charset], $haystack, $match_haystack);
	preg_match_all($re[$charset], $needle, $match_needle);

	for($i=0; $i<count($match_needle); $i++) {
		if(!in_array($match_needle[0][$i], $match_haystack[0])) return $haystack; //无匹配
	}

	$match_haystack = $match_haystack[0];
	$match_needle = $match_needle[0];
	for($i=0; $i<count($match_haystack); $i++){
		if($match_haystack[$i] == '') continue;
		if($match_haystack[$i] == $match_needle[0]) {
			if(count($match_needle) == 1) { //如果只一个字符
				$match_haystack[$i] = $str;
			} else {
				$flag = true;
				for($j = 1; $j < count($match_needle); $j ++) {
					if(!isset($match_haystack[$i + $j]) || $match_haystack[$i + $j] != $match_needle[$j]) {
						$flag = false;
						break;
					}

				}
				if($flag) {//匹配
					$match_haystack[$i] = $str;
					for($j=1; $j<count($match_needle); $j++){
						$match_haystack[$i+$j] = '';
					}
				}
			}
		}
	}
	return implode('', $match_haystack);
}

/*-------------------------------------------------------------------------------------------
 转换字符编码
 @param   string   $str   要转换的字符串
 @return  string
--------------------------------------------------------------------------------------------*/
function to_gbk($str) {
	return iconv('utf-8', 'gbk', $str);
}
function to_utf8($str) {
	return iconv('gbk', 'utf-8', $str);
}
function url_to_utf8($str) { //转换字符编码为UTF-8的网址
	$str = urlencode(iconv('gbk', 'utf-8', $str));
	return $str;
}

/*-------------------------------------------------------------------------------------------
 对象转数组(XML)
 @param   object||xml   $object   要转换的对象
 @return  array
--------------------------------------------------------------------------------------------*/
function to_array($arr, $type = NULL) {
  if($type == 'xml') $arr = (array)simplexml_load_string($arr, NULL, LIBXML_NOCDATA);
  else               $arr = (array)$arr;
  foreach ($arr as $key => $val) {
    if(is_object($val) || is_array($val)) {
      $arr[$key] = to_array($val);
    }
  }
  return $arr;
}

/*-------------------------------------------------------------------------------------------
 字节格式化 把字节数格式为 B K M G T 描述的大小
 @param   string   $size   要转换的字节字符串
 @return  string
--------------------------------------------------------------------------------------------*/
function byte_format($size, $dec = 2){
	$a = array("B", "KB", "MB", "GB", "TB", "PB");
	$pos = 0;
	while($size >= 1024) {
		$size /= 1024;
		$pos++;
	}
	return round($size, $dec)." ".$a[$pos];
}

/*-------------------------------------------------------------------------------------------
 检查字符串是否是UTF8编码
 @param   string   $string   要检查的字符串
 @return  boolean
--------------------------------------------------------------------------------------------*/
function is_utf8($string) {
}

//保留中文的json_encode
function cjson_encode($a = false) {
  if(is_null($a)) return 'null';
  if($a === false) return 'false';
  if($a === true) return 'true';
  if(is_scalar($a)) {
    if(is_float($a)) {
      // Always use "." for floats.
      return floatval(str_replace(",", ".", strval($a)));
    }
    if(is_string($a)) {
      static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
      return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
    } else
      return $a;
  }
  $isList = true;
  for($i = 0, reset($a); $i < count($a); $i++, next($a)) {
    if(key($a) !== $i) {
      $isList = false;
      break;
    }
  }
  $result = array();
  if($isList) {
    foreach ($a as $v) $result[] = cjson_encode($v);
    return '[' . join(',', $result) . ']';
  } else {
    foreach ($a as $k => $v) $result[] = cjson_encode($k).':'.cjson_encode($v);
    return '{' . join(',', $result) . '}';
  }
}

/*-------------------------------------------------------------------------------------------
 检测函数支持
 @param   string  函数名
 @return  bool
--------------------------------------------------------------------------------------------*/
function is_func($funName) {
	$bool = (false !== function_exists($funName)) ? 'yes' : 'no';
  return $bool;
}

/*-------------------------------------------------------------------------------------------
 IP是否为本地
 @param     string     IP地址，可通过get_client_ip()获取
 @return    bool
------------------------------------------------------------------------------------------------------------*/
function is_local($ip) {
	if(empty($ip)) exit('主机IP为空！');
  if(preg_match("/^127/", $ip))
		return true;
	elseif(preg_match("/^192/", $ip))
		return true;
	else
		return false;
}


/*-----------------------------------------------------------------------------------------------------------
 获取客户端IP
 @return  string
------------------------------------------------------------------------------------------------------------*/
function get_client_ip() {
	if(isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	elseif(isset($_SERVER["HTTP_CLIENT_IP"]))
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	else
		$ip = $_SERVER["REMOTE_ADDR"];
	return $ip;
}

/*-------------------------------------------------------------------------------------------
 获取网站域名地址
 @return  string
--------------------------------------------------------------------------------------------*/
function get_host() {
	$url = 'http://'.preg_replace("/\:\d+/", '', $_SERVER['HTTP_HOST']).($_SERVER['SERVER_PORT'] && $_SERVER['SERVER_PORT'] != 80 ? ':'.$_SERVER['SERVER_PORT'] : '');
	return $url.'/';
}

/*-----------------------------------------------------------------------------------------------------------
 获取根域名
 @param     string     网址
 @return    string
------------------------------------------------------------------------------------------------------------*/
function get_domain($url) {
  $url = $url ? $url : get_host();
	$url = str_replace('http://', '', $url);
	$url = str_replace('https://', '', $url); //先去掉前缀
	$pos = strpos($url, '/');
	if($pos !== false) $url = substr($url, 0, $pos);
	if(preg_match("/:/", $url)) {
		$url = explode(':', $url);
		$url = $url[0];
	}
  if(preg_match("/^127/", $url))
		return $url;
	elseif(preg_match("/^192/", $url))
		return $url;
	elseif(preg_match("/^10/", $url))
		return $url;
	elseif(preg_match("/^localhost$/", $url))
		return $url;
	elseif(preg_match("/^d$/", $url))
		return $url;
	else {
		$url = preg_match("/([a-zA-Z0-9]{2,16}\.(com(\.cn)?|net|cn))/", $url, $m);
		return $m[0];
	}
}

/*-----------------------------------------------------------------------------------------------------------
 获取邮箱域名
 @param     string     邮箱
 @return    string
------------------------------------------------------------------------------------------------------------*/
function get_email_domain($email) {
  $is_valid = valid_email($email);
  if(!$is_valid) exit('邮箱不合法');
  $tmp = explode('@', $email);
  return $tmp[1];
}

/*-----------------------------------------------------------------------------------------------------------
 获取当前请求网址
 @param     string     网址
 @return    string
------------------------------------------------------------------------------------------------------------*/
function get_url() {
  $host = substr(get_host(), 0, strlen( get_host() )-1);
  if(!empty($_SERVER["REQUEST_URI"])) {
    $request = $_SERVER["REQUEST_URI"];
  } else {
    $request = empty($_SERVER["QUERY_STRING"]) ? $_SERVER["PHP_SELF"] : $_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"];
  }
  return $host.$request;
}

/*-------------------------------------------------------------------------------------------
 取得当前UNIX时间戳
 @return  int(10位数时间戳)
------------------------------------------------------------------------------------------------------------*/
function get_timestamp($str = '') {
	if(!$str) return time();
	return strtotime($str);
  $time = explode(" ", microtime());
  $sec = $time[1];
  if($type != 'default') {
    $usec = $time[0];
    return (int)($sec + $usec);
  } else {
    return (int)$sec;
  }
}

/**
 * 获取指定日期对应星座
 *
 * @param integer $month 月份 1-12
 * @param integer $day 日期 1-31
 * @return boolean|string
 */
function get_constellation($month, $day) {
  $day   = intval($day);
  $month = intval($month);
  if ($month < 1 || $month > 12 || $day < 1 || $day > 31) return false;
  $signs = array(
    array('20' => '水瓶座'),
    array('19' => '双鱼座'),
    array('21' => '白羊座'),
    array('20' => '金牛座'),
    array('21' => '双子座'),
    array('22' => '巨蟹座'),
    array('23' => '狮子座'),
    array('23' => '处女座'),
    array('23' => '天秤座'),
    array('24' => '天蝎座'),
    array('22' => '射手座'),
    array('22' => '摩羯座')
  );
  list($start, $name) = each($signs[$month-1]);
  if($day < $start)
    list($start, $name) = each($signs[($month-2 < 0) ? 11 : $month-2]);
  return $name;
}
//获取友好的时间 例： 刚刚 、 前天 16:23
function get_date($timestamp) {
  $timestamp = (int)$timestamp;
  $today_first = strtotime("today");
  $yesterday_first = strtotime("yesterday");
  $this_year_first = strtotime(date("Y")."-01-01 00:00:00"); //今年
  $now = get_timestamp();
  if($now-$timestamp < 60) return '刚刚';
  if($now-$timestamp < 3600) return floor( ($now-$timestamp)/60 ).'分钟前';
  if($now-$timestamp < 28800) return floor( ($now-$timestamp)/3600 ).'小时前';
  if( $timestamp > $today_first && ($now-$timestamp) < 86400 ) return date("H:i", $timestamp); //'今天 '.
  if($timestamp > $yesterday_first) return '昨天 '.date("H:i", $timestamp);
  #if($timestamp > $this_year_first) return date("n月j日 H:i", $timestamp);
  #if($timestamp > $this_year_first-31536000) return date("去年n月j日 H:i", $timestamp);
  #if($timestamp > $this_year_first-31536000-31536000) return date("前年n月j日 H:i", $timestamp);
  return date("Y-m-d", $timestamp);
}
function get_last_date($timestamp) {
  $timestamp = (int)$timestamp;
  $today_first = strtotime("today");
  $yesterday_first = strtotime("yesterday");
  $this_year_first = strtotime(date("Y")."-01-01 00:00:00"); //今年
  $now = get_timestamp();
  if($now-$timestamp < 60) return '刚刚';
  if($now-$timestamp < 3600) return floor( ($now-$timestamp)/60 ).'分钟前';
  if($now-$timestamp < 10800) return floor( ($now-$timestamp)/3600 ).'小时前';
  if( $timestamp > $today_first && ($now-$timestamp) < 86400 ) return date("H:i", $timestamp); //'今天 '.
  if($timestamp > $yesterday_first) return '昨天 '.date("H:i", $timestamp);
  $days = floor( ($now-$timestamp)/86400 ) > 30 ? 30 : floor( ($now-$timestamp)/86400 );
  if($timestamp > $this_year_first) return $days.'天前';
  return date("Y-m-d", $timestamp);
}

//某个时间是不是夜里  晚上23:30至早上7:30算是夜里
function is_night($timestamp) {
  $hi = (int)date("Hi", $timestamp);
  if($hi >= 2330 || $hi <= 730) return true;
  return false;
}

//获取大约的数字
function get_approximate($num) {
  if($num < 100) return '&lt;100';
  if($num < 1000) return '&gt;100';
  if($num < 10000) return '&gt;1000';
  if($num < 100000) return '&gt;10000';
  return '&gt;100000';
}

/*-------------------------------------------------------------------------------------------
 获取图片二进制数据
 @param     string     路径
 @return    bool
------------------------------------------------------------------------------------------------------------*/
function get_pic_data($path) {
	$size = filesize($path);
  $data = fread(fopen($path, "r"), $size);
  return $data;
}


//合法IP地址
function valid_ip($ip) {
  if(preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", $ip)) return true;
  return false;
}

//合法邮箱
function valid_email($email) {
  if(preg_match("/([a-z0-9]*[-_\.]?[a-z0-9]+)@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i", $email))
    return true;
  return false;
}

//获取QQ邮箱地址
function get_qq_email($email) {
  if( (int)$email > 10000 && (int)$email < 200000000000 ) { //合法QQ
    $email = (int)$email.'@qq.com';
  }
  return $email;
}

//保护邮箱地址
function get_security_email($email) {
  $email = explode('@', $email);
  return substr($email[0], 0, 2).'***'.substr($email[0], strlen($email[0])-1, 1).'@'.$email[1];
}

//获取邮箱网站地址
function get_email_site($email) {
  $site = explode('@', $email);
  $site = 'http://'.( $site[1] == 'gmail.com' ? 'mail.google.com' : 'mail.'.$site[1] );
  return $site;
}


/*-------------------------------------------------------------------------------------------
 去除符号的base64加解密
 @param   string   $str   要转化的字符串
 @return  string
--------------------------------------------------------------------------------------------*/
function base64en($str) {
	$str = base64_encode($str);
	$str = str_replace('=', 'Xb4d', $str);
	$str = str_replace('+', 'Wi3j', $str);
	$str = str_replace('/', 'C7uB', $str);
	return $str;
}
function base64de($str) {
	$str = str_replace('C7uB', '/', $str);
	$str = str_replace('Wi3j', '+', $str);
	$str = str_replace('Xb4d', '=', $str);
	$str = base64_decode($str);
	return $str;
}

/*-------------------------------------------------------------------------------------------
 七牛使用的base64加解密
 @param   string   $str   要转化的字符串
 @return  string
--------------------------------------------------------------------------------------------*/
function qiniu_base64_encode($str) {
	$str = base64_encode($str);
	$str = str_replace('+', '-', $str);
	$str = str_replace('/', '_', $str);
	return $str;
}


/*-------------------------------------------------------------------------------------------
 10进制与62进制互转
 @return  value
------------------------------------------------------------------------------------------------------------*/
function dec2hex($num) {
  if(!is_numeric($num)) exit('dec2hex: 必须填入整数');
  $dict = 'Cz5Za3Bx1Ub4Dw0Ec2Fu9Sd7Gv6Xe8KfAyVgHsWhIrJiLqRjMpNlOtTmPoYnQk';
  $ret = '';
  do {
    $ret = $dict[bcmod($num, 62)] . $ret;
    $num = (int)bcdiv($num, 62);
  } while ($num > 0);
  return $ret;
}
function hex2dec($string) {
  if(!$string) exit('hex2dec: 必须填入字符串');
  $string = strval($string);
  $dict = 'Cz5Za3Bx1Ub4Dw0Ec2Fu9Sd7Gv6Xe8KfAyVgHsWhIrJiLqRjMpNlOtTmPoYnQk';
  $len = strlen($string);
  $dec = 0;
  for($i = 0; $i < $len; $i++) {
    $pos = strpos($dict, $string[$i]);
    $dec = bcadd(bcmul(bcpow(62, $len - $i - 1), $pos), $dec);
  }
  return (int)$dec;
}

//清除emoji表情
function remove_emoji($text) {
	$clean_text = "";
	// Match Emoticons
	$regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
	$clean_text = preg_replace($regexEmoticons, '', $text);
	// Match Miscellaneous Symbols and Pictographs
	$regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
	$clean_text = preg_replace($regexSymbols, '', $clean_text);
	// Match Transport And Map Symbols
	$regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
	$clean_text = preg_replace($regexTransport, '', $clean_text);
	// Match Miscellaneous Symbols
	$regexMisc = '/[\x{2600}-\x{26FF}]/u';
	$clean_text = preg_replace($regexMisc, '', $clean_text);
	// Match Dingbats
	$regexDingbats = '/[\x{2700}-\x{27BF}]/u';
	$clean_text = preg_replace($regexDingbats, '', $clean_text);
	return $clean_text;
}


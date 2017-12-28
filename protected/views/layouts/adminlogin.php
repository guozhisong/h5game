<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>登录</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/cac_style/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/cac_style/default.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/cac_style/login.css">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/jquery-1.7.2.min.js"></script> 
<script type="text/javascript">
$(function() {
$(document.body).css({backgroundSize: "cover"});
});
</script>
</head>
<!-- 登录页面 -->
<body class="login_bg">
	<div id="login">
		<h1 class="login_tit">
			<em></em>
			<p class="clearfix">
			<span class="logo">
				
			</span> 
			</p>
		</h1> 
	<?php echo $content; ?>
	</div>
	<div id="footer" class="login_footer clearfix">
		<div class="w980 clearfix">
		<span class="fl">©2016 游戏后台. All rights reserved. </span> 
	  </div>
</div>
</body>
</html> 
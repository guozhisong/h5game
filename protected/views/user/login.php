<header class="head clearfix">
<a href="javascript:history.go(-1);" class="back"></a> 			
<span><?= $_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈' ?>用户登录</span>
<a href="<?php echo $this->createUrl('user/register'); ?>" class="modify_paw">注册</a>
</header>
<form id="frmLogin" method="post" action='<?php echo $this->createUrl('user/login'); ?>'>
    <!--用户登录-->
    <div class="public clearfix">
        <ul class="input_box">
            <li style="border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(229, 229, 229);">
            <span>帐&nbsp;&nbsp;号：</span>
            <input type="text" class="input01" id="mobile" name="user_login" placeholder="请输入账号/手机号码" value="" style="color: rgb(72, 81, 92);"></li>
            <li>
            <span>密&nbsp;&nbsp;码：</span>
            <input type="password" id="passwd" value="" name="user_pass" class="input01" placeholder="输入密码"></li>
        </ul>
    </div> 
    <p class="forget" <?php if($error=='') { ?>style='display: none;'<?php } ?>>
        <span class="tishi"><?php echo $error; ?></span>
    </p>
    <p class="forget">
        <a href="#">忘记密码？</a><span class="tishi" style="display: none;"></span>
    </p>
    <p class="button_login">
        <a href="#" onclick="checkForm()">登录</a>
    </p>
</form>
<script type="text/javascript"> 
    function checkForm() {
        	document.getElementById('frmLogin').submit();
    } 
</script> 
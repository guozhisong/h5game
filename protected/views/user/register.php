<header class="head clearfix"> 
				<a href="javascript:history.go(-1);" class="back"></a> 			
			            <span><?= $_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈' ?>用户注册</span>
            <a href="<?php echo $this->createUrl('user/login'); ?>" class="modify_paw">登录</a>        </header>
<form id="frmReg" method="post" action='<?php echo $this->createUrl('user/register'); ?>'>
    <input type="hidden" id="sex" name="user_sex" value="1">
    <div class="public clearfix">
        <ul class="input_box">
            <li><span style=" width: 60px;">帐&nbsp;&nbsp;号：</span><input type="text" class="input01"
                                        placeholder="请输入至少6位字母或数字" id="mobile" name="user_login" value="" ></li>
            
            <li><span style=" width: 60px;">密&nbsp;&nbsp;码：</span><input type="password"
                                                   class="input01" placeholder="请输入6-15位字母或数字" id="passwd"
                                                   name="user_pass"  value=""></li>
        </ul>
    </div>
    <p class="forget" <?php if($error=='') { ?>style='display: none;'<?php } ?>>
        <span class="tishi"><?php echo $error; ?></span>
    </p>
    <p class="agree">
        <span class="checkbox checkboxed"></span><span class="tiaokuan">同意<a href="<?php echo $this->createUrl('user/xy'); ?>">《用户服务协议》</a></span>
    </p>
    <table cellpadding="0" cellspacing="10" class="button_register">
        <tr>
            <td><a href="#" onclick="register(1);" class="man_register">男生注册</a></td>
            <td><a href="#" onclick="register(2);" class="woman_register">女生注册</a></td>
        </tr>
    </table>
</form>    
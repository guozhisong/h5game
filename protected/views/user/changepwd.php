<header class="head clearfix"> 
<a href="javascript:history.go(-1);" class="back"></a> 			
<span>修改密码</span>
</header>

<div class="tishi_box">
    <div class="title">
        操作提示<em class="close"></em>
    </div>
    <p>修改成功</p>
    <a href="<?php echo $this->createUrl('user/index'); ?>" style=" width: 100%;" onclick="location.href = 'index';"  class="sure2">确定</a>
</div>
<!--用户登录-->
<form id="frmChangePwd" method="post" action='<?php echo $this->createUrl('user/changepwd'); ?>'>
    <div class="public clearfix">
        <ul class="input_box">
            <li><span>原密码：</span><input type="password" class="input01"
                                        placeholder="请输入原密码" id="pwd1" name="pwd1"></li>
            <li><span>新密码：</span><input type="password" class="input01"
                                        placeholder="请输入新密码" id="pwd2" name="pwd2"></li>
            <li><span>确认密码：</span><input type="password" class="input01"
                                         placeholder="请确认新密码" id="pwd3" name="pwd3"></li>
        </ul>
    </div>
    <p class="forget">
        <span class="tishi"><?php echo $message; ?></span>
    </p>
    <p class="button_login">
        <a href="#" onclick="submitform()">确定修改</a>
    </p>

</form>
<script type="text/javascript">

    function submitform() {
        if ($("#pwd1").val() == "")
            $(".tishi").text("请输入原密码!");
        else if ($("#pwd2").val() == "")
            $(".tishi").text("请输入新密码!");
        else if ($("#pwd3").val() == "")
            $(".tishi").text("请确认新密码!");
        else if ($("#pwd2").val() != $("#pwd3").val())
            $(".tishi").text("两次新密码不一致!");
        else
            javascript:document.getElementById('frmChangePwd').submit();
        $(".forget").show();
        return false;

    }

    $(document).ready(function () {
        if ($(".tishi").text() == "更新成功")
        {
            $(".opacity_bg").show();
            $(".tishi_box").show();
        }
        if ($(".tishi").text() == "")
            $(".forget").hide();
    });
</script>   
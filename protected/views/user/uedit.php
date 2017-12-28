<header class="head clearfix">
<a href="javascript:history.go(-1);" class="back"></a> 			
<span>编辑资料</span>
</header>
                    
                    
<script src="/static/jquery.form.js" ></script>
<script src="/static/commmon.js" ></script>
<script type="text/javascript">
    var lvMsg = "";
    if (lvMsg != "")
    {
        $(".forget").show();
        $(".tishi").text("昵称最多为8个汉字！");
    }
    $(function () {
        //var bar = $('.bar');
        var percent = $('.percent');
        var showimg = $('#showimg');
        var progress = $(".progress");
        var files = $(".files");
        var btn = $(".btn span");
        $("#head_img").wrap("<form id='myupload' action='<?php echo $this->createUrl('user/photo'); ?>' method='post' enctype='multipart/form-data'></form>");
        $("#head_img").change(function () {
            $("#myupload").ajaxSubmit({
                dataType: 'json',
                beforeSend: function () {
                    showimg.empty();
                    progress.show();
                    var percentVal = '0%';
                    percent.html(percentVal);
                    btn.html("上传中...");
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                   // bar.width(percentVal);
                    percent.html("上传进度："+percentVal);
                },
                success: function (data) {
                    if (data.status == "success") {
                        var img = data.photo;
                        showimg.attr("src", img);
                    }
                    else
                    {
						alert("上传失败");
                    }
                },
                error: function (xhr) {
					alert("上传失败"); 
                }
            });
        });

        $(".delimg").live('click', function () {
            var pic = $(this).attr("rel");
            $.post("action.php?act=delimg", {imagename: pic}, function (msg) {
                if (msg == 1) {
                    files.html("删除成功.");
                    showimg.empty();
                    progress.hide();
                } else {
                    alert(msg);
                }
            });
        });
    });

</script>
<!--删除游戏弹窗-->
<div class="opacity_bg"></div>
<!--删除游戏弹窗“取消”“确定”2个按钮的-->
<div class="tishi_box">
    <div class="title">
        操作提示<em class="close"></em>
    </div>
            <p class="percent">0%</p>
    <a href="javascript:void(0);" style=" width: 100%;" onclick="location.href = 'index';" class="sure2">确定</a>
</div>
<!--编辑资料（头像背景有分男女,man_bg,woman_bg）-->
<form id="frmInfo" method="post" enctype="multipart/form-data" action='<?php echo $this->createUrl('user/uedit'); ?>'>
    <input type="hidden" id="sex" name="user_sex" value="<?php echo $user->user_sex; ?>" />
    <div class="user_bg man_bg">
        <p class="pic">
            <img id="showimg" src="<?php echo empty($user->photo) ? "/img/default_pic.png" : $user->photo; ?>">
        </p>
        <p class="text">点击头像修改</p>
        <input type="file" id="head_img" name="head_img" multiple class="file">
    </div>
    <div class="uid2">UID：<?php echo $user->id; ?></div>
    <div class="public">
        <ul class="input_box2">
            <li><span>昵称：</span><input type="text" class="input03" id="nickname" name="user_nicename" value="<?php echo $user->user_nicename; ?>"></li>
            <li><span>性别：</span>
                <p class="sex">
                    <span class="man <?php if($user->user_sex == 1){echo 'on1';} ?>"><em>男</em></span>
                    <span class="woman <?php if($user->user_sex == 2){echo 'on2';} ?>"><em>女</em></span>
                </p></li>
            <li><span>手机：</span><input type="text" class="input03" name='user_phone' value="<?php echo  $user->user_phone; ?>" ></li>
            <li><span>QQ：</span><input type="text" class="input03" id="qq" name="user_qq" value="<?php echo  $user->user_qq; ?>"></li>
            <li><span>邮箱：</span><input type="text" class="input03" id="email" name="user_email" value="<?php echo  $user->user_email; ?>"></li>
            <li><span>最后登录：</span> <em class="time"><?php echo $user->user_lastlogin; ?></em></li>
            <li><span>注册时间：</span> <em class="time"><?php echo $user->user_registered; ?></em></li>
        </ul>
    </div>
    <p class="forget">
        <span class="tishi"></span>
    </p>
    <p class="button_login">
        <a href="#" onclick="javascript:check();">确认修改</a>
    </p>
</form>
<script type="text/javascript">
    function check()
    {
        $(".forget").show();
        var lvUtil = new Common();
        var lvNickName = $("#nickname").val();
        var lvMail = $("#email").val();
        var lvQQ = $("#qq").val();
        if ($.trim(lvNickName) == "")
            $(".tishi").text("昵称不能为空！");
        else if (lvNickName.length <2)
            $(".tishi").text("昵称最少为2个汉字以上(可用字母或数字)！");
        else if (lvNickName.length > 8)
            $(".tishi").text("昵称最多为8个汉字！");
        else if (lvQQ.length > 20 || isNaN(lvQQ))
            $(".tishi").text("QQ号码最多为20位数字！");
        else if (lvMail.length > 30)
            $(".tishi").text("邮箱地址最多为30个字符！");
        else if (lvMail != "" && !lvUtil.checkMail(lvMail))
            $(".tishi").text("请输入正确的邮箱地址");
        else
            $("#frmInfo").submit();
    }
    $(document).ready(function () {
        if ($(".tishi").text() == "")
            $(".forget").hide();
    });
</script>
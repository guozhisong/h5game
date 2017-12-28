<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="keywords" content="<?php echo $this->keywords; ?>">
    <meta name="description" content="<?php echo $this->description; ?>">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <?php if( 'index' == $this->id) {?>
    <base href='/' />
    <?php } ?>
    <?php  if($this->logincss){ ?>
    <link rel="stylesheet" type="text/css" href="/static/login.css">
    <?php }else{ ?>
    <link rel="stylesheet" type="text/css" href="/static/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="/static/style.css">
    <?php } ?>
    <script type="text/javascript" src="/static/jquery.min.js"></script>
    <script type="text/javascript" src="/static/function.js"></script>
    <meta name="baidu-tc-verification" content="065cdc915a76e1bde00f9e0fea37aa06" />
    <meta name="baidu-site-verification" content="NjjGiBpsse" />
</head>
<?php  if($this->logincss){ ?>
<body>
<?php } else { ?>
<body class=" hPC" style="padding-bottom: 45px;">
<script type="text/javascript">
setTimeout("$('#show_search_u_di').show()",3000);
</script>
<header class="head clearfix">
    <div class="logo">
      <a href="/">
        <img src="static/logo_<?= $_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91yxq' ?>.png" alt="<?= $_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈' ?>游戏" title="<?= $_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈' ?>游戏">
      </a>
    </div>
    <div class="search" style="float: left; margin-left: 10px; margin-right: 0px; width: 482px;">
        <form id="search_form_id" action="/search/" onsubmit="return searchnamesend()">
            <input class="search_tx ui-autocomplete-input" placeholder="请输入游戏名称" id="keyword" type="text" name="keyword" autocomplete="off"
            value="<?php if (isset($_GET['keyword'])){echo $_GET['keyword'];} ?>"
            style="width: 390px;">
            <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
            <input id="show_search_u_di" type="submit" class="search_bt" value="" style="">
        </form>
    </div>
    <div style="float:left;width:30px; height:35px; position:relative;">
        <a id="head_user_login" href="<?php echo $this->createUrl('user/index'); ?>" style="margin-right:4px; width:35px; height:35px; display:block;background:url(img/ico_13.png) no-repeat center center; background-size:20px 20px;"></a>

    </div>
</header><!--导航-->
<nav>
     <ul class="main_nav clearfix">
            <li style="width:17%;" <?php if('index' == $this->id && 'index'== $this->action->id){ echo 'class="hover"' ;}?> ><a href="/" title="手机游戏">首页</a></li>
            <li style="width:16%;"<?php if('index' == $this->id && 'zixun'== $this->action->id){ echo 'class="hover"' ;}?>><a href="/news/" title="h5游戏资讯">资讯</a></li>
            <li  style="width:17%;"<?php if('index' == $this->id && 'list'== $this->action->id){ echo 'class="hover"' ;}?>><a href="/wangyou/" title="手机页游">网游</a></li>
            <li style="width:16%;"<?php if('index' == $this->id && 'danji'== $this->action->id){ echo 'class="hover"' ;}?>><a href="/danji/" title="单机">单机</a></li>
            <li style="width:17%;"<?php if('index' == $this->id && 'libao'== $this->action->id){ echo 'class="hover"' ;}?>><a href="/libao/" title="游戏礼包">礼包</a></li>
            <li style="width:17%;"<?php if('index' == $this->id && ('games'== $this->action->id || 'gamesfl'== $this->action->id)){ echo 'class="hover"' ;}?>><a href="/games/" title="h5游戏大全">游戏库</a></li>
    </ul>
</nav>
<?php } ?>
<?php echo $content; ?>
<!--底部导航-->
   <nav class="bottom_nav">
       <ul>
            <li style="width:17%;"  ><a href="/" title="手机游戏">首页</a></li>
            <li style="width:16%;"><a href="/news/" title="h5游戏资讯">资讯</a></li>
            <li  style="width:17%;"><a href="/wangyou/" title="手机页游">网游</a></li>
            <li style="width:16%;"><a href="/danji/" title="单机">单机</a></li>
            <li style="width:17%;"><a href="/libao/" title="游戏礼包">礼包</a></li>
            <li style="width:17%;"><a href="/games/" title="h5游戏大全">游戏库</a></li>
       </ul>
   </nav>

   <!--底部-->

   <footer class="footer">
		<div style="clear: both;"></div>
		<p><img src="/img/qr_<?= $_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91yxq' ?>.png" style='width: 150px;' /> 微信扫一扫，关注我们手机上玩</p>
		<?php if('index' == $this->id && 'index'== $this->action->id){ ?>
        <?php if ($_SERVER['HTTP_HOST'] == 'www.81900.com'): ?>
        友情链接：
        <a href="http://www.xyou.cn/" bdsfid="315">在线游戏</a>
        <a href="http://www.81900.com/games/" bdsfid="316">手机网页游戏</a>
        <a href="http://www.h5god.com" target="_blank" bdsfid="317">H5天堂</a>
        <a href="http://www.8868.cn/shouchong/" target="_blank" bdsfid="318">首充号</a>
        <a href="http://heroesmf.pk38.com/" target="_blank" bdsfid="319">风暴英雄美服</a>
        <a href="http://www.jiefangbei.com/" target="_blank" bdsfid="320">7k7k小游戏大全</a>
        </p><div bdsfid="321">
            <a href="http://www.4q5q.com" target="_blank" bdsfid="322">4q5q游戏网</a>
            <a href="http://www.keyouxi.com" target="_blank" bdsfid="323">可游戏网</a>
            <a href="http://www.82down.com" target="_blank" bdsfid="324">安卓手游</a>
            <a href="http://aiwanyouxi.1happy.com/" target="_blank" bdsfid="325">最新网页游戏</a>
            <a href="http://www.51h5.com" target="_blank" bdsfid="326">火舞游戏</a>
            <a href="http://www.youxigonglue8.com/" target="_blank" bdsfid="327">手机游戏攻略</a>
            <a href="http://www.laiyouxi.com" target="_blank" bdsfid="328">棋牌游戏平台</a>
        </div>
        <div bdsfid="329">
            <a href="http://www.9game.cn/cr/" target="_blank" bdsfid="330">皇室战争</a>
            <a href="http://www.h5151.com/" target="_blank" bdsfid="331">h5游戏</a>
            <a href="http://www.7724.com" target="_blank" bdsfid="332">7724游戏</a>
            <a href="http://0123366.com" target="_blank" bdsfid="333">美女小游戏</a>
            <a href="http://www.6637.com" target="_blank" bdsfid="334">6637网页游戏</a>
            <a href="http://www.88130.cn" target="_blank" bdsfid="335">变态版手游</a>
            <a href="http://www.h5kaifu.cn/" target="_blank" bdsfid="336">H5游戏开服表</a>
        </div>
        <div bdsfid="337">
            <a href="http://h5.gamedog.cn/" target="_blank" bdsfid="338">h5游戏</a>
            <a href="http://www.2217.com" target="_blank" bdsfid="339">2217游戏平台</a>
            <a href="http://www.shouyoudao.com" target="_blank" bdsfid="340">安卓模拟器</a>
            <a href="http://www.91yxq.com" target="_blank" bdsfid="341">网页游戏大全</a>
            <a href="http://52funs.com" target="_blank" bdsfid="342">小游戏大全</a>
            <a href="http://www.anzhuo.com" target="_blank" bdsfid="343">安卓网</a>
            <a href="http://www.7751.com" target="_blank" bdsfid="344">手机单机排行榜</a>
        </div><p bdsfid="345"></p>
        <?php else: ?>
        <p>友情链接：<?php echo $this->youqing; ?></p>
        <?php endif; ?>

<p>游戏作品版权归所有者持有，如有版权问题，请按《版权保护投诉指引》告知，本网站将尽快处理。</p>
<p><?= $_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈' ?>游戏平台为玩家提供手机网页游戏（H5游戏、微信游戏）和手机小游戏（手机页游、手机微游戏）</p>
<p>包含：h5游戏大全、最新h5游戏、好玩的h5游戏、全部在线游戏小游戏和h5网游等即点即玩，不用下载。</p>

		<p>玩家交流群： <?= $_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈' ?>游戏( 489398606 )</p>
			<p>
            <?= $_SERVER['HTTP_HOST']=='www.81900.com'?
            '苏ICP备15059878号-1'
            :
            '<p>南京魔苹网络科技有限公司版权所有 ©2014-2017</p>
<p><a href="http://www.miitbeian.gov.cn/" target="_blank">苏ICP备14015522号-1</a>&nbsp;&nbsp;<a href="http://7xpfbb.com1.z0.glb.clouddn.com/b2.pdf" target="_blank">增值电信业务经营许可证苏B2-20140248</a>&nbsp;&nbsp;<a href="http://7xpfbb.com1.z0.glb.clouddn.com/wangwen.pdf" target="_blank">苏网文(2016)1086-026号</a></p>
<p class="copy"><a href="http://www.91yxq.com/doc/aboutus.html" target="_blank">关于我们</a><a href="http://www.91yxq.com/doc/contactus.html" target="_blank">联系我们</a><a href="http://www.91yxq.com/doc/cooperation.html" target="_blank">商务合作</a><a href="http://www.91yxq.com/fcm/" target="_blank">家长监护</a><a href="http://www.91yxq.com/doc/jfcl.html" target="_blank">纠纷处理</a><a href="http://www.91yxq.com/doc/fcm.html" target="_blank">防沉迷</a></p>
<p>抵制不良游戏，拒绝盗版游戏。注意自我保护，谨防受骗上当。适度游戏益脑，沉迷游戏伤身。合理安排时间，享受健康生活。</p>'
            ?>
			</p><?php } ?>
	</footer>

<div class="qr_code_pc">
    <img id="js_pc_qr_code_img" class="qr_code_pc_img" src="/img/qr_<?= $_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91yxq' ?>.png">
    <p>微信扫一扫<br>
关注该公众号<br>
  手机上玩</p>
</div>
<?php if ($_SERVER['HTTP_HOST'] == 'www.81900.com'): ?>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?dc89ffb77c4d7c0c30d9b07c66eb7dea";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
<?php else: ?>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?40cc83b2c75ab78bd5ab3cd4706a963e";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
<?php endif; ?>
<style>
.qr_code_pc {
    position: fixed;
    right: 20px;
    top: 20px;
    padding: 16px;
    border: 1px solid #d9dadc;
    background-color: #fff;
	display:none;
}
.qr_code_pc  img{
	width: 102px;
}
.qr_code_pc p{
	font-size: 14px;
    line-height: 20px;
	text-align: center;
}
 @media screen and (min-width: 800px) {
    .qr_code_pc {
      display:block;
    }
  }

</style>
</body></html>

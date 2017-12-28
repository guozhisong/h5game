<header class="head clearfix">
<a href="<?php echo $_SERVER['HTTP_REFERER'];?>" class="back"></a>
<span>个人中心</span>
</header>
<div class="public user">
	<a href="<?php echo $this->createUrl('user/uedit'); ?>">
		<p class="p1">
			<img id="showimg" src="<?php echo empty($user->photo) ? "/img/default_pic.png" : $user->photo; ?>">
		</p>
		<p class="p2">
            <span><b><?php echo Yii::app()->session['user_login']; ?></b>
            <?php if($user->user_sex == 2){ ?>
                <em class="woman"></em>
            <?php }else{ ?>
                <em class="man"></em>
            <?php } ?>
            </span> 
            <span class="uid"><?php echo Yii::app()->session['user_id']; ?></span> 
		</p>
	</a>
</div>
<div class="public clearfix">
	<ul class="user_attend">
		<li class="qibi_page">
		<a href="<?php echo $this->createUrl('user/jinbi'); ?>">
			<p><?php echo Yii::app()->params['bititle']; ?>中心</p>
		</a>
		</li>
	</ul>
</div>


<!--我的收藏我的卡箱-->
<div class="public clearfix">
	<ul class="user_attend">
		
		<li class="my_house"><a href="/user/collectionlist"><p>我的收藏</p></a></li>
		
	</ul>
</div>

<!--修改密码联系客服-->

<div class="public clearfix">
	<ul class="user_attend">
		<li class="qibi_password"><a href="<?php echo $this->createUrl('user/changepwd'); ?>"><p>修改密码</p></a></li>

		<li class="qibi_QQ"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo Yii::app()->params['qq']; ?>&site=qq&menu=yes" target="_blank"><p>联系客服</p></a></li>
	</ul>
</div>


<!--账号注销按钮-->
<div class="log_off"><a href="<?php echo $this->createUrl('user/logout'); ?>" >退出</a></div>
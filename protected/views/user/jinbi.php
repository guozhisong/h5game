<header class="head clearfix">
<a href="<?php echo $this->createUrl('user/index');?>" class="back"></a> 			
<span><?php echo Yii::app()->params['bititle']; ?>中心</span>
</header>
<div class="opacity_bg"></div>
<div class="public user2">
	<p class="p1">
		<img src="/img/default_pic.png" />
	</p>
	<p class="p2">
		<span><b>账号：<?php echo Yii::app()->session['user_login']; ?></b></span> 
		<span class="uid"><?php echo Yii::app()->params['bititle']; ?>：<i><?php echo $user->jinbi; ?></i></span>
	</p>
	<a href="<?php echo $this->createUrl('user/chongzhi'); ?>" class="a1">充 值</a>
</div>
<div class="qibi_con clearfix">
	<p>
		<a href="<?php echo $this->createUrl('user/jinbidetail'); ?>"><?php echo Yii::app()->params['bititle']; ?>明细</a>
	</p>
</div>
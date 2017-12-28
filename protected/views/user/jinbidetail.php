<header class="head clearfix">
<a href="javascript:history.go(-1);" class="back"></a>
<span><?php echo Yii::app()->params['bititle']; ?>明细</span>
</header>
<div class="public user2 clearfix">
	<p class="p1">	
		<img src="/img/default_pic.png" />
	</p>
	<p class="p2">
		<span><b>账号：<?php echo Yii::app()->session['user_login']; ?></b></span> 
		<span class="uid"><?php echo Yii::app()->params['bititle']; ?>：<i><?php echo $user->jinbi; ?></i></span>
	</p>
	<a href="<?php echo $this->createUrl('user/chongzhi'); ?>" class="a1">充 值</a>
</div> 
<div class="public clearfix">
	<ul class="qibi_tab_con" id="con_one_1">
	   <?php foreach ($jinbidetails as $jinbidetail ){ ?>
	   <li style='text-align: center;line-height: 35px;'><?php echo $jinbidetail->desc; ?><span style='margin: 40px;color: #ff0f00;'><?php echo $jinbidetail->jinbi; ?> <?php echo Yii::app()->params['bititle']; ?></span><?php echo $jinbidetail->date; ?></li>
	   <?php } ?>	
	</ul> 
</div>

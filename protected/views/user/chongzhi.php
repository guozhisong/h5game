<header class="head clearfix">            
<a href="javascript:history.go(-1);" class="back"></a>			
<span><?php echo Yii::app()->params['bititle']; ?>充值</span>
</header>
<div class="public qibi_bd_user clearfix" style="margin-top: 55px;">
	<p class="p1">当前账号：<?php echo Yii::app()->session['user_login']; ?></p>
	<p class="p2">
		<span class="left">剩余<?php echo Yii::app()->params['bititle']; ?>：<em>0</em></span>
	</p>
</div>
<form id="qibi_form" method="post" action='<?php echo $this->createUrl('user/pay'); ?>' >

	<div class="public clearfix">
		<ul class="qibi_recharge_con">
			<li>
				<input type="text" class="input_text01" id="qibi_amount" name="amount" 
				placeholder="请输入充值金额" onblur="checkInputAmount(this)"/>
			</li>
			<li class="clearfix" id="ope_tishi" style="color:red;text-align: center;"></li>

			<li class="clearfix">
				<span class="left"><?php echo Yii::app()->params['bititle']; ?><em id="ppc_sum">0</em></span> 
				<span class="right" style="background: none;margin:0;width: auto;">1元=100<?php echo Yii::app()->params['bititle']; ?></span>
			</li>  	
			<li>选择充值方式：</li> 
			<li class="clearfix">
				<p class="pay_way">
					<span  data="1" class="span1 hover" style="width: auto;padding: 7px 15px;" id="rechargetype_1" >支付宝</span> 
				</p>
			</li> 
			<li><a href="javascript:void(0)" class="summit_pay" onclick="return chongzhisubmit()">提交支付</a></li>
		</ul>
	</div> 
</form> 
<div class="qibi_zhu">注：充值遇到问题，请联系客服QQ：<?php echo Yii::app()->params['qq']; ?></div>
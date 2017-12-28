
		<!-- 登录口 -->
		<div class="loginbox">
			<p class="login_black"></p>
			<div id="loginform">
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	 'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
)); ?>
					<h2 class="loginwelcome"><b>游戏后台</b></h2>
					<p>
						<label for="name"><b>用户名:</b></label>
			            <input name="AdminLoginForm[username]" id="AdminLoginForm_username" type="text"  class="easyui-validatebox inputbox" data-options="required:true" value="<?php if(isset($_POST['AdminLoginForm']['username'])){ echo $_POST['AdminLoginForm']['username'];} ?>"/>
					</p>
					<p>
						<label for="user_pass"><b>密&nbsp;&nbsp;码:</b></label>
						<input name="AdminLoginForm[password]" id="user_pass" type="password"  class="easyui-validatebox inputbox" data-options="required:true" />
					</p>
					<p>
						<label for="user_captcha"><b>验证码:</b></label>
						<input type="text" name="AdminLoginForm[verifyCode]" id="user_pass" class="easyui-validatebox inputbox" data-options="required:true" style="width:136px;margin-right:46px;">
 
						<span class="img_captcha"><?php $this->widget('CCaptcha',array('showRefreshButton'=>true,'clickableImage'=>true,'buttonLabel'=>'换一张','imageOptions'=>array('alt'=>'点击换图','title'=>'点击换图','style'=>'cursor:pointer'))); ?>
						
						</span> 
					</p>
					<p>
						<a href="admin_index.html"><input type="submit" name="wp-submit" id="wp-submit" class="btn btn_center fr" value="登录"></a>
					</p>
<p style='color: Red;'>
<?php

foreach ($model->errors as $k => $v){
	if (is_array($v)){
		foreach ($v as $kk => $vv){
			echo "<br />" . $vv;
		}
	}else{
		echo "<br />" . $v;
	}
}
?>
</p>
<?php $this->endWidget(); ?>

			</div>
		</div>
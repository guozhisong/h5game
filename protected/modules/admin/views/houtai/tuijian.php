<div data-options="region:'center',title:''" style="padding:10px;">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'home-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?> 
  
	
	<div class="row"><br>
		英文逗号分隔游戏id：<br>
		<br>
		<textarea name='content' style='width: 500px;height: 300px;'><?php echo $tuijian->content;?></textarea> 
	</div>
<br/> 

	<div class="row buttons">
		<?php echo CHtml::submitButton('--保存--'); ?>
	</div>
<br/><br/>
<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
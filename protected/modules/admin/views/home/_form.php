<div class="form">
<?php $tCount = 1; ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'home-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?> 

	<?php echo $form->errorSummary($model); ?>
    
	<br/>
	今日推荐(游戏ID)：
	<div class="row"> 
		1:<?php echo $form->textField($model,'t'.$tCount,array('size'=>10,'maxlength'=>255)); ?><?php $tCount ++;?>
		<?php echo $form->error($model,'t1'); ?>
	</div>
	<br/>
	本周热门
	<?php for ($i = 1; $i <= 4; $i++) {?>
	<div class="row"> 
		<?php echo $i; ?>:<?php echo $form->textField($model,'t'.$tCount,array('size'=>10,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'t'.$tCount); ?><?php $tCount ++;?>
	</div>
    <?php } ?>  
	
    <br/>
	最新上线：
	<?php for ($i = 1; $i <= 8; $i++) {?>
	<div class="row"> 
		<?php echo $i; ?>:<?php echo $form->textField($model,'t'.$tCount,array('size'=>10,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'t'.$tCount); ?><?php $tCount ++;?>
	</div>
    <?php } ?> 
    
    <br/>
	热门网游
	<?php for ($i = 1; $i <= 8; $i++) {?>
	<div class="row"> 
		<?php echo $i; ?>:<?php echo $form->textField($model,'t'.$tCount,array('size'=>10,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'t'.$tCount); ?><?php $tCount ++;?>
	</div>
    <?php } ?> 
    
    <br/>
	热门单机
	<?php for ($i = 1; $i <= 12; $i++) {?>
	<div class="row"> 
		<?php echo $i; ?>:<?php echo $form->textField($model,'t'.$tCount,array('size'=>10,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'t'.$tCount); ?><?php $tCount ++;?>
	</div>
    <?php } ?> 

	 <br/><br/> 
<br/>
<br/><br/>

	<div class="row buttons">
		<?php echo CHtml::submitButton('--保存--'); ?>
	</div>
<br/><br/>
<?php $this->endWidget(); ?>

</div><!-- form -->
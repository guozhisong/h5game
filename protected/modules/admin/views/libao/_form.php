<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'libao-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
 

	<?php echo $form->errorSummary($model); ?>
	<table class="table tableqr">
	<tbody>
	 <tr>
			<td align="right"><b>游戏ID</b></td>
			<td>
			<?php echo $form->textField($model,'gameid',array('size'=>60,'maxlength'=>255)); ?>
		      <?php echo $form->error($model,'gameid'); ?>
			</td>
		</tr>
	<tr>
	
			<td align="right"><b>礼包标题</b></td>
			<td>
			<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		      <?php echo $form->error($model,'title'); ?>
			</td>
		</tr> 
        <tr>
            <td align="right"><b>描述</b></td>
			<td > 
			 <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'id'=>'news_content', 'style'=>'display:none')); ?>
			 <?php echo $form->error($model,'description'); ?>
			 <script id="editor" type="text/plain" style="width:910px;height:300px;"><?php echo $model->description; ?></script>
			</td>
		</tr>
 
        <tr>
			<td align="right"><b>礼包Excel</b></td>
			<td>
			     <?php echo $form->fileField($model,'excel'); ?>
			</td>
		</tr>
		  </tbody></table>

	<div class="row buttons" style='margin: 30px;'>
		<?php echo CHtml::submitButton('保存',array('onclick'=>"return getContent();")); ?>
	</div>

<?php $this->endWidget(); ?> 

<script type="text/javascript">

   var ue = UE.getEditor('editor');
 
    function getContent() { 
    	jQuery('#news_content').html(UE.getEditor('editor').getContent());
 
    }
     
</script>

</div><!-- form -->

<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
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
			<td align="right"><b>类型</b></td>
			<td>
			<?php ?>
			<select name='Zixun[type]'>
    			<option value='游戏新闻' <?php if($model->type == '游戏新闻'){echo ' selected=selected '; }?>>游戏新闻</option>
    			<option value='游戏攻略' <?php if($model->type == '游戏攻略'){echo ' selected=selected '; }?> >游戏攻略</option>
			</select> 
			</td>
		</tr>   
	<tr>
	
			<td align="right"><b>短标题</b></td>
			<td>
			<?php echo $form->textField($model,'short_title',array('size'=>60,'maxlength'=>255)); ?>
		      <?php echo $form->error($model,'short_title'); ?>
			</td>
		</tr>
	   <tr>
			<td align="right"><b>长标题</b></td>
			<td>
			<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		      <?php echo $form->error($model,'title'); ?>
			</td>
		</tr>

	   <tr>
			<td align="right"><b>关键字</b></td>
			<td>
			<?php echo $form->textField($model,'keywords',array('size'=>60,'maxlength'=>255)); ?>
		      <?php echo $form->error($model,'keywords'); ?>
			</td>
		</tr>
		
		<tr>
			<td align="right"><b>描述</b></td>
			<td>
			<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		  <?php echo $form->error($model,'description'); ?>
			</td>
		</tr>
 
        <tr>
            <td align="right"><b>内容</b></td>
			<td   > 
			 <?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50, 'id'=>'news_content', 'style'=>'display:none')); ?>
			 <?php echo $form->error($model,'content'); ?>
			 <script id="editor" type="text/plain" style="width:910px;height:400px;"><?php echo $model->content; ?></script>
			</td>
		</tr>
 
        <tr>
			<td align="right"><b>时间</b></td>
			<td>
			<?php echo $form->textField($model,'create_on'); ?><?php echo $form->error($model,'create_on'); ?>
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
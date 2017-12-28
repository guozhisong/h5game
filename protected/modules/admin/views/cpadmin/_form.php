<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admin-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
 

	<?php echo $form->errorSummary($model); ?>
	<table class="table tableqr">
	<tbody>
    <tr>
        <td align="right"><b>公司名称</b></td>
        <td>
        <?php echo $form->textField($model,'com_name',array('size'=>30,'maxlength'=>255)); ?>
          <?php echo $form->error($model,'com_name'); ?>
        </td>
    </tr>
    <tr>
        <td align="right"><b>管理员</b></td>
        <td>
        <?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>255)); ?>
          <?php echo $form->error($model,'name'); ?>
        </td>
    </tr>
	<tr>
        <td align="right"><b>密码</b></td>
        <td>
        <?php echo $form->passwordField($model, 'password', array('size'=>30, 'maxlength'=>255)); ?>
          <?php echo $form->error($model,'password'); ?>
        </td>
    </tr>
    </tbody>
    </table>

	<div class="row buttons" style='margin: 20px 0 0 260px;'>
		<?php echo CHtml::submitButton('保存'); ?>
	</div>

<?php $this->endWidget(); ?> 



</div><!-- form -->

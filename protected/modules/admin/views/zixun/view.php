<?php
/* @var $this ZixunController */
/* @var $model Zixun */

$this->breadcrumbs=array(
	'Zixuns'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Zixun', 'url'=>array('index')),
	array('label'=>'Create Zixun', 'url'=>array('create')),
	array('label'=>'Update Zixun', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Zixun', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Zixun', 'url'=>array('admin')),
);
?>

<h1>View Zixun #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'gameid',
		'type',
		'content',
		'create_on',
		'title',
		'short_title',
		'keywords',
		'description',
	),
)); ?>

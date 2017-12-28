<?php
/* @var $this ZixunController */
/* @var $data Zixun */
?>
<tr id='view_<?php echo $data->id; ?>_tr'>
	<td width="15%"><?php echo $data->id; ?></td>
	<td width="15%"><?php echo $data->gameid; ?></td>
	<td width="15%"><?php echo $data->title; ?></td> 
	<td width="15%"><a href="<?php echo $this->createUrl('delete', array('id'=>$data->id)); ?>" class='delTrLink' id="view_<?php echo $data->id; ?>" >删除</a></td>
</tr>  
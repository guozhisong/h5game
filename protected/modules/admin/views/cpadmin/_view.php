<?php
/* @var $this ZixunController */
/* @var $data Zixun */
?>
<tr id='view_<?php echo $data->id; ?>_tr'>
	<td width="15%"><?php echo $data->id; ?></td>
	<td width="15%"><?php echo $data->name; ?></td>
	<td width="15%"><?php echo $data->com_name; ?></td>
	<td width="15%"><?php echo date('Y-m-d H:i:s', $data->created_at); ?></td>
	<td width="15%"><?php echo date('Y-m-d H:i:s', $data->updated_at); ?></td>
	<td width="15%">
        <a href="<?php echo $this->createUrl('update', array('id'=>$data->id)); ?>">修改</a>
<!--        <a href="--><?php //echo $this->createUrl('delete', array('id'=>$data->id)); ?><!--" class='delTrLink' id="view_--><?php //echo $data->id; ?><!--" >删除</a>-->
    </td>
</tr>  
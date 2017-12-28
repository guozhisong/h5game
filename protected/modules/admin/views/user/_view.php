<?php
/* @var $this ZixunController */
/* @var $data Zixun */
?>
<tr id='view_<?php echo $data->id; ?>_tr'>
	<td width="15%"><?php echo $data->id; ?></td>
	<td width="15%"><?php echo $data->user_login; ?></td>
	<td width="15%"><?php echo $data->user_registered; ?></td>
	<td width="15%"><?php echo $data->user_lastlogin; ?></td>
</tr>
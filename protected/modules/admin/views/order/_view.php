<?php
/* @var $this ZixunController */
/* @var $data Zixun */
?>
<tr id='view_<?php echo $data->id; ?>_tr'>
    <td width="15%"><?php echo $data['out_trade_no']; ?></td>
    <td width="15%"><?php echo $data['user_login']; ?></td>
	<td width="15%"><?php echo $data['name']; ?></td>
	<td width="15%"><?php echo $data['amount']; ?></td>
	<td width="15%"><?php echo $data['goods_name']; ?></td>
	<td width="15%"><?php echo date('Y-m-d H:i:s', $data['payed_time']); ?></td>
</tr>
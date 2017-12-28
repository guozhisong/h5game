<tr id='view_<?php echo $data->id; ?>_tr'>
	<td><?php echo $data->id; ?></td>
	<td><?php echo $data->name; ?></td>
	<td><?php echo $data->appid; ?></td>
	<td><?php echo $data->appkey; ?></td>
    <td><?php echo $data->type; ?></td>
    <td style="color: red; cursor: pointer;">
        <?php
            switch($data->status){
                case 0:
                    $status = '待审核';break;
                case 1:
                    $status = '审核通过';break;
                case 2:
                    $status = '审核不通过';break;
                case 3:
                    $status = '禁用';break;
                default:
                    $status = '';
            }
            echo $status;
        ?>
    </td>
    <?php if ($data->status == 0 || $data->status == 2): ?>
	<td><a href="<?php echo $this->createUrl('update', array('id'=>$data->id)); ?>">修改</a>
    <?php else: ?>
    <td><a href="javascript:alert('该状态无法修改，请联系管理员')">修改</a>
    <?php endif; ?>
    </td>
</tr>
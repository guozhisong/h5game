<tr id='view_<?php echo $data->id; ?>_tr'>
    <td><?php echo $data->id; ?></td>
    <td><?php echo $data->name; ?></td>
    <?php if ($data->from == 1): ?>
    <td><?php echo $data->discount; ?></td>
    <td><?php echo $data['cpadmin']['name'] ?></td>
    <td><?php echo $data['cpadmin']['com_name'] ?></td>
    <td><?php echo $data->appid; ?></td>
    <td><?php echo $data->appkey; ?></td>
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
    <?php endif; ?>
    <td><?php echo $data->type; ?></td>
    <td>
        <a href="<?php echo $this->createUrl('update', array('id'=>$data->id)); ?>">修改</a>
        <?php if ($data->from != 1): ?>
        <a href="<?php echo $this->createUrl('delete', array('id'=>$data->id)); ?>" class='delTrLink' id="view_<?php echo $data->id; ?>" >删除</a>
        <?php endif; ?>
    </td>
</tr>
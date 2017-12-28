<?php if(isset($danji) && $danji == 2){?>
<div class="list_classify clearfix">
    <dl>
    <?php foreach (Yii::app()->params['danjifenlei'] as $fll=>$v) { ?>
    	<dt><a href="/dfl/<?php echo $fll;?>/"><img src="<?php echo $v['img'];?>"><span><?php echo $v['name'];?></span></a></dt>
    <?php } ?>
    </dl>
 </div> 
 <?php }else{ ?>
 
 <div class="list_classify clearfix">
    <dl>
    <?php foreach (Yii::app()->params['wangyoufenlei'] as $fll=>$v) { ?>
    	<dt><a href="/fl/<?php echo $fll;?>/"><img src="<?php echo $v['img'];?>"><span><?php echo $v['name'];?></span></a></dt>
    <?php } ?>
    </dl>
 </div> 
 <?php } ?>
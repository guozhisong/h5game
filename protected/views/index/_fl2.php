<?php if(isset($danji) && $danji == 2){?>
<div class="list_classify clearfix">
    <dl>
    <?php $count = 0; ?>
    <?php foreach (Yii::app()->params['danjifenlei'] as $fll=>$v) { $count++;?>
    	<dt <?php if($count>=9){echo 'style="display:none;"';}?>><a href="/dfl/<?php echo $fll;?>/"><img src="<?php echo $v['img'];?>"><span><?php echo $v['name'];?></span></a></dt>
    <?php } ?>
    </dl>
 </div> 
 <?php }else{ ?>
 
 <div class="list_classify clearfix">
    <dl>
    <?php $count = 0; ?>
    <?php foreach (Yii::app()->params['wangyoufenlei'] as $fll=>$v) { $count++; ?>
    	<dt <?php if($count>=9){echo 'style="display:none;"';}?>><a href="/fl/<?php echo $fll;?>/"><img src="<?php echo $v['img'];?>"><span><?php echo $v['name'];?></span></a></dt>
    <?php } ?>
    </dl>
 </div> 
 <?php } ?>
<div class="morelist"><a href="#" onclick='return showMoreType()'><p>更多</p></a></div>
<script>
function showMoreType(){
	$('.morelist').hide();
	$('.list_classify dt').show();
	return false;
}
</script>
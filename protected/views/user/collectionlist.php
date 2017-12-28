<header class="head clearfix">
<a href="<?php echo $this->createUrl('user/index');?>" class="back"></a> 			
<span>我的收藏</span>
</header>
<div id="con_one_1"> 
    <div class="public new_public clearfix">
        <div class="list_one">
            <dl id="_list1">
                <?php foreach ($list as $item){ 
                    $id = $item->gameid;
                ?>
                      <dt> <?php echo $this->PrintGameType3($id); ?></dt>  
                <?php } ?> 
            </dl>
        </div>
    </div> 
</div> 
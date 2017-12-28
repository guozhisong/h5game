<div class="public clearfix">
     <div class="tit"><p class="tit_ico game_classify">游戏分类</p></div>
     <?php include '_fl2.php';?>
 </div>
 
<div class="public clearfix">
     <div class="tit"><p class="tit_ico game_classify"><?php echo $type; ?></p></div>
     <div class="list_classify clearfix">
        <div class="list_one">
            <dl id="_list1">
            <?php foreach ($games as $game){  ?>
                <dt> <?php echo $this->PrintGameType3($game->id); ?></dt>  
            <?php } ?> 
            </dl>
        </div>
     </div> 
 </div>  
 
 
<style>
.list_one dl dt p.p2 em {
    float: left;
    width: 100%;
    text-align: left;
}
body .list_classify a img {
    width: 20px;
    }
    
body .list_classify a span {
    display: inline-block;
    margin-top: 8px;
    margin-left: 8px;
}
</style>
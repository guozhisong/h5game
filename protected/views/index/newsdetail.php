<style >
    a{cursor:pointer;text-decoration:none; color:#4c4c4c;}
    a:visited{ color:#000}
    a:hover,a:active{text-decoration:none; color:#00b3ff}

    .news_tit {
        font-size: 14px;
        clear: both;
        border-bottom: 1px dashed #e0e0e0;
        line-height: 38px;
        height: 38px;
        color: #ccc;
    }
    .news_tit a {
        padding: 0 8px;
    }
    .detail_text {
        padding: 10px;
    }
    .detail_text .h1 {
        font-size: 16px;
        color: #333;
        line-height: 22px;
        padding: 5px 0;
        text-align: center;
        width: 100%;
    }
    .detail_text .time {
        font-size: 14px;
        text-align: center;
        width: 100%;
        color: #999;
        padding-bottom: 10px;
        line-height: 20px;
    }
    .detail_text .next_pre a {
        display: block;
        clear: both;
        width: 100%;
        color: #00b3ff;
        line-height: 30px;
    }
    .detail_text .introd_con {
        color: #666;
        line-height: 24px;
        padding: 8px 0;
        font-size: 14px;
    }

    .morelist2{clear:both;text-align:center; color:#999; line-height:35px; height:35px; border-top:1px dashed #e0e0e0;}
    .morelist2 a{ display:block; color:#999;}
    .introd_con img{max-width: 100%;}
</style>
<div class="public new_public clearfix">
    <div class="detail_list_one">
        <dl>
            <dt>
            <p class="p1"><img src="<?php echo $gm->icon; ?>"  alt="<?php echo $gm->name; ?>"/></p>
            <p class="p2">
                <i><?php echo $gm->name; ?></i>
                <em>
                    <img src="/img/star_1.png"/>
                    <img src="/img/star_1.png"/>
                    <img src="/img/star_1.png"/>
                    <img src="/img/star_1.png"/>
                    <img src="/img/star_2.png"/>
                </em>
                <span><?php echo $gm->type; ?>  人气：<?php echo $this->gamehots($gm->id); ?></span>
            </p> 
                    
					<p class="p3 ewmp3">  <a href="javascript:void(0)" onclick="gamePlay('<?php echo $this->createUrl('index/play',array('id'=>$gm->id)); ?>')">开始游戏</a>   </p>
					
                    <p class="p4"><a id="collectgame" href="javascript:void(0);" data-gid='<?php echo $gm->id;?>' style="font-size:14px;" <?php if($this->isCollection($gm->id)) { ?> class="gray">已收藏<?php } else{ ?>class="">收藏游戏<?php } ?></a></p>
                    
            </dt>
        </dl>
    </div>
</div>

<div class="public clearfix">
    <div class="detail">   
     <div class="news_tit"><a href="/games/<?php echo $gm->id; ?>/"><?php echo $gm->name; ?></a>&gt;
     <?php if($news->type=='游戏新闻') { ?>
<a href="/news/">新闻</a>
<?php }else{ ?>
<a href="/gl/">攻略</a>
<?php } ?>
     
     &gt; 正文</div>
     <div class="detail_text">
            <h1 class="h1"><?php echo $news->title; ?> </h1>
            <p class="time"><?php echo $news->create_on; ?></p>
            <div class="introd_con">
            </div> 
    <?php echo $news->content; ?>
</div>
</div>

<div style="padding-top:20px;" class="public ">

             
        <?php if(count($gameNews)){ ?> 
<div class="tit"><p class="tit_ico game_label">相关文章</p></div>
                    <ul class="list_text" style="margin: 5px 10px 0;">
                       <?php foreach ($gameNews as $news ) {  $newslink = "/games/{$gm->id}/{$news->id}.html"; ?>                            
<li style="line-height: 20px;height: 20px;overflow: hidden;padding: 10px 0;border-bottom: 1px dashed #ebebeb;">
<?php if($news->type=='游戏新闻') { ?>
<a style="color:#00b3ff;" href="<?php echo $newslink; ?>" class="a1">[新闻]</a>
<?php }else{ ?>
<a style="color:#00b3ff;" href="<?php echo $newslink; ?>" class="a1">[攻略]</a>
<?php } ?>
                                <a href="<?php echo $newslink; ?>" class="a2"><?php echo $news->short_title; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
<?php } ?>

                            
                    </ul>
 

        

            <div class="tit"><p class="tit_ico about_game">相关游戏</p></div>
        <div class="list_four clearfix">
            <ul>
                                   <ul>
                        <?php foreach ($same as $sa) {
                            $detailLink = '/games/'.$sa->id.'/';?>
                            <li><a href="<?php echo $detailLink; ?>">
                            <img src="<?php echo $sa->icon; ?>" /><p>
                            <?php echo $sa->name; ?></p></a></li>
                        <?php } ?>
                    </ul>
                            </ul>
        </div>
    

</div>

</div>
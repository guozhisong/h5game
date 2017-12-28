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
					<p class="p3 ewmp3">  <a href="javascript:void(0)" onclick="gamePlay('<?php if($gm->id<12471)echo $this->createUrl('index/play',array('id'=>$gm->id));else echo $this->createUrl('game/login',array('appid'=>$gm->appid)); ?>')">开始游戏</a>   </p>

                    <p class="p4"><a id="collectgame" href="javascript:void(0);" style="font-size:14px;" data-gid='<?php echo $gm->id;?>' <?php if($this->isCollection($gm->id)) { ?> class="gray">已收藏<?php } else{ ?>class="">收藏游戏<?php } ?></a></p>

            </dt>
        </dl>
    </div>
</div>

<div class="public clearfix">
    <div class="detail_tab">
        <ul>
                            <li class="hover" id="one1" onClick="setTab('one', 1, 2)"><p class="intro">简介</p></li>
                <li id="one2" onClick="setTab('one', 2, 2)"><p id="comment_li_click" class="comment">评论</p></li>
                    </ul>
    </div>
    <!--简介-->
    <div class="detail_con" id="con_one_1">

                    <div class="detail_img" id="wrapper">
                <div  style='width: 100%; overflow-x:auto; overflow-y:hidden;'>
                    <ul style='margin-right: -2000px;'>
                    <?php $imgs = json_decode($gm->game_picture); $c =0;  foreach ($imgs as $img) { $c++; if($c == 5){break;}?>
                                                <li><img src="<?php echo $img; ?>"  class="img" /></li>
                                                <?php } ?>
                                            </ul>
                </div>
            </div>

        <div class="detail">
            <div class="tit">
                <p class="tit_ico game_intro">游戏说明</p>
            </div>
            <div class="introd_con">
                <span><?php echo $gm->desc; ?></span>
            </div>
            <div class="tit">
                <p class="tit_ico game_label">游戏标签</p>
            </div>
            <div class="lable_list">
                <a href="#"><?php echo $gm->type; ?></a>
            </div>
            <div class="tit">
                <p class="tit_ico game_label">游戏礼包</p>
            </div>
            <div class="list_one">
                <dl id="_list">
                    <?php foreach ($libaos as $libao){
                        $leave = $libao->used();
                        ?>
                        <dt>
                            <a href="/libao/<?php echo $libao->id; ?>.html">
                                <p class="p1"><img src="<?php echo $libao->gameImg(); ?>"/></p>
                                <p class="p2">
                                    <i><?php echo $libao->title; ?></i>
                                    <span style="margin-top:10px;">剩余：<font color="#FF0000"><b><?php echo $leave; ?>%</b></font>	                                    										</span>
                                </p>
                                <?php if($leave == 0){ ?>
                                    <p class="p3"><span style="background-color: #75787A">结束</span></p>
                                <?php }else{ ?>
                                <p class="p3"><span>领取</span>
                                    <?php } ?>
                            </a>
                        </dt>
                    <?php } ?>
                </dl>
            </div>
            <div class="public clearfix" style="clear: both;">
                <?php if(count($gameNews)){ ?>
                <div class="tit"><p class="tit_ico game_label">游戏新闻</p></div>
                    <ul class="list_text" style="margin: 5px 10px 0;">
                       <?php
                       $count = 0;
                       foreach ($gameNews as $news ) {
                           $count ++;if($count >= 10){break;}
                           $newslink = "/games/{$gm->id}/{$news->id}.html"; ?>
<li style="line-height: 20px;height: 20px;overflow: hidden;padding: 10px 0;border-bottom: 1px dashed #ebebeb;">
                                <a style="color:#00b3ff;" href="<?php echo $newslink; ?>" class="a1">[新闻]</a>
                                <a href="<?php echo $newslink; ?>" class="a2"><?php echo $news->short_title; ?></a>
                            </li>
                        <?php } ?>
                         <?php if($count >= 10){ ?>
                            <div class="morelist more_hide_gl_more"><a href="/games/<?php echo $gm->id; ?>/news/" ><p>点击查看更多新闻</p></a></div>
                        <?php } ?>
                    </ul>
<?php } ?>
                <?php if(count($gameGongnues)){ ?>
                <div class="tit"><p class="tit_ico game_label">游戏攻略</p></div>
                    <ul class="list_text" style="margin: 5px 10px 0;">
        <?php
        $count = 0;
        foreach ($gameGongnues as $news ) {
            $count ++;if($count >= 10){break;}
            $newslink = "/games/{$gm->id}/{$news->id}.html"; ?>
            <li style="line-height: 20px;height: 20px;overflow: hidden;padding: 10px 0;border-bottom: 1px dashed #ebebeb;"<?php
                if($count > 10){
                    echo "class='more_hide_gl myhide'";
                }
            ?>>
              <a style="color:#00b3ff;" href="<?php echo $newslink; ?>" class="a1">[攻略]</a>
              <a href="<?php echo $newslink; ?>" class="a2"><?php echo $news->short_title; ?></a>
            </li>
        <?php } ?>
        <?php if($count >= 10){ ?>
            <div class="morelist more_hide_gl_more"><a href="/games/<?php echo $gm->id; ?>/gl/" ><p>点击查看更多攻略</p></a></div>
        <?php } ?>
                    </ul>
<?php } ?>
            <div class="tit"><p class="tit_ico about_game">相关游戏</p></div>
                <div class="list_four clearfix">
                    <ul>
                        <?php foreach ($same as $sa) {
                            $detailLink = '/games/'.$sa->id.'/';?>
                            <li><a href="<?php echo $detailLink; ?>">
                            <img src="<?php echo $sa->icon; ?>" /><p>
                            <?php echo $sa->name; ?></p></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
    </div>
<style>
.myhide{
	display:none;
}
</style>
</div>
<div class="detail_con myhide" id="con_one_2" >
<!--PC和WAP自适应版-->
<div id="SOHUCS" ></div>
<script type="text/javascript">
(function(){
var appid = 'cysBcwxyt';
var conf = 'prod_5ee0190184d0ce182e9cbf7bea5875d6';
var width = window.innerWidth || document.documentElement.clientWidth;
if (width < 960) {
window.document.write('<script id="changyan_mobile_js" charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/mobile/wap-js/changyan_mobile.js?client_id=' + appid + '&conf=' + conf + '"><\/script>'); } else { var loadJs=function(d,a){var c=document.getElementsByTagName("head")[0]||document.head||document.documentElement;var b=document.createElement("script");b.setAttribute("type","text/javascript");b.setAttribute("charset","UTF-8");b.setAttribute("src",d);if(typeof a==="function"){if(window.attachEvent){b.onreadystatechange=function(){var e=b.readyState;if(e==="loaded"||e==="complete"){b.onreadystatechange=null;a()}}}else{b.onload=a}}c.appendChild(b)};loadJs("http://changyan.sohu.com/upload/changyan.js",function(){window.changyan.api.config({appid:appid,conf:conf})}); } })(); </script>
</div>

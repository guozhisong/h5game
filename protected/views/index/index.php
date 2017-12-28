<!--今日最佳-->
<div class="public clearfix">
    <div class="tit"><p class="tit_ico today_best">今日推荐</p></div>
     <div class="list_one new_list_one">
         <dl>
            <dt>
                <?php echo $this->PrintGameType1($home->t1); ?>
            </dt>
         </dl>
       </div>
</div>
<style>
    .list_two li{
        padding-top:0;
        margin-top: 15px;
    }
    .list_two li .a_in, .list_one dt .myitem{
        position:relative;
    }
    .list_two li .a_in .hron, .list_one dt .myitem .hron{
        background:url("/upload/horn.png") no-repeat;
        width: 38px;
        height: 38px;
        position: absolute;
        z-index: 10;
        left: 38px;
        top: -6px;
    }
    .list_one dt .myitem .hron{
        left: 51%;
        top: -1%;
    }
    .list_two li .a_in .sale, .list_one dt .myitem .sale{
        position: absolute;
        top: -1px;
        left: 39px;
        transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        height: 38px;
        width: 38px;
        color: #fff;
        font-size: 12px;
        font-family: "Microsoft YaHei";
        z-index:20;
        /* background-size: 40px 40px; */
    }
    .list_one dt .myitem .sale{
        top: 1%;
        left: 50%;
    }

</style>
<!--小编推荐-->
 <div class="public clearfix">
     <div class="tit"><p class="tit_ico edit_recommend">本周热门</p></div>
     <div class="list_two clearfix">
          <ul>
	          <li>
	            <?php echo $this->PrintGameType2($home->t2); ?>
	            <?php echo $this->PrintGameType2($home->t3); ?>
	          </li><li>
                <?php echo $this->PrintGameType2($home->t4); ?>
                <?php echo $this->PrintGameType2($home->t5); ?>
	           </li>
          </ul>
      </div>
 </div>

 <!--最新游戏-->
  <div class="public clearfix">
     <div class="tit"><p class="tit_ico new_game">最新上线</p></div>
     <div class="list_one">
         <dl class='f4'>
              <dt>
             <?php echo $this->PrintGameType5($home->t6); ?>
            </dt>
              <dt>
             <?php echo $this->PrintGameType5($home->t7); ?>
            </dt><dt>
             <?php echo $this->PrintGameType5($home->t8); ?>
            </dt><dt>
             <?php echo $this->PrintGameType5($home->t9); ?>
            </dt><dt>
             <?php echo $this->PrintGameType5($home->t10); ?>
            </dt><dt>
             <?php echo $this->PrintGameType5($home->t11); ?>
            </dt><dt>
             <?php echo $this->PrintGameType5($home->t12); ?>
            </dt><dt>
             <?php echo $this->PrintGameType5($home->t13); ?>
            </dt>
                  </dl>
       </div>
     <div class="morelist"><a href="/games/"><p>点击查看更多</p></a></div>
 </div>

<!--热门专题-->
<!--  <div class="public clearfix">
     <img src="/static/20151112175914.jpg" style='width:100%; height: 75px;'>
 </div> -->

<!--热门网游-->
  <div class="public clearfix">
     <div class="tit"><p class="tit_ico new_game">热门网游</p>  <a style='float:right; margin-right:15px;' href="/wangyou/"><p>点击更多</p></a></div>
     <div class="list_one">
         <dl class='f4'>
              <dt>
             <?php echo $this->PrintGameType5($home->t14); ?>
            </dt>
              <dt>
             <?php echo $this->PrintGameType5($home->t15); ?>
            </dt><dt>
             <?php echo $this->PrintGameType5($home->t16); ?>
            </dt><dt>
             <?php echo $this->PrintGameType5($home->t17); ?>
            </dt><dt>
             <?php echo $this->PrintGameType5($home->t18); ?>
            </dt><dt>
             <?php echo $this->PrintGameType5($home->t19); ?>
            </dt><dt>
             <?php echo $this->PrintGameType5($home->t20); ?>
            </dt><dt>
             <?php echo $this->PrintGameType5($home->t21); ?>
            </dt>
                  </dl>
       </div>
 </div>

 <!--热门单机-->
  <div class="public clearfix">
     <div class="tit"><p class="tit_ico new_game">热门单机</p>  <a style='float:right; margin-right:15px;' href="/danji/"><p>点击更多</p></a></div>
     <div class="list_one">
         <dl class='f4'>
              <dt>
             <?php echo $this->PrintGameType6($home->t22); ?>
            </dt>
              <dt>
             <?php echo $this->PrintGameType6($home->t23); ?>
            </dt><dt>
             <?php echo $this->PrintGameType6($home->t24); ?>
            </dt><dt>
             <?php echo $this->PrintGameType6($home->t25); ?>
            </dt><dt>
             <?php echo $this->PrintGameType6($home->t26); ?>
            </dt><dt>
             <?php echo $this->PrintGameType6($home->t27); ?>
            </dt><dt>
             <?php echo $this->PrintGameType6($home->t28); ?>
            </dt><dt>
             <?php echo $this->PrintGameType6($home->t29); ?>
            </dt>
            <dt>
             <?php echo $this->PrintGameType6($home->t30); ?>
            </dt><dt>
             <?php echo $this->PrintGameType6($home->t31); ?>
            </dt><dt>
             <?php echo $this->PrintGameType6($home->t32); ?>
            </dt><dt>
             <?php echo $this->PrintGameType6($home->t33); ?>
            </dt>
                  </dl>
       </div>
 </div>

<!--游戏分类-->
 <div class="public clearfix">
     <div class="tit"><p class="tit_ico game_classify">游戏分类</p> <a style='float:right; margin-right:15px;' href="/games/"><p>点击更多</p></a></div>
     <?php include '_fl.php';?>
 </div>

  <!--最新资讯-->
  <div class="public clearfix">
     <div class="tit"><p class="tit_ico new_game">最新资讯</p></div>
     <div class="list_one">
        <?php foreach ($newsLastTen as $news){ ?>
            <div class='homenews'>
                <a href='<?php echo "/games/{$news->gameid}/{$news->id}.html"; ?>'><span><?php echo str_replace('游戏', '', $news->type);  ?></span> <span class='sp'>|</span> <?php echo $news->title; ?></a>
            </div>
        <?php } ?>
     </div>
 </div>


<!-- 开始  -->
<style>
/*网游*/
.index_tab,.index_tab2{clear:both; margin:10px auto; width:90%;}
.index_tab li,.index_tab2 li{float:left; width:33.3%; height:40px; cursor:pointer; position:relative;}
.index_tab2 li{width:50%;}
.index_tab li p,.index_tab2 li p{display:block; background:#fff; line-height:38px; font-size:16px; text-align:center; border:1px solid #e0e0e0; color:#808080;}
.index_tab li .p1,.index_tab2 li .p1{border-radius:4px 0 0 4px;}
.index_tab li .p2,.index_tab2 li .p2{border-left:none; border-right:none;}
.index_tab li .p3,.index_tab2 li .p3{border-radius:0 4px 4px 0;}
.index_tab li em,.index_tab2 li em{position:absolute; bottom:-5px; left:50%; margin-left:-10px; width:10px; height:5px; background:url(img/arrow.png) no-repeat; background-size:10px 5px; display:none;}
.index_tab li.hover em,.index_tab2 li.hover em{display:inline-block;}
.index_tab li.hover p,.index_tab2 li.hover p{background:#00b3ff; color:#fff; border:1px solid #00b3ff; font-weight:bold;}
.public{ background:#fff; width:100%;border-top:1px solid #e0e0e0;border-bottom:1px solid #e0e0e0; margin-bottom:10px}

    
</style>
<!--最新最热tab-->
<ul class="index_tab2 clearfix">
    <li <?php if(!isset($_GET['type'])){echo 'class="hover"';} ?> ><a href="/games/"><p class="p1">网游</p><em></em></a></li>
    <li <?php if(isset($_GET['type']) && $_GET['type'] == 2){echo 'class="hover"';} ?> ><a href="/games/fldanji"><p class="p3">单机</p><em></em></a></li>
</ul>
<!--列表-->
  <div class="public new_public clearfix">
     <div class="list_one">
         <dl id="_list">
         <?php if ($gamesId) { ?>
                  <?php foreach ($gamesId as $id){  ?>
                        <dt> <?php echo $this->PrintGameType3($id); ?></dt>  
                  <?php  } ?>
         <?php }else { ?>
                  <?php foreach ($games1 as $game){  ?>
                        <dt> <?php echo $this->PrintGameType3($game->id); ?></dt>  
                  <?php  } ?>
         <?php  } ?>
         </dl>
       </div>
 </div> 

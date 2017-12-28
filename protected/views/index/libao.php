<div> 
      <div class="public new_public clearfix">
            <form method="get">
                	<div class="lbsearch">
                	 <input type="text" name="skey" placeholder="搜索礼包" class="lb_search_tx" value="">
                	 <input type="submit" value="搜索" class="lb_search_bt" style="cursor: pointer;">
                	</div>
            </form>
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
      </div> 
</div>
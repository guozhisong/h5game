<div class="public new_public clearfix">
    <div class="detail_list_one">
        <dl>
            <dt><?php $leave = $libao->used(); ?>
            <p class="p1"><img src="<?php echo $libao->gameImg(); ?>"  alt="<?php echo $libao->title; ?>"/></p>
            <p class="p2"> 
                <i><?php echo $libao->title; ?></i>
                <span>剩余：<font color="#FF0000"><b id="change_surplus"><?php echo $leave; ?>%</b></font></span>
            </p>
            <?php if($leave == 0){ ?>
                <p class="p3" style="top:25px"><span style="background-color: #75787A;color: #fff;display: block;font-size: 14px;height: 32px;cursor:pointer;
					line-height: 34px;text-align: center;width: 61px;border-radius: 6px;-webkit-border-radius: 6px;">结束</span></p>
            <?php }else{ ?>
                <p class="p3" style="top:25px" id='libaokey'><span style='background: #00b3ff;color: #fff;display: block;font-size: 14px;height: 32px;cursor:pointer;
					line-height: 34px;text-align: center;width: 61px;border-radius: 6px;-webkit-border-radius: 6px;' onclick='libao("<?php echo $libao->id;?>")'>领取</span>
            <?php } ?>
            </dt>
        </dl>
    </div>
</div>


<div class="public clearfix">
	 <div class="tit"><p class="tit_ico fahao">礼包内容</p></div>
	 <div class="libao_con">
	 <?php echo $libao->description; ?>
	 </div>
</div>

<div class="public clearfix">
	 <div class="tit"><p class="tit_ico fahao">注意事项</p></div>
	  <ul class="lq_style">
	   <li>
	   	<p style="color:red">
	   	本礼包将在领取结束后全部公开，请领到号码的玩家尽快使用，以免号码被其他玩家淘走。
	   	</p>
	   	
	   </li>
	  </ul>
	</div>
</div>

<div class="public clearfix">
	 <div class="tit"><p class="tit_ico fahao">相关礼包</p></div>
	 <div class="list_one">
	     <dl>
	     <?php 
	     $sames = $libao->samelibao();
	     foreach ($sames as $libao){ 
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

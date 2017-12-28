<div data-options="region:'center',title:'礼包列表'" style="padding:10px;">
		<div class="welcome clearfix">
            <form action="/admin/order/index">
                订单号&nbsp;&nbsp;<input type="text" name="out_trade_no" value="<?=$_GET['out_trade_no']?>">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                用户名&nbsp;&nbsp;<input type="text" name="user_login" value="<?=$_GET['user_login']?>">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="搜索">
            </form>
            <br>
                <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'dataProvider' => $dataProvider,
                    'id'=>'order-grid',
                    'columns' => array(
                        array(
                            'id'=>'autoId',
                            'class'=>'CCheckBoxColumn',
                            'selectableRows' => '50',
                        ),
                        array(
                            'header'=>'订单ID',
                            'name'=>'out_trade_no',
                            'htmlOptions'=>array(
                                'style'=>'text-align:center;',
                            ),
                        ),
                        array(
                            'header'=>'用户名',
                            'name'=>'user_login',
                            'htmlOptions'=>array(
                                'style'=>'text-align:center;',
                            ),
                        ),
                        array(
                            'header'=>'游戏名',
                            'name'=>'name',
                            'htmlOptions'=>array(
                                'style'=>'text-align:center;',
                            ),
                        ),
                        array(
                            'header'=>'原价',
                            'name'=>'org_amount',
                            'htmlOptions'=>array(
                                'style'=>'text-align:center;',
                            ),
                        ),
                        array(
                            'header'=>'折扣',
                            'name'=>'discount',
                            'htmlOptions'=>array(
                                'style'=>'text-align:center;',
                            ),
                        ),
                        array(
                            'header'=>'现价',
                            'name'=>'amount',
                            'htmlOptions'=>array(
                                'style'=>'text-align:center;',
                            ),
                        ),
                        array(
                            'header'=>'商品名',
                            'name'=>'goods_name',
                            'htmlOptions'=>array(
                                'style'=>'text-align:center;',
                            ),
                        ),
                        array(
                            'header'=>'支付时间',
                            'name'=>'payed_time',
                            'value'=>'date("Y-m-d H:i:s",$data["payed_time"])',
                            'htmlOptions'=>array(
                                'style'=>'text-align:center;',
                            ),
                        ),
                    ),
                ));
                ?>
			<div class="pager used">
			<?php

			    $this->widget('CLinkPager',array(
			        'header'=>'',     
			        'prevPageLabel' => '上一页',    
			        'nextPageLabel' => '下一页',    
			        'pages' => $pages, 
			        'maxButtonCount'=>9,
					'cssFile'=>false
			        )    
			    );    
			?> 
			</div> 
		</div>
		 
	</div>
<script>
//    $('tr td').css('text-align', 'center');
    var totalMoney = <?= $totalMoney; ?>;
    $('.summary').before('当前总金额: '+totalMoney);
</script>
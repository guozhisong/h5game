<div data-options="region:'center',title:'管理员列表'" style="padding:10px;">
		<div class="welcome clearfix">
			
			<table class="table tableqr">
					<thead>
						<tr>
							<th width="10%">ID</th>
							<th width="15%">管理员</th>
							<th width="15%">公司名称</th>
							<th width="15%">创建时间</th>
							<th width="15%">修改时间</th>
							<th width="15%">操作</th>
						</tr>
					</thead>
					<tbody>
					<?php $this->widget('zii.widgets.CListView', array(
                    	'dataProvider'=>$dataProvider,
                    	'itemView'=>'_view',
                    )); ?> 
					</tbody>
			</table>
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
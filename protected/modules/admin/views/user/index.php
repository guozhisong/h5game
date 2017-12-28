<div data-options="region:'center',title:'新闻列表'" style="padding:10px;">
		<div class="welcome clearfix">
            <form action="/admin/user/index">
                用户ID&nbsp;&nbsp;<input type="text" name="id" value="<?=$_GET['id']?>">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                用户名&nbsp;&nbsp;<input type="text" name="user_login" value="<?=$_GET['user_login']?>">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="搜索">
            </form>
            <br>
			<table class="table tableqr">
					<thead>
						<tr>
							<th width="10%">用户ID</th>
							<th width="15%">用户名</th>
							<th width="15%">注册时间</th>
							<th width="15%">最后登录时间</th>
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



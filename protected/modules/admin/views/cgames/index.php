<div data-options="region:'center',title:'游戏列表'" style="padding:10px;">
    <div class="welcome clearfix">

        <table class="table tableqr">
            <thead>
            <tr>
                <th width="5%">游戏ID</th>
                <th width="8%">名称</th>
                <?php if ($from == 1): ?>
                <th width="6%">游戏折扣</th>
                <th width="6%">所属用户</th>
                <th width="13%">公司名称</th>
                <th width="18%">appid</th>
                <th width="18%">appkey</th>
                <th width="6%">状态</th>
                <?php endif; ?>
                <th width="6%">类型</th>
                <th width="7%">操作</th>
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



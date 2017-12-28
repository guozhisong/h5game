<!-- con -->
<div data-options="region:'center',title:'游戏列表'" style="padding:10px;">
    <div class="welcome clearfix">

        <table class="table tableqr">
            <thead>
            <tr>
                <th width="10%">ID</th>
                <th width="15%">游戏名称</th>
                <th width="15%">icon</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($games as $game) { ?>
                <tr>
                    <td width="15%"><?php echo $game->id; ?></td>
                    <td width="15%"><?php echo $game->name; ?></td>
                    <td width="15%"><img class='game_icon' src ='<?php echo $game->icon; ?>' /></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>

</div>
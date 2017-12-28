<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>游戏后台系统</title>
    
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/cac_style/default.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/cac_style/easyui.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/cac_style/custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/admin.css">
    <script type="text/javascript"
            src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/jquery-1.7.2.min.js"></script>
    <script type="text/javascript"
            src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/jquery.easyui.min.js"></script>
    <script type="text/javascript"
            src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/ajaxFileUpload.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/admin.js"></script>
     
    
    <script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/ueditor/lang/zh-cn/zh-cn.js"></script>
    
     
</head>
<body class="easyui-layout">
<!-- header -->
<div data-options="region:'north',border:false">
    <div id="header">
        <div class="banner">
            <div class="logo"> 
            </div> 
        </div>
        <!-- header_link -->
        <div class="page_header">
            <p class="black"></p>

            <h2 class="page_tit"><a href="<?php echo $this->createUrl('/admin/houtai/index'); ?>">游戏平台管理</a></h2>

            <div class="top_icon_bar">
                 
            </div>
            <div class="user_profile">
                <?php echo Yii::app()->session['super_admin']; ?>,&nbsp;欢迎光临&nbsp;&nbsp;&nbsp;&nbsp;
                <a href='<?php echo $this->createUrl('/admin/houtai/logout'); ?>'>退出后台</a>
            </div>
        </div>
    </div>
</div>
<!-- nav -->
<div data-options="region:'west',split:true" title="导航" style="width:180px;padding1:1px;overflow:hidden;">
    <div class="easyui-accordion" data-options="fit:true,border:false">
            <div title="管理">
                <b class="navicon navicon01"></b>
                <ul id="tt1" class="easyui-tree">
                    <li>
                        <span>管理员列表</span>
                        <ul>
                            <li><a href="<?php echo $this->createUrl('/admin/cpadmin/create'); ?>">添加</a></li>
                            <li><a href="<?php echo $this->createUrl('/admin/cpadmin/index'); ?>">列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <span>网游</span>
                        <ul>
                            <li><a href="<?php echo $this->createUrl('/admin/cgames/index',array('from'=>1, 'status' => 0)); ?>">待审核列表</a></li>
                            <li><a href="<?php echo $this->createUrl('/admin/cgames/index',array('from'=>1, 'status' => 1)); ?>">已审核列表</a></li>
                            <li><a href="<?php echo $this->createUrl('/admin/cgames/index',array('from'=>1, 'status' => 2)); ?>">审核不通过</a></li>
                            <li><a href="<?php echo $this->createUrl('/admin/cgames/index',array('from'=>1, 'status' => 3)); ?>">禁用</a></li>
                            <li><a href="<?php echo $this->createUrl('/admin/houtai/tuijian',array('id'=>1)); ?>">网游推荐</a></li>
                            <li><a href="<?php echo $this->createUrl('/admin/houtai/tuijian',array('id'=>2)); ?>">网游排行</a></li>
                        </ul>
                    </li>

                    <li>
                        <span>单机</span>
                        <ul>
                            <li><a href="<?php echo $this->createUrl('/admin/cgames/index',array('from'=>2, 'status' => 0)); ?>">单机列表</a></li>
                            <li><a href="<?php echo $this->createUrl('/admin/cgames/create',array('from'=>2)); ?>">添加单机</a></li>
                            <li><a href="<?php echo $this->createUrl('/admin/houtai/tuijian',array('id'=>5)); ?>">单机推荐</a></li>
                            <li><a href="<?php echo $this->createUrl('/admin/houtai/tuijian',array('id'=>6)); ?>">单机排行</a></li>
                        </ul>
                    </li>
                    <li>
                        <span>订单列表</span>
                        <ul>
                            <li><a href="<?php echo $this->createUrl('/admin/order/index'); ?>">订单列表</a></li>
                            <li><a href="<?php echo $this->createUrl('/admin/order/alreadypay'); ?>">已发货列表</a></li>
                            <li><a href="<?php echo $this->createUrl('/admin/order/againpay'); ?>">补发道具</a></li>
                        </ul>
                    </li>
                    <li>
                        <span>用户列表</span>
                        <ul>
                            <li><a href="<?php echo $this->createUrl('/admin/user/index'); ?>">用户列表</a></li>
                        </ul>
                    </li>
<!--                    <li>-->
<!--                        <span>游戏列表</span>-->
<!--                        <ul>-->
<!--                            <li><a href="--><?php //echo $this->createUrl('/admin/houtai/index'); ?><!--">游戏列表</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
                    <li>
                        <span>排版管理</span>
                        <ul>
                            <li><a href="<?php echo $this->createUrl('/admin/home/update', array('id'=>1)); ?>">首 页</a></li>
                        </ul> 
                    </li>
                     <li>
                        <span>新闻&攻略</span>
                        <ul>
                            <li><a href="<?php echo $this->createUrl('/admin/zixun/create'); ?>">添加</a></li>
                            <li><a href="<?php echo $this->createUrl('/admin/zixun/index'); ?>">列表</a></li>
                        </ul> 
                    </li>
                    
                    <li>
                        <span>游戏库</span>
                        <ul>
                            <li><a href="<?php echo $this->createUrl('/admin/houtai/tuijian',array('id'=>4)); ?>">最热</a></li>
                        </ul> 
                    </li>
                    <li>
                        <span>礼包</span>
                        <ul>
                            <li><a href="<?php echo $this->createUrl('/admin/libao/index'); ?>">礼包列表</a></li>
                            <li><a href="<?php echo $this->createUrl('/admin/libao/create'); ?>">添加礼包</a></li>
                        </ul> 
                    </li>
                    <li>
                        <span>其它</span>
                        <ul> 
                            <li><a href="<?php echo $this->createUrl('/admin/houtai/tuijian',array('id'=>3)); ?>">友情链接</a></li>
                        </ul> 
                    </li>
                    
                </ul>
            </div>
    </div>
</div>
<!-- nav-over -->
<!-- content begin-->

<?php echo $content; ?>

<!-- content end-->
<!-- footer -->
<div data-options="region:'south',border:false">
    <div id="footer">
        <div class="w980">
            <p class="fl">©2016 游戏. All rights reserved.</p>
        </div>
    </div>
</div> 
</body>
</html> 

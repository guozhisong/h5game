<head class="head clearfix">
 <link href="/static/layer/mobile/need/layer.css" rel="stylesheet">

<meta charset="UTF-8">
<title></title>
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimum-scale=1.0,maximum-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no, email=no" />
<meta name="author" content="fang.zhang">
<meta name="keywords" content="">
<meta name="description" content="">
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script src="/static/layer/layer.js"></script>
<style>

   *{-webkit-tap-highlight-color: rgba(0, 0, 0, 0);margin: 0;padding: 0;}
   a:hover, a:active{color: inherit;text-decoration: none;}
   a:link, a:visited{color: #4d4d4d;}
   .wrap{border-radius: 12px;-webkit-border-radius: 12px;background: #fff;}
   .wrap .icon_back img, .wrap .icon_close img{height: 28px;margin: 4px 0 0 10px}
   .wrap .icon_close{top: 10px;}
   .wrap .hd{height: 40px;position: relative;}
   .wrap .hd h2{font-size: 15px;font-weight: normal;color: #4d4d4d;line-height: 40px;}
   .paymentWayWrap{text-align: left;color: #4d4d4d;}
   .wrap .money{background: #f5f5f5;border-top: 1px solid #efefef;border-bottom: 1px solid #efefef;height: 36px;line-height: 36px;padding: 0 15px;font-size: 13px;font-weight: bold;}
   .wrap .money strong{color: #f5a623;}
   .paymentWay{padding: 0 15px;}
   .paymentWay h2{padding: 10px 0;font-size: 13px;}
   .paymentWay ul{font-size: 0;margin: 0 -7px;}
   .paymentWay li{width: 49.5%;display: inline-block;font-size: 13px;padding: 0 7px;-webkit-box-sizing:border-box;box-sizing:border-box;}
   .paymentWay li a{position: relative; display: block; border: 1px solid #ccc;padding: 11px 0 11px 15%;margin-bottom: 10px;text-decoration: none;}
   .paymentWay li a:after{content: '';display: block;width: 14px;height: 14px;background: url('/img/radio.png') no-repeat;background-size: 100% auto;position: absolute;right: 5px;top: 13px;}
   .paymentWay .checked a{border-color: #89b3e4;}
   .paymentWay .checked a:after{background-image: url('/img/radio-checked.png');}
   .paymentWay li img{width: 20px;margin-right: 5px;vertical-align: middle;}
   .redFont{color: #f00;margin: 3px 0;}
   .paymentWayWrap .btn{margin: 15px;}
   .paymentWayWrap .btn input{width:100%;display: block;height: 44px;line-height: 44px;background: #429afe;font-size: 15px;color: #fff;text-align: center;-webkit-border-radius: 44px;border-radius: 44px;border: 0;}
   .paymentWayWrap .box{padding: 10px 15px;line-height: 1.9;}
   .should_jld{display: none}
   #ewm{text-align: center;padding: 15px 0;}
   .layui-layer{top: 150px!important}
   @media (min-width:600px){
     html{background: #ddd;}
     body{max-width: 400px;margin: 0 auto;background: #fff;height: 100%;}
   }
</style>
</head>
<body>
  <div id="ewm" class="hide" style="display: none;margin-top:0px;"><img src=""></div>
  <!-- <div class="cover"></div> -->
  <div class="wrap">
  <div class="hd">
    <!-- <h2>
      商品购买
    </h2> -->
    <div class="icon_close">
	      <a href="game/login?appid=<?php echo $appid;?>"><img src="/img/back.png"></a>
	  </div>
  </div>

  <form id="myform" action="/pay" method="post" target="_blank" onsubmit="return dsub()">
  <div class="paymentWayWrap">
     <div class="money">购买道具：<strong><?php echo $goodsName; ?> (原价<?php echo $oldMoney; ?>元)</strong></div>
     <div class="money">道具价格：<strong><?php echo $newMoney; ?>元 (<?php echo $discount; ?>折)</strong></div>
     <div class="money">需 支 付：<strong><?php echo $newMoney; ?>元</strong></div>
   <div class="paymentWay">
        <h2>选择支付方式：</h2>
        <ul>
          <li class="checked" data-type='1'><a href="###"><img src="/img/zhifubao.png" alt="">支付宝</a></li>
          <?php if(!$is_mobile){ ?><li data-type='2'><a href="###"><img src="/img/weixin.png" alt="">微信</a></li><?php } ?>
        </ul>
     </div>

     <div class="btn" id="sub_btn">
       <input type="hidden" value="<?php echo $data; ?>" name='data'>
       <input type="hidden" value="1" name='pay_method'>
       <input type="submit" value="立即支付" id="topay">
     </div>

  </div>
  </form>
</div>
<body>

<script>
    $(function() {
    $('.paymentWay li').on('click',function(){
      var type = $(this).data('type');
      $("input[name='pay_method']").val(type);
      if($(this).hasClass('checked')) return;
      $(this).addClass('checked').siblings().removeClass('checked');
    })
  });

  var t;
  var c=1;

  //直充
  function dsub(){
    // $('#topay').attr("disabled", true);
    // $('#topay').css("background-color", "silver");
    if($("input[name='pay_method']").val() == '2'){
        $('#ewm img').attr('src',"/pay/topay?data=<?php echo $data; ?>&pay_method=2");
        layer.open({
          type: 1,
          title: '微信支付二维码',
          closeBtn: 0,
          shadeClose: true,
          area: '180px',
          shade: 0.4,
          content: $('#ewm')
        });
        t=setInterval("ajaxstatus()", 3000);
        return false;
    }

    return true;
  }


	function ajaxstatus() {
    c++;
    if(c > 30)  {
      clearTimeout(t);
      window.location.href ="/game/login?appid=<?php echo $appid; ?>";
    }
    var id = "<?php echo $userOrderid;?>";
    if(id.length){
      $.ajax({
          url: "/pay/order_status",
          type: "POST",
          dataType:"json",
          data: {id:id},
          success: function (res) {
            console.log('res:',res);
            if(res.code == 200)  window.location.href = "/pay/wxstatus?data="+res.data.params;
            else if(res.code == 500) clearTimeout(t);
          },
      });
    }
	}
</script>

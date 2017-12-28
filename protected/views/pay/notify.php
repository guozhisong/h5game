
<!DOCTYPE html>
<html class="no-js">
	<head>
	<meta charset="utf-8">
	<title>支付</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimum-scale=1.0,maximum-scale=1.0" />
	<script type="text/javascript" src="/static/jquery.min.js"></script>
	<style>
	  *{padding:0;margin:0;}
	  ul, ol { list-style: none outside none; margin:0;}
	  body,html{height:100%;width:100%;line-height: 1.5;font-size: 16px;color: #848484;background-color: #fff;}
	  .fh5co-form {padding:60px 0;display:flex;align-items:center;justify-content: center;flex-direction: column;}
	  .fh5co-form h2 {font-size: 18px;margin: 0 0 25px 0;color: #444;line-height: 2;font-weight:normal;}
	  .information{width:100%;background:#f5f5f5;}
	  .information ul li{height:36px;line-height:36px;font-size:15px;padding:0 20px;border-top:1px solid #efefef;}
	  .information ul li:last-child{border-bottom:1px solid #efefef;}
	  .information ul li .fr{color:#444;}
	  .fadeIn{animation-delay:0.2s;}
	  .fadeIn img{width:80px;height:80px;margin-bottom:20px;}
	  .header{position:relative;height:45px;}
	  #return{position:absolute;top:10px;left:10px;width:25px;height:25px;}
	  .fl{float: left;}
	  .fr{float: right;}
	  .animated {
	    animation-duration: 1s;
	    animation-fill-mode: both;
	  }
	  .fadeIn {
	    animation-name: fadeIn;
	  }

	  @keyframes fadeIn {
	    from {
	      opacity: 0;
	    }

	    to {
	      opacity: 1;
	    }
	  }
	  @media screen and (max-width: 768px) {
	    .fh5co-form {
	      padding: 25px 0;
	    }
	    .col-md-4{
	      padding:0;
	    }
	  }
	  @media screen and (min-width: 600px){
	    body{
	      max-width: 400px;
	      margin: 0 auto;
	      background: #fff;
	      height: 100%;
	    }
	    html{
	      background:#ddd;
	    }

	  }
	</style>
	</head>
	<body>
		<div class="header animated fadeIn">
			<a href="<?php echo $return_url;?>"><img id="return" src="/img/back.png"></a>
		</div>
		<div class="container">
			<div class="fh5co-form animated fadeIn">
				<?php if($status==1) { ?>
				<img src="/img/success.png">
				<h2>消费成功</h2>
			 <?php }else if($status==0) { ?>
				<img src="/img/error.png">
				<h2>消费失败</h2>
			 <?php } ?>
				<div class="information">
					<ul>
						<?php if (isset($goods_name)){
							echo "<li><span class='fl'>商品名称:</span><span class='fr'>$goods_name</span></li>";
						} ?>
						<?php if (isset($total_fee)){
							echo "<li><span class='fl'>订单金额:</span><span class='fr'>$total_fee</span></li>";
						} ?>

						<?php if (isset($order_time)){
							echo "<li><span class='fl'>订单时间:</span><span class='fr'>$order_time</span></li>";
					  } ?>
					</ul>
				</div>
			</div>
		</div>
		<script>
			$(function(){
				setTimeout("window.location.href='<?php echo $return_url;?>'",3000)
			})
		</script>
	</body>
</html>

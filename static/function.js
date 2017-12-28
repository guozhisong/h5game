function setTab(name,cursel,n){
	for(i=1;i<=n;i++){
	   var menu=document.getElementById(name+i);
	   var con=document.getElementById("con_"+name+"_"+i);
	   menu.className=i==cursel?"hover":"";
	   con.style.display=i==cursel?"block":"none";
	}
}

$(function(){
	//搜索
	var Wwidth=$(".head").width();
	
	if(Wwidth==320){
		$(".search").width(150)
		$(".search_tx").width(90)
		}else{
		 $(".search").width(Wwidth-185)
		 $(".search_tx").width(Wwidth-250)
		}
	    $(".new_search").width(Wwidth-80)
		$(".new_search_tx").width(Wwidth-140)
	//返回顶部
	 $(window).scroll(function () {
		if ($(window).scrollTop() > 0) {
		$(".backtop").fadeIn(400);//当滑动栏向下滑动时，按钮渐现的时间
		} else {
		$(".backtop").fadeOut(200);//当页面回到顶部第一屏时，按钮渐隐的时间
		}
		});
		$(".backtop").click(function () {
		$('html,body').animate({
		scrollTop : '0px'
		}, 200);//返回顶部所用的时间 
	  });
	  
	  
	
	})
	
	
window.onresize=function(){
	  var Wwidth=$(window).width();
	  if(Wwidth>=640){
		   Wwidth=640;
		   $(".index_banner,.roll img,.pic_box").height(240);
		   
		}else{ 
			var allhehe=Wwidth*4
			$(".index_banner,.roll img,.pic_box").height(allhehe/9)
			}
	 $(".index_banner,.roll,.roll img,.roll p,.roll a,.pic_box,.line").width(Wwidth);
	 
	  var newwidth=$(".head").width();
	  if(newwidth==320){
		$(".search").width(150)
		$(".search_tx").width(90)
	  }else{
		 $(".search").width(newwidth-185)
		 $(".search_tx").width(newwidth-250)
	 }
	   $(".new_search").width(newwidth-80)
		$(".new_search_tx").width(newwidth-140)
}


function register(sex)
{ 
	$(".forget").show();  
	if ($('#mobile').val() == ""){
		$(".tishi").text("请输入帐号");
	}
	else if($("#passwd").val() == ""){
		 $(".tishi").text("请输入密码!");
	}
	else if ($("#passwd").val().length < 6 || $("#passwd").val().length > 15)
        $(".tishi").text("密码请输入6-15位字母或数字!");
    else {
    	$(".forget").hide();
        $("#sex").val(sex);
        $("#frmReg").submit();
    }
} 


function checkInputAmount(obj){
	 $("#ope_tishi").text("");
	 var amount=$.trim($(obj).val()) 
	 var partten =/^([1-9][0-9]*)$/;
     if (!partten.test(amount)){
    	 $("#ope_tishi").text("充值金额为大于0的整数");	
    	 $("#ppc_sum").text('0');
    	 $(obj).val('');
     }else{
         if(parseFloat(amount)>10000){
        	 $("#ope_tishi").text("充值金额不大于10000元");	
        	 $("#ppc_sum").text('0');
        	 $(obj).val('');        	 
         }else{
        	 $("#ope_tishi").text("");	
        	 $("#ppc_sum").text(parseFloat(amount)*100);
         }
    }
}

function chongzhisubmit(){
//	alert('zhifu');
	$("#qibi_form").submit();
	return false;
}

$(document).ready(function (){
	//sex
	$('.sex .man').click(function (){
		$('#sex').val(1);
		$('.sex .man').addClass('on1');
		$('.sex .woman').removeClass('on2');
	});
	$('.sex .woman').click(function (){
		$('#sex').val(2);
		$('.sex .man').removeClass('on1');
		$('.sex .woman').addClass('on2');
	});
});

function showMore(c){
	$('.'+c).show();
	$('.'+c+'_more').hide(); 
	return false;
}

function gamePlay(url){
    //location.href=url;
    window.open(url);
}


function libao(libaoid){
	var hosturl = "http://"+window.location.hostname+'/';
	$.post(hosturl+'libaoget.html', {libaoid:libaoid},function(data){
		if(data == 'ee'){
			alert('请先登录');
		}else{
			$('#libaokey').html("您已领取:"+data);
		}
	});
}

$(document).ready(function (){
	$('#collectgame').click(function(){
		var text = $(this).html();
		var collection = 0;
		if(text =='收藏游戏'){
			//收藏
			collection = 1;
		}
		var gameid = $(this).attr('data-gid');
		$.post('/collection',{iscollection:collection,gameid:gameid}, function (data){
			if(data=='needlogin'){
				alert('请先登录');
			}else{
				var text = $.trim( $('#collectgame').html() );
				if(text =='收藏游戏'){ 
					$('#collectgame').addClass('gray');
					$('#collectgame').html('已收藏');
				}else{ 
					$('#collectgame').removeClass('gray');
					$('#collectgame').html('收藏游戏');
				}
			}
		});
	});
});





var preDelTrId = '';
var defaultMenuTitle='';
jQuery(document).ready(function(){
	jQuery('.delTrLink').click(function (){
		if(confirm("您确定删除该数据？")){ 
			preDelTrId = '#' + jQuery(this).attr('id') + '_tr';
			jQuery.post( jQuery(this).attr('href')+'&ajax=1', function( data ) {
				jQuery(preDelTrId).fadeOut(500);
				location.href=location.href;
			});
		}
		return false;
	}); 
});

jQuery(document).ready(function (){
	jQuery('.my_tree_checkbox').click(function (){
		if(jQuery(this).attr('checked') == 'checked'){
			jQuery(this).parent().find('input').attr('checked', 'checked');
		}else{
			jQuery(this).parent().find('input').attr('checked', false);
		}
	});
});

//comment for debug
//jQuery(document).ready(function (){ 
//	jQuery(".easyui-accordion").accordion("select", defaultMenuTitle);
//});


function doSearch(input,type){ 
	jQuery('#searchform_key').val(type);
	jQuery('#searchform_value').val(input);
	jQuery("form#searchform").submit();
}

jQuery(document).ready(function (){
	jQuery( ".bdclick" ).dblclick(function() {
		showEditMode(jQuery(this));
	});
	jQuery( ".bdclick .updatebtn" ).click(function() {
		showEditMode(jQuery(this).parent().parent());
		  return false;
	});
	jQuery( ".bdclick .savebtn" ).click(function() {
		hideEditMode(jQuery(this), jQuery(this).parent().parent());
		  return false;
	});
	jQuery(".resetpwdbtn").click(function (){
		var resetId=jQuery(this).attr('id');
		resetId = newstr=resetId.replace(/_reset/g,"");
		if(confirm("您确定重置该用户密码吗？")){  
			jQuery.post( jQuery(this).attr('href')+'&ajax=1',{'resetId':resetId}, function( data ) {
				if(data == 'ok'){
					alert("修改成功");
				}else{
					alert("修改失败\n" + data);
				}
				
			});
		}
		return false;
	});
});

function showEditMode(jtr){
	jtr.find('.editMode').show();
	jtr.find('.normalMode').hide();
}

function hideEditMode(jbtn,jtr){
	jQuery("#UserParameter_APP_EMPINFO_EMP_CODE").val(jbtn.attr('id'));
	jQuery("#UserParameter_PARAMETER1").val(jtr.find('.PARAMETER1').val());
	jQuery("#UserParameter_PARAMETER2").val(jtr.find('.PARAMETER2').val());
	jQuery("#UserParameter_PARAMETER3").val(jtr.find('.PARAMETER3').val());
	jQuery("#UserParameter_PARAMETER4").val(jtr.find('.PARAMETER4').val());
	jQuery("#user-parameter-form").submit();
	return false;
}

$.fn.datebox.defaults.formatter = function(date) {  
	var y = date.getFullYear();  
	var m = date.getMonth() + 1;  
	var d = date.getDate();  
	return y + '-' + (m < 10 ? '0' + m : m) + '-' + (d < 10 ? '0' + d : d);  
	};  
	//  
	$.fn.datebox.defaults.parser = function(s) {  
	if (s) {  
	var a = s.split('-');  
	var d = new Date(parseInt(a[0]), parseInt(a[1]) - 1, parseInt(a[2]));  
	return d;  
	} else {  
	return new Date();  
	}  
  
};  
//jQuery(document).ready(function(){
//	jQuery("select.orgTree").multiselect();
//}


function getTreeValue(){
    jQuery('#orgnames').val(jQuery('#orgtree').combotree('getText'));
    return true;
}

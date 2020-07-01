function submitform(formid,btnid,txtid){
	$("#"+btnid).attr('disabled',true);
	$.ajax({
		type:'post',
		url:formid.action,
		data:new FormData(formid),
		crossDomain:true,
		dataType:'json',
		processData: false,
		contentType: false,
		cache: false,
		success:function (data) {
			if(data!=false){
				console.log(data);
				var status="";
				if(data.status==true){
					mytoast(data);
					// alert("Creation Successful.");
					$('#exampleModal').modal('hide');
					load_report();
					//updateToCreate(btnid);
					$("#"+formid.id).trigger('reset');
				}else if(data.status==false){
					// alert(data.data);
					mytoast(data);
				}
				$("#"+txtid).val(0);
			}
		},
		error : function(error){
			JSON.stringify(error);
			if(error.status == 500){
				var str =  JSON.stringify(error.responseText);
				var pos1 = str.indexOf("<p>",str.search("</p>"));
				var pos = str.indexOf("</p>",pos1);
				var res=[];
				res['title']="Error";
				res['message']=str.slice(pos1, pos);
			}else if( error.status == 404){
				var str =  JSON.stringify(error.responseText);
				var pos1 = str.search("<p>");
				var pos = str.search("</p>");
				var res=[];
				res['title']="Error";
				res['message']=str.slice(pos1, pos);
			}
			mytoast(res);
		}
	});
	$("#"+btnid).attr('disabled',false);
}
function active_inactive_records(rowid,isactive,url){
	if(rowid!=null && isactive!=null && url!=null){
		jQuery.ajax({
			type: 'post',
			url: url,
			data: {rowid:rowid,isactive:isactive},
			dataType:'json',
			success: function (data) {
				if(data!=false){
					var status="";
					if(data.status==true){
						status="success";
						var htmldata="";
						if (isactive==0){
							htmldata +="<i id='activeInactive"+rowid+"' class='fa fa-toggle-on fa-2x' onclick='active_inactive("+rowid+",1)'></i>&nbsp;&nbsp;&nbsp;&nbsp;"+
								"<i id='edit"+rowid+"' class='fa fa-edit fa-2x' onclick='edit("+rowid+")'></i>&nbsp;&nbsp;&nbsp;&nbsp;"+
								"</td></tr>";
						}else if (isactive==1){
							htmldata +="<i class='fa fa-toggle-off fa-2x' onclick='active_inactive("+rowid+",0)'></i>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
						}
						$("#action"+rowid).html(htmldata);
					}else{
						status="error";
					}
				}
			}
		});
	}
}
function mytoast(res) {
	var title = res.title;
	var msg = res.message;
	if(res.status== true){
		// toastr.options.rtl = true;
		toastr.options.positionClass = 'toast-bottom-right';
		toastr.success(msg,title);
		toastr.options.showMethod = 'slideDown';

	}else {
		// toastr.options.rtl = true;
		toastr.options.positionClass = 'toast-bottom-right';
		toastr.error(msg,title);
		toastr.options.showMethod = 'slideDown';
	}
}


function number_validate(id) {
	$("#"+id).keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) || e.which.length >6) {
			return false;
		}
	})
}
function percentage_validate(id) {
	$("#"+id).keypress(function (e) {
		if (e.which != 8 && e.which != 0 &&  e.which != 37 && e.which != 46 && (e.which < 48 || e.which > 57) || e.which.length >6 ) {
			return false;
		}
	})
}
function alfa_numeric(id) {
	$("#"+id).keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)&& (e.which < 48 || e.which > 57) && e.which != 32 && e.which != 38 && e.which != 40 && e.which != 41 && e.which != 45 && e.which != 47 && e.which != 46 ) {
			return false;
		}
	});
}
function charachters_validate(id) {
	$("#"+id).keypress(function (e) {
		if (e.which != 8 && e.which != 0 && e.which != 32 && e.which != 13 &&(e.which < 65 || e.which > 90 ) && (e.which < 97 || e.which > 122)) {
			return false;
		}
	});
}
function url_validate(id) {
	$("#"+id).keypress(function (e) {
		if (e.which != 8 && e.which != 0  && (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)&& (e.which < 48 || e.which > 57) && e.which != 32 && e.which != 38 && e.which != 40 && e.which != 41 && e.which != 47 && e.which != 46 && e.which != 58) {
			$(".errormsg_"+id).html("Only : , / and . are allowed").css({'color':'red'}).show().fadeOut(2000);
			return false;
		}
	});
}
function email_validate(id) {
	$("#"+id).keypress(function (e) {
		if (e.which != 8 && e.which != 0  && (e.which < 64 || e.which > 90) && (e.which < 97 || e.which > 122)&& (e.which < 48 || e.which > 57) && e.which != 32 && e.which != 38 && e.which != 40 && e.which != 41 && e.which != 46){
			$(".errormsg_"+id).html("Only @ and . are allowed").css({'color':'red'}).show().fadeOut(2000);
			return false;
		}
	});
}
function epf_number_validate(id) {
	$("#"+id).keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)&& (e.which < 47 || e.which > 57) && e.which != 32 && e.which != 38 && e.which != 40 && e.which != 41 && e.which != 45 && e.which != 47 && e.which != 46 ) {
			$(".errormsg_"+id).html("Alphanumeric Only").css({'color':'red'}).show().fadeOut(2000);
			return false;
		}
	});
}
function bloodgroup_validate(id) {
	$("#"+id).keypress(function (e) {
		if (e.which != 8 && (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)&& (e.which < 47 || e.which > 57) && e.which != 45 && e.which != 43 ) {
			$(".errormsg_"+id).html("Alphanumeric Only").css({'color':'red'}).show().fadeOut(2000);
			return false;
		}
	});
}
function password_validate(id) {
	$("#"+id).keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 64 || e.which > 90) && (e.which < 97 || e.which > 122)&& (e.which < 44 || e.which > 57) && e.which != 32 && e.which != 38 && e.which != 40 && e.which != 41 &&  e.which != 47 &&  e.which != 95 ) {
			$(".errormsg_"+id).html("Alphanumeric Only").css({'color':'red'}).show().fadeOut(2000);
			return false;
		}
	});
}
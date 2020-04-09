function submitform(formid,btnid,txtid){
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
					// mytoast(data);
					$('#exampleModal').modal('hide')
					load_report();
					//updateToCreate(btnid);
					$("#"+formid.id).trigger('reset');
				}else if(data.status==false){
					// mytoast(data);
					alert(data);
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
				res['message']="Error";
				res['data']=str.slice(pos1, pos);
			}else if( error.status == 404){
				var str =  JSON.stringify(error.responseText);
				var pos1 = str.search("<p>");
				var pos = str.search("</p>");
				var res=[];
				res['message']="Error";
				res['data']=str.slice(pos1, pos);
			}
		}
	});
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

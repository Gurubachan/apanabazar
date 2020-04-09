function load_category(id,path){
    jQuery.ajax({
        type:'post',
        url:path + "Category/load_category",
        dataType:'json',
        success:function (data) {
            if (data!=false){
                var htmldata="";
                for (var i in data){
                    htmldata+=data[i];
                }
                jQuery("#"+id).html(htmldata);
            }
        }
    })
}
function load_subcategory(id,categoryid,path){
    jQuery.ajax({
        type:'post',
        url:path + "Subcategory/load_subcategory",
        data:{catid:categoryid},
        dataType:'json',
        success:function (data) {
            if (data!=false){
                var htmldata="";
                for (var i in data){
                    htmldata+=data[i];
                }
                jQuery("#"+id).html(htmldata);
            }
        }
    })
}
function load_company(id,path){
	jQuery.ajax({
		type:'post',
		url:path + "Company/load_company",
		dataType:'json',
		success:function (data) {
			if (data!=false){
				var htmldata="";
				for (var i in data){
					htmldata+=data[i];
				}
				jQuery("#"+id).html(htmldata);
			}
		}
	})
}
function load_vendor_flag(id,path){
	jQuery.ajax({
		type:'post',
		url:path + "Vendor_flag/load_vendor_flag",
		dataType:'json',
		success:function (data) {
			if (data!=false){
				var htmldata="";
				for (var i in data){
					htmldata+=data[i];
				}
				jQuery("#"+id).html(htmldata);
			}
		}
	})
}

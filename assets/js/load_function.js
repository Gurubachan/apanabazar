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
function load_vendor_type(id,path){
	jQuery.ajax({
		type:'post',
		url:path + "Vendor_type/load_vendor_type",
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
function load_product(id,subcategoryid,path){
	jQuery.ajax({
		type:'post',
		url:path + "Product/load_product",
		data:{subcatid:subcategoryid},
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
function load_attributegroup(id,path){
	jQuery.ajax({
		type:'post',
		url:path + "Attributegroup/load_attributegroup",
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
function load_attribute(id,path){
	jQuery.ajax({
		type:'post',
		url:path + "Attribute/load_attribute",
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
function load_state(id,path){
	jQuery.ajax({
		type:'post',
		url:path + "State/load_state",
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
function load_district(id,stateid,path){
	jQuery.ajax({
		type:'post',
		url:path + "District/load_dist",
		data:{stateid:stateid},
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
function load_city(id,districtid,path){
	jQuery.ajax({
		type:'post',
		url:path + "City/load_city",
		data:{districtid:districtid},
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
function load_manufacturer(id,path){
	jQuery.ajax({
		type:'post',
		url:path + "Manufacture/load_manufacture",
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
function load_vendor(id,path){
	jQuery.ajax({
		type:'post',
		url:path + "VendorRegistration/load_vendors",
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
function load_unit(id,path){
	jQuery.ajax({
		type:'post',
		url:path + "Unit/load_unit",
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
function load_item(id,productid,brandid,path){
	jQuery.ajax({
		type:'post',
		url:path + "Item/load_items",
		data:{productid:productid,brandid:brandid},
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
function load_productlist(id,path){
	jQuery.ajax({
		type:'post',
		url:path + "Product/load_product_list",
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

// function load_item(id,productid,vendorid,brandid,path){
// 	jQuery.ajax({
// 		type:'post',
// 		url:path + "Inventory/load_items",
// 		data:{productid:productid,vendorid:vendorid,brandid:brandid},
// 		dataType:'json',
// 		success:function (data) {
// 			if (data!=false){
// 				var htmldata="";
// 				for (var i in data){
// 					htmldata+=data[i];
// 				}
// 				jQuery("#"+id).html(htmldata);
// 			}
// 		}
// 	})
// }
function load_trackby(id,path){
	jQuery.ajax({
		type:'post',
		url:path + "Trackby/load_trackby",
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
function load_taxrate(id,path){
	jQuery.ajax({
		type:'post',
		url:path + "Item/load_taxrate",
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
function load_variant(id,path){
	jQuery.ajax({
		type:'post',
		url:path + "Variant/load_variant",
		dataType:'json',
		success:function (data) {
			if (data!=false){
				// console.log(data);
				var htmldata="";
				for (var i in data){
					htmldata+=data[i];
				}
				jQuery("#"+id).html(htmldata);
			}
		}
	})
}

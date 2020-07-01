<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        load_vendorlist();
    });
        function load_vendorlist() {
            $.ajax({
                type:'post',
                url:'<?=base_url("VendorRegistration/report_vendors_data")?>',
                dataType:'json',
                success:function (f) {
                    var j=0;
                    var htmldata ="";
                    for(var i in f){
                        j++;
                        var img ="<img src='<?=base_url("assets/images/vendor/")?>"+f[i].photograph+".png' alt='image' height='50' width='50'>";
                    // htmldata+="<tr><td>"+j+"</td><td>"+f[i].vendorname+"</td><td>"+f[i].vendoraddress+"</td><td>"+f[i].vendorcontacts+"</td><td>"+f[i].vendormail+"</td><td>"+f[i].ownername+"</td><td>"+f[i].pincode+"</td><td>"+img+"</td><td>"+f[i].gstnumber+"</td><td>"+f[i].pannumber+"</td><td>"+f[i].aadharnumber+"</td><td>"+f[i].geolocation+"</td></tr>";
                    htmldata+="<tr'><td>"+j+"</td><td>"+f[i].vendorname+" <span class='badge-primary badge-pill' style='cursor: pointer' data-toggle=\"modal\" data-original-title=\"test\" data-target=\"#vendorDetailsModal\" onclick='load_vendor_details("+f[i].id+")'>Details</span></td><td>"+f[i].vendorcontacts+"</td><td>"+f[i].vendormail+"</td><td>"+img+"</td><td><span class='badge-info badge-pill' style='cursor: pointer' data-toggle=\"modal\" data-original-title=\"test\" data-target=\"#inventoryDetailsModal\" onclick='load_vendor_inventory_details("+f[i].id+")'>Item list </span></td></tr>";
                    }
                    $('#load_vendordata').html(htmldata);
                }
            });
        }
        function load_vendor_details(id) {
           $.ajax({
               type:'post',
               url:'<?=base_url("VendorRegistration/vendor_details")?>',
               data:{vendorid:id},
               dataType: 'json',
               success:function (f) {
                   // console.log(f);
                  $("#businessname").html(f[0].vendorname);
               }
           });
        }
        function load_vendor_inventory_details(id) {
           $.ajax({
               type:'post',
               url:'<?=base_url("VendorRegistration/vendor_inventory_details")?>',
               data:{vendorid:id},
               dataType: 'json',
               success:function (f) {
                var htmldata = "";
                var j=0;
                for(var i in f){
                    // console.log(f[i]);
                    j++;
                    // for(var k in f[i].itemvariant.variantdetails){
                    //     console.log(f[i].itemvariant.variantdetails[k].variantdetails);
                    // }
                    // console.log(f[i].itemvariant.variantdetails.variantdetails);
                    console.log(f[i].item);
                    // var variant = f[i].itemvariant.variantdetails;
                    // for(var v in variant){
                    //     // console.log(variant);
                    //     console.log(variant.variantdetails[0].variantname);
                    // }

                    // htmldata+="<tr><td>"+j+"</td><td>"+f[i].item.itemname+"</td><td>"+variant.variantdetails[0].variantname+"-"+variant.variantdetails[0].variantvalue+"</td></tr>";
                }
                  $("#load_vendor_wise_item_details").html(htmldata);
               }
           });
        }
    </script>

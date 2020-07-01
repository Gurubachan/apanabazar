<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->adminLogin['usertype']== "Vendor"){
    if($this->session->adminLogin['iscomplete']==0 && $this->session->ismodalshown == 0){
        $ses = 0;
    }else{
        $ses = 1;
    }
}
$usertype = $this->session->adminLogin['usertype'];
?>
<script>
	function view_details_orders(type,id) {
		$("#order_details_div").show();
		$("#order_details_card_header").removeAttr('class');
		switch (type) {
			case 1:
				$("#order_details_card_header").addClass('card-header bg-secondary');
				$("#order_details_card_heading").html('Total Order Details');
				break;
			case 2:
				$("#order_details_card_header").addClass('card-header bg-warning');
				$("#order_details_card_heading").html('Total Pending Order Details');
				break;
			case 3:
				$("#order_details_card_header").addClass('card-header bg-success');
				$("#order_details_card_heading").html('Total Delivery Details');
				break;
			case 4:
				$("#order_details_card_header").addClass('card-header bg-primary');
				$("#order_details_card_heading").html('Total Canceled Order Details');
				break;
		}
    }
      var usertype = "<?=$usertype?>";
      if(usertype == "Vendor"){
          load_modal();
          function load_modal() {
              let ses = <?=$ses?>;
              if( ses == 0){
                  $.ajax({
                      type:'post',
                      url:'<?=base_url("Vendor/check_registration_details")?>',
                      success:function (f) {
                          if(f){
                              $('#loadVendorCompleteModal').html(f);
                          }
                      }
                  });
              }
          }
      }

</script>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<h1>Dashboard loads here</h1>

<?php
if($this->session->adminLogin['iscomplete']!=false){
    echo 'true';
}else{
    ?>
    <!-- Modal -->
   <div id="loadVendorCompleteModal"></div>

    <?php
}
?>

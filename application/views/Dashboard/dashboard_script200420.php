<?php
if($this->session->adminLogin['iscomplete']==null){
    ?>
    <script>
        // $(window).on('load',function(){
        //     $('#myModal').modal('show');
        // });
        $.ajax({
            type:'post',
            url:'<?=base_url("Vendor/")?>',
            dataType:'json',
            success:function (f) {
                if(f!=null){

                }
            }
        });
    </script>
    <?php
}
?>
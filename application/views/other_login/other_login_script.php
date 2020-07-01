<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<script type="text/javascript">
    var userid = 0;
    var usertype =0;
    $('#frmOtherLogin').submit(function (e) {
        e.preventDefault();
        var frm = $('#frmOtherLogin').serialize();
        $.ajax({
            type:'post',
            url:'<?=base_url("welcome/other_user_verification")?>',
            data:frm,
            dataType:'json',
            success:function (f) {
                console.log(f);
                if(f.status == true){
                    console.log(f.userid);
                    userid=f.userid;
                    usertype =f.usertypeid;
                    $("#frmOtherLogin").remove();
                    $("#frmOtherOtpVerification").show();
                }
            }
        });
    });
    $('#frmOtherOtpVerification').submit(function (e) {
        e.preventDefault();
        var frm = $('#frmOtherOtpVerification').serialize()+ '&' + $.param({'userid':userid,usertype:usertype});
        $.ajax({
            type:'post',
            url:'<?=base_url("welcome/other_user_otp_verificaton")?>',
            data:frm,
            dataType:'json',
            success:function (f) {
                console.log(f);
                if(f.status == true){
                    window.location.href="<?=base_url('Dashboard/')?>";
                }
            }
        });
    });
    //$('#frmResetPassword').submit(function (e) {
    //    e.preventDefault();
    //    var frm = $('#frmResetPassword').serialize()+ '&' + $.param({'userid':userid});
    //    $.ajax({
    //        type:'post',
    //        url:'<?//=base_url("welcome/password_reset")?>//',
    //        data:frm,
    //        dataType:'json',
    //        success:function (f) {
    //            console.log(f);
    //            if(f.status == true){
    //                window.location.href="<?//=base_url('Dashboard/')?>//";
    //            }
    //        }
    //    });
    //});
</script>
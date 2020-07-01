<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<script type="text/javascript">
    var userid = 0;
    $('#frmForgetPassword').submit(function (e) {
        e.preventDefault();
        var frm = $('#frmForgetPassword').serialize();
        $.ajax({
            type:'post',
            url:'<?=base_url("welcome/user_verification")?>',
            data:frm,
            dataType:'json',
            success:function (f) {
                console.log(f);
                if(f.status == true){
                    console.log(f.userid);
                    userid=f.userid;
                    $("#userVerification").remove();
                    $("#otpVerification").show();
                }
            }
        });
    });
    $('#frmOtpVerification').submit(function (e) {
        e.preventDefault();
        var frm = $('#frmOtpVerification').serialize()+ '&' + $.param({'userid':userid});
        $.ajax({
            type:'post',
            url:'<?=base_url("welcome/otp_verificaton")?>',
            data:frm,
            dataType:'json',
            success:function (f) {
                console.log(f);
                if(f.status == true){
                    $("#otpVerification").remove();
                    $("#passwordVerification").show();
                }
            }
        });
    });
    $('#frmResetPassword').submit(function (e) {
        e.preventDefault();
        var frm = $('#frmResetPassword').serialize()+ '&' + $.param({'userid':userid});
        $.ajax({
            type:'post',
            url:'<?=base_url("welcome/password_reset")?>',
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
</script>
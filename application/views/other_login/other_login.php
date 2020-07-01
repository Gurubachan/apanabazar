<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.pixelstrap.com/multikart/back-end/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Mar 2020 12:08:00 GMT -->

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="<?=base_url('assets/images/dashboard/favicon.png')?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?=base_url('assets/images/dashboard/favicon.png')?>" type="image/x-icon">
    <title>Apanabazar</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/all.css')?>">

    <!-- Flag icon-->
    <!--    <link rel="stylesheet" type="text/css" href="--><?//=base_url('assets/css/themify.css')?><!--">-->

    <!-- slick icon-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/slick.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/slick-theme.css')?>">

    <!-- jsgrid css-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/jsgrid.css')?>">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.css')?>">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/admin.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/toastr.css')?>">
</head>

<body>

<!-- page-wrapper Start-->
<div class="page-wrapper">
    <div class="authentication-box">
        <div class="container">
            <div class="row">
                <div class="col-md-5 p-0 card-left">
                    <div class="card bg-primary-blue" id="cardHead">
                        <div class="svg-icon">

                        </div>

                        <div class="single-item">
                            <div>
                                <div>
                                    <h3>Welcome to ApanaBazar</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Lorem Ipsum has been the industry's standard dummy.</p>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <h3>Welcome to ApanaBazar</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Lorem Ipsum has been the industry's standard dummy.</p>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <h3>Welcome to ApanaBazar</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Lorem Ipsum has been the industry's standard dummy.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 p-0 card-right">
                    <div class="card tab2-card-blue" id="usertypelabel">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                <li class="nav-item" id="navItemVendor">
                                    <a class="nav-link active" id="top-profile-tab" data-toggle="tab"
                                       href="#top-profile" role="tab" aria-controls="top-profile"
                                       aria-selected="true"><span class="fa fa-user"></span>&nbsp;&nbsp;&nbsp;Others Login</a>
                                </li>
<!--                                <li class="nav-item" id="navItemAdmin">-->
<!--                                    <a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact"-->
<!--                                       role="tab" aria-controls="top-contact" aria-selected="false"><span-->
<!--                                                class="fa fa-user"></span>&nbsp;Admin Login</a>-->
<!--                                </li>-->
                            </ul>
                            <div class="tab-content" id="top-tabContent">
                                <div class="tab-pane fade show active" id="top-profile" role="tabpanel"
                                     aria-labelledby="top-profile-tab">
                                    <form class="form-horizontal auth-form" id="frmOtherLogin">
                                        <div class="form-group">
                                            <select class="form-control" name="txtOtherUsertype" id="txtOtherUsertype">
                                                <option value="">Select</option>
                                                <option value="1">Aggregator</option>
                                                <option value="2">Delivery Boy</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input required="" name="txtUserVerification" type="text"
                                                   class="form-control" placeholder="Enter mobile or emailid" id="txtUserVerification">
                                        </div>

                                        <div class="form-terms">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="customControlAutosizing1">
<!--                                                <label class="custom-control-label"-->
<!--                                                       for="customControlAutosizing1">Remember me</label>-->
                                                <a href="<?=base_url('welcome/')?>" class="forgot-pass txt-primary-blue">Admin Login</a><br>
<!--                                                <a href="--><?//=base_url('welcome/forgot_password')?><!--" class="forgot-pass txt-primary-blue">Lost your password?</a>-->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-button ml-3">
                                                <button class="btn btn-primary-blue" type="submit">Login</button>
                                            </div>
                                            <div class="form-button" style="display: none;" id="spinner_shows">
                                                <span style="padding-left: 85px;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
                                            </div>
                                        </div>
                                        <a href="<?=base_url('Vendor/new_registrtion')?>" class="btn btn-default forgot-pass txt-primary-blue" id="vendorRegister"><u>Register</u></a>
                                        <div class="form-footer">
                                            <span>Or Login up with social platforms</span>
                                            <ul class="social-blue">
                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                            </ul>
                                        </div>
                                    </form>
                                    <form class="form-horizontal auth-form" id="frmOtherOtpVerification" style="display: none;">
                                        <div class="form-group">
                                            <input required="" name="txtOtherUserOtpVerification" type="text"
                                                   class="form-control" placeholder="Enter mobile or emailid" id="txtOtherUserOtpVerification">
                                        </div>

                                        <div class="form-terms">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="customControlAutosizing1">
                                                <!--                                                <label class="custom-control-label"-->
                                                <!--                                                       for="customControlAutosizing1">Remember me</label>-->
                                                <a href="<?=base_url('welcome/')?>" class="forgot-pass txt-primary-blue">Admin Login</a><br>
                                                <!--                                                <a href="--><?//=base_url('welcome/forgot_password')?><!--" class="forgot-pass txt-primary-blue">Lost your password?</a>-->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-button ml-3">
                                                <button class="btn btn-primary-blue" type="submit">Login</button>
                                            </div>
                                            <div class="form-button" style="display: none;" id="spinner_shows">
                                                <span style="padding-left: 85px;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
                                            </div>
                                        </div>
                                        <a href="<?=base_url('Vendor/new_registrtion')?>" class="btn btn-default forgot-pass txt-primary-blue" id="vendorRegister"><u>Register</u></a>
                                        <div class="form-footer">
                                            <span>Or Login up with social platforms</span>
                                            <ul class="social-blue">
                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- latest jquery-->
<script src="<?=base_url('assets/js/jquery-3.3.1.min.js')?>"></script>

<!-- Bootstrap js-->
<script src="<?=base_url('assets/js/popper.min.js')?>"></script>
<script src="<?=base_url('assets/js/bootstrap.js')?>"></script>

<!-- feather icon js-->
<script src="<?=base_url('assets/js/icons/feather-icon/feather.min.js')?>"></script>
<script src="<?=base_url('assets/js/icons/feather-icon/feather-icon.js')?>"></script>

<!-- Sidebar jquery-->
<script src="<?=base_url('assets/js/sidebar-menu.js')?>"></script>
<script src="<?=base_url('assets/js/slick.js')?>"></script>

<!-- Jsgrid js-->
<script src="<?=base_url('assets/js/jsgrid/jsgrid.min.js')?>"></script>
<script src="<?=base_url('assets/js/jsgrid/griddata-invoice.js')?>"></script>
<script src="<?=base_url('assets/js/jsgrid/jsgrid-invoice.js')?>"></script>

<!-- lazyload js-->
<script src="<?=base_url('assets/js/lazysizes.min.js')?>"></script>

<!--right sidebar js-->
<script src="<?=base_url('assets/js/chat-menu.js')?>"></script>

<!--script admin-->
<script src="<?=base_url('assets/js/admin-script.js')?>"></script>
<script src="<?=base_url('assets/js/toastr.js')?>"></script>
<script>
    $('.single-item').slick({
        arrows: false,
        dots: true
    });
    $("#navItemVendor").click(function () {
        $("#cardHead").removeClass('bg-primary').addClass('bg-primary-blue');
        $("#usertypelabel").removeClass('tab2-card').addClass('tab2-card-blue');
    });
    $("#navItemAdmin").click(function () {
        $("#cardHead").removeClass('bg-primary-blue').addClass('bg-primary');
        $("#usertypelabel").removeClass('tab2-card-blue').addClass('tab2-card');
    });
    $("#frmAdminLogin").submit(function (e) {
        e.preventDefault();
        $("#spinner_shows_admin").show();
        $.ajax({
            type: 'post',
            url:"<?=base_url('Admin/check_login')?>",
            data: new FormData(this),
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                $("#spinner_shows_admin").hide();
                if (data.status==true){
                    window.location.href="<?=base_url('Dashboard/')?>";
                } else {
                    // alert(data.message);
                    mytoast(data);
                }
            },
            error : function(error){
                $("#spinner_shows_admin").hide();
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
    });
    $("#frmVendorLogin").submit(function (e) {
        $("#spinner_shows").show();
        e.preventDefault();
        $.ajax({
            type: 'post',
            url:"<?=base_url('Vendor/check_login')?>",
            data: new FormData(this),
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                $("#spinner_shows").hide();
                if (data.status==true){
                    window.location.href="<?=base_url('Dashboard/')?>";
                } else {
                    // alert(data.message);
                    mytoast(data);
                }
            },
            error : function(error){
                $("#spinner_shows").hide();
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
    });
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
</script>
</body>


</html>

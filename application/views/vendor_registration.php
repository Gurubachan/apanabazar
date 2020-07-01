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

    <!-- toastr css-->
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
                                            aria-selected="true"><span class="fa fa-user"></span>Vendor Registration</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel"
                                        aria-labelledby="top-profile-tab">
                                        <form class="form-horizontal auth-form" id="frmVendorRegistration" autocomplete="off">
                                            <div class="form-group">
                                                <input type="hidden" name="txtid" id="txtid" value="0">
                                                <input type="hidden" name="txtLng" id="txtLng" value="0">
                                                <input type="hidden" name="txtLat" id="txtLat" value="0">
                                                <select class="form-control" id="inputVendorTypeId"  name="inputVendorTypeId">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required name="txtVendorName" id="txtVendorName"
                                                       class="form-control" placeholder="Business Name" minlength="3" maxlength="50">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required name="inputContactNumber" id="inputContactNumber"
                                                       class="form-control" placeholder="Mobile" minlength="10" maxlength="10">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" required name="inputEmail" id="inputEmail"
                                                       class="form-control" placeholder="Email" >
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="password" required name="txtPassword" id="txtPassword"
                                                               class="form-control" placeholder="Password" minlength="8" maxlength="16">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="password" required name="txtConfirmPassword" id="txtConfirmPassword"
                                                               class="form-control" placeholder="Confirm Password" minlength="8" maxlength="16">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-button">
                                                    <button class="btn btn-primary-blue" type="submit" id="btnSubmit">Register</button>
                                                </div>
                                                <div class="form-button" style="display: none;" id="spinner_shows_vendor_registration">
                                                    <span style="padding-left: 85px;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
                                                </div>
                                            </div>
                                            <a href="<?=base_url('Welcome/')?>" class="btn btn-default forgot-pass txt-primary-blue" id="vendorRegister">Login</a>
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

    <!--script admin-->
    <script src="<?=base_url('assets/js/toastr.js')?>"></script>
    <script>
        $(function () {
            vendor_type('inputVendorTypeId',"<?=base_url()?>");
        });
        function vendor_type(id,path){
            jQuery.ajax({
                type:'post',
                url:path + "Vendor_type/vendor_type",
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

        function getLocation() {
            // if (navigator.geolocation) {
            //     navigator.geolocation.getCurrentPosition(showPosition);
            // } else {
            //    let data=[];
            //     data['title']="Error";
            //     data['message']="Geo location failed";
            //     data['code']="404";
            //     mytoast(data);
            // }
        }
        //function showPosition(position) {
        //    $("#txtLat").val(position.coords.latitude);
        //    $("#txtLng").val(position.coords.longitude);
        //    $.ajax({
        //        type: 'post',
        //        url:"<?//=base_url('Vendor/new_registration')?>//",
        //        data: new FormData(this),
        //        dataType: 'json',
        //        processData: false,
        //        contentType: false,
        //        cache: false,
        //        success: function (data) {
        //            $('#spinner_shows_vendor_registration').hide();
        //            if (data.status==true){
        //                window.location.href="<?//=base_url('Dashboard/')?>//";
        //            } else {
        //                mytoast(data);
        //                console.log(data);
        //            }
        //        },
        //        error : function(error){
        //            $('#spinner_shows_vendor_registration').hide();
        //            JSON.stringify(error);
        //            if(error.status == 500){
        //                var str =  JSON.stringify(error.responseText);
        //                var pos1 = str.indexOf("<p>",str.search("</p>"));
        //                var pos = str.indexOf("</p>",pos1);
        //                var res=[];
        //                res['title']="Error";
        //                res['message']=str.slice(pos1, pos);
        //                res['code']=500;
        //            }else if( error.status == 404){
        //                var str =  JSON.stringify(error.responseText);
        //                var pos1 = str.search("<p>");
        //                var pos = str.search("</p>");
        //                var res=[];
        //                res['title']="Error";
        //                res['message']=str.slice(pos1, pos);
        //                res['code']=400;
        //            }
        //            mytoast(res);
        //        }
        //    });
        //    $('#spinner_shows_vendor_registration').show();
        //
        //}
		$("#frmVendorRegistration").submit(function (e) {
			e.preventDefault();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                let data=[];
                data['title']="Error";
                data['message']="Geo location failed";
                data['code']="404";
                mytoast(data);
            }
            function showPosition(position) {
                $("#txtLat").val(position.coords.latitude);
                $("#txtLng").val(position.coords.longitude);
                var frm = $('#frmVendorRegistration').serialize();
                $.ajax({
                    type: 'post',
                    url:"<?=base_url('Vendor/new_registration')?>",
                    // data: new FormData(),
                    data:frm,
                    dataType: 'json',
                    // processData: false,
                    // contentType: false,
                    // cache: false,
                    success: function (data) {
                        $('#spinner_shows_vendor_registration').hide();
                        if (data.status==true){
                            window.location.href="<?=base_url('Dashboard/')?>";
                        } else {
                            mytoast(data);
                            console.log(data);
                        }
                    },
                    error : function(error){
                        $('#spinner_shows_vendor_registration').hide();
                        JSON.stringify(error);
                        if(error.status == 500){
                            var str =  JSON.stringify(error.responseText);
                            var pos1 = str.indexOf("<p>",str.search("</p>"));
                            var pos = str.indexOf("</p>",pos1);
                            var res=[];
                            res['title']="Error";
                            res['message']=str.slice(pos1, pos);
                            res['code']=500;
                        }else if( error.status == 404){
                            var str =  JSON.stringify(error.responseText);
                            var pos1 = str.search("<p>");
                            var pos = str.search("</p>");
                            var res=[];
                            res['title']="Error";
                            res['message']=str.slice(pos1, pos);
                            res['code']=400;
                        }
                        mytoast(res);
                    }
                });
                $('#spinner_shows_vendor_registration').show();
            }
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

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
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/themify.css')?>">

    <!-- slick icon-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/slick.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/slick-theme.css')?>">

    <!-- jsgrid css-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/jsgrid.css')?>">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.css')?>">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/admin.css')?>">

</head>

<body>

    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="authentication-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 p-0 card-left">
                        <div class="card bg-primary">
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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 p-0 card-right">
                        <div class="card tab2-card">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="top-profile-tab" data-toggle="tab"
                                            href="#top-profile" role="tab" aria-controls="top-profile"
                                            aria-selected="true"><span class="fas fa-user"></span> <span>Login</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact"
                                            role="tab" aria-controls="top-contact" aria-selected="false"><span
                                                class="fas fa-unlock-alt"></span> <span>Register</span></a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel"
                                        aria-labelledby="top-profile-tab">
                                        <form class="form-horizontal auth-form" id="frmLogin">
                                            <div class="form-group">
                                                <input required="" name="username" type="text"
                                                    class="form-control" placeholder="Email Id or Mobile Number" id="exampleInputEmail1">
                                            </div>
                                            <div class="form-group">
                                                <input required="" name="password" type="password"
                                                    class="form-control" placeholder="Password">
                                            </div>
                                            <div class="form-terms">
                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customControlAutosizing">
                                                    <label class="custom-control-label"
                                                        for="customControlAutosizing">Remember me</label>
                                                    <a href="#" class="btn btn-default forgot-pass">lost your
                                                        password</a>
                                                </div>
                                            </div>
                                            <div class="form-button">
                                                <button class="btn btn-primary" type="submit">Login</button>
                                            </div>
                                            <div class="form-footer">
                                                <span>Or Login up with social platforms</span>
                                                <ul class="social">
                                                    <li><a class="fab fa-facebook-f" style="color:#ff8084" href="#"></a></li>
                                                    <li><a class="fab fa-twitter" style="color:#ff8084" href="#"></a></li>
                                                    <li><a class="fab fa-instagram" style="color:#ff8084" href="#"></a></li>
                                                    <li><a class="fab fa-pinterest" style="color:#ff8084" href="#"></a></li>
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="top-contact" role="tabpanel"
                                        aria-labelledby="contact-top-tab">
                                        <form class="form-horizontal auth-form">
                                            <div class="form-group">
                                                <input required="" name="login[username]" type="email"
                                                    class="form-control" placeholder="Username"
                                                    id="exampleInputEmail12">
                                            </div>
                                            <div class="form-group">
                                                <input required="" name="login[password]" type="password"
                                                    class="form-control" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <input required="" name="login[password]" type="password"
                                                    class="form-control" placeholder="Confirm Password">
                                            </div>
                                            <div class="form-terms">
                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customControlAutosizing1">
                                                    <label class="custom-control-label"
                                                        for="customControlAutosizing1"><span>I agree all statements in
                                                            <a href="#" class="pull-right">Terms &amp;
                                                                Conditions</a></span></label>
                                                </div>
                                            </div>
                                            <div class="form-button">
                                                <button class="btn btn-primary" type="submit">Register</button>
                                            </div>
                                            <div class="form-footer">
                                                <span>Or Sign up with social platforms</span>
                                                <ul class="social">
                                                    <li><a class="fab fa-facebook-f" style="color:#ff8084" href="#"></a></li>
                                                    <li><a class="fab fa-twitter" style="color:#ff8084" href="#"></a></li>
                                                    <li><a class="fab fa-instagram" style="color:#ff8084" href="#"></a></li>
                                                    <li><a class="fab fa-pinterest" style="color:#ff8084" href="#"></a></li>
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

    <!--Font-Awesome js-->
    <<script src="<?=base_url('assets/js/all.js')?>"></script>

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
    <script>
        $('.single-item').slick({
            arrows: false,
            dots: true
        });
        $("#frmLogin").submit(function (e) {
			e.preventDefault();
			$.ajax({
				type: 'post',
				url:"<?=base_url('Admin/check_login')?>",
				data: new FormData(this),
				dataType: 'json',
				processData: false,
				contentType: false,
				cache: false,
				success: function (data) {
					if (data.status==true){
						window.location.href="<?=base_url('Dashboard/')?>";
					} else {
						alert(data.message);
					}
				}
			});
		});
    </script>

</body>


</html>

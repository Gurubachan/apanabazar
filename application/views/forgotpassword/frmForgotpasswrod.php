<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Right sidebar Ends-->
    <!-- Container-fluid starts-->
    <div class="container-fluid" style="background-color: white;min-height: 1000px;">
        <div class="row pl-5 pt-5">
            <h3 style="text-decoration: underline">Reset your password</h3>
        </div>
        <div class="row">
            <div class="col-sm-4 ml-auto mr-auto d-block" style="margin-top: 15vh">
             <div  style="padding: 70px;" id="userVerification">
                 <form action="" id="frmForgetPassword">
                     <div class="form-group">
                         <div class="col-sm-12">
                             <label for="">Enter your Email or Phone Number</label>
                         </div>
                         <div class="col-sm-12">
                             <input type="text" class="form-control" id="txtUserVerification" name="txtUserVerification" placeholder="Mobile or Email" required>
                         </div>
                     </div>
                     <div class="form-group text-right">
                         <div class="col-sm-12">
                             <button type="submit" class="btn bg-transparent" style="border: 1px solid red;">Verify User</button>
                             <br><br><a href="<?=base_url('welcome/')?>">Go to login page</a>
                         </div>
                     </div>
                 </form>
             </div>
                <div  style="padding: 70px; display: none;" id="otpVerification">
                    <form action="" id="frmOtpVerification">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="">Enter Otp</label>
                            </div>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="txtOtpVerification" name="txtOtpVerification" placeholder="Otp" required>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <div class="col-sm-12">
                                <button type="submit" class="btn bg-transparent" style="border: 1px solid red;">Verify Otp</button>
                                <br><br><a href="<?=base_url('welcome/')?>">Go to login page</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div  style="padding: 70px; display: none;" id="passwordVerification">
                 <form action="" id="frmResetPassword">
                     <div class="form-group">
                         <div class="col-sm-12">
                             <label for="">Enter your New Password</label>
                         </div>
                         <div class="col-sm-12">
                             <input type="password" class="form-control" id="txtResetPassword" name="txtResetPassword" placeholder="New Password" required>
                         </div>
                         <br>
                         <div class="col-sm-12">
                             <input type="password" class="form-control" id="txtReEnterResetPassword" name="txtReEnterResetPassword" placeholder="Re-enter Password" required>
                         </div>
                     </div>
                     <div class="form-group text-right">
                         <div class="col-sm-12">
                             <button type="submit" class="btn bg-transparent" style="border: 1px solid red;">Reset</button>
                             <br><br><a href="<?=base_url('welcome/')?>">Go to login page</a>
                         </div>
                     </div>
                 </form>
             </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<button type="button" style="display: none;" id="lunchModal" data-toggle="modal" data-target="#myModal">
</button>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-exclamation-circle"></i>&nbsp;Complete Your Profile</h4>
                        <button type="button" class="close" onclick="location.href='<?=base_url("Admin/logout")?>'">&times;</button>
                    </div>
                    <form class="needs-validation user-add" id="frmVendorCompletion" action="<?=base_url('VendorRegistration/complete_vendor')?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <h4 class="text-center">Basic Information</h4>
                        <div class="pl-5 pr-5">
                            <input type="hidden" name="txtid" id="txtid" value="<?= $this->session->adminLogin['userid']?>">

                            <?php
                            if($this->session->adminLogin['altcontact']==0){
                                ?>
                                <div class="form-group row">
                                    <label for="inputAltContactNumber" class="col-form-label"><span>*</span> Alternate Contact Number</label>
                                    <input type="tel" class="form-control" id="inputAltContactNumber"  name="inputAltContactNumber" onclick="number_validate('inputAltContactNumber')"  minlength="10" maxlength="10" required>
                                </div>
                                <?php
                            }
                            if($this->session->adminLogin['ownername']==null){
                                ?>
                                <div class="form-group row">
                                    <label for="txtOwnerName" class="col-form-label"><span>*</span> Owner Name</label>
                                    <input type="text" class="form-control" id="txtOwnerName" name="txtOwnerName" onclick="charachters_validate('txtOwnerName')" minlength="3"  maxlength="50" required>
                                </div>
                                <?php
                            }
                            if($this->session->adminLogin['pincode']==null){
                                ?>
                                <div class="form-group row">
                                    <label for="txtPINcode" class="col-form-label"><span>*</span> PIN Code</label>
                                    <input type="text" class="form-control" id="txtPINcode" name="txtPINcode" onclick="number_validate('txtPINcode')" minlength="6" maxlength="6" required>
                                </div>
                                <?php
                            }
                            if($this->session->adminLogin['address']==null){
                                ?>

                                <div class="form-group row">
                                    <label for="inputPlot" class="col-form-label"><span>*</span> Plot No.</label>
                                    <input type="text" class="form-control" id="inputPlot" name="inputPlot" onclick="alfa_numeric('inputPlot')" minlength="3"  maxlength="50" required>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPo" class="col-form-label"><span>*</span> Post Office</label>
                                    <input type="text" class="form-control" id="inputPo" name="inputPo" onclick="alfa_numeric('inputPo')" minlength="3" maxlength="50" required>
                                </div>

                                <div class="form-group row">
                                    <label for="inputStreet" class="col-form-label"><span>*</span> Street Locality</label>
                                    <input type="text" class="form-control" id="inputStreet" name="inputStreet" onclick="alfa_numeric('inputStreet')" minlength="3" maxlength="50" required>
                                </div>
                                <div class="form-group row">
                                    <label for="inputState" class="col-form-label"><span>*</span> State</label>
                                    <select type="text" class="form-control" id="inputState" name="inputState" required>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="inputDistrict" class="col-form-label"><span>*</span> District</label>
                                    <select type="text" class="form-control" id="inputDistrict" name="inputDistrict" required>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="inputCity" class="col-form-label"><span>*</span> City</label>
                                    <select type="text" class="form-control" id="inputCity" name="inputCity" required>
                                    </select>
                                </div>
                                <?php
                            }
                            if($this->session->adminLogin['photograph']==null){
                                ?>
                                <div class="form-group row">
                                    <label for="imgVendor" class="col-form-label"><span>*</span> Photo</label>
                                    <input type="file" class="form-control" id="imgVendor" name="imgVendor" accept="image/png, image/jpg, image/jpeg" required>
                                </div>
                                <?php
                            }
                            if($this->session->adminLogin['gstnumber']==null){
                                ?>
                                <div class="form-group row">
                                    <label for="txtGSTN" class="col-form-label"><span>*</span> GST Number</label>
                                    <input type="text" class="form-control text-uppercase" id="txtGSTN" name="txtGSTN" onclick="alfa_numeric('txtGSTN')" maxlength="15"  minlength="15" required>
                                </div>
                                <?php
                            }
                            if($this->session->adminLogin['pannumber']==null){
                                ?>
                                <div class="form-group row">
                                    <label for="txtPANnumber" class="col-form-label"><span>*</span> PAN Number</label>
                                    <input type="text" class="form-control text-uppercase" id="txtPANnumber" name="txtPANnumber" onclick="alfa_numeric('txtPANnumber')" maxlength="10" minlength="10" required>
                                </div>
                                <?php
                            }
                            if($this->session->adminLogin['aadharnumber']==null){
                                ?>
                                <div class="form-group row">
                                    <label for="txtAadhaar" class="col-form-label"><span>*</span> Aadhaar Number</label>
                                    <input type="text" class="form-control text-uppercase" id="txtAadhaar" name="txtAadhaar" onclick="number_validate('txtAadhaar')" maxlength="12" minlength="12" required>
                                </div>
                                <?php
                            }

                            if($this->session->adminLogin['bankname']==null){
                                ?>
                                <div class="form-group row">
                                    <label for="txtBankName" class="col-form-label"><span>*</span> Bank Name</label>
                                    <input type="text" class="form-control" id="txtBankName" name="txtBankName" onclick="charachters_validate('txtBankName')" maxlength="50" minlength="1" required>
                                </div>
                                <?php
                            }
                            if($this->session->adminLogin['accountnumber']==null){
                                ?>
                                <div class="form-group row">
                                    <label for="txtAccountNumber" class="col-form-label"><span>*</span> Account Number</label>
                                    <input type="text" class="form-control" id="txtAccountNumber" name="txtAccountNumber" onclick="number_validate('txtAccountNumber')" maxlength="20" minlength="1" required>
                                </div>
                                <?php
                            }
                            if($this->session->adminLogin['accountholdername']==null){
                                ?>
                                <div class="form-group row">
                                    <label for="txtAccountHolderName" class="col-form-label"><span>*</span> Account Holder's Name</label>
                                    <input type="text" class="form-control" id="txtAccountHolderName" name="txtAccountHolderName" onclick="charachters_validate('txtAccountHolderName')" maxlength="100" minlength="1" required>
                                </div>
                                <?php
                            }
                            if($this->session->adminLogin['ifsccode']==null){
                                ?>
                                <div class="form-group row">
                                    <label for="txtIFSC" class="col-form-label"><span>*</span>IFSC</label>
                                    <input type="text" class="form-control text-uppercase" id="txtIFSC" name="txtIFSC" onclick="alfa_numeric('txtIFSC')"  maxlength="11"  minlength="11" required>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default text-left" onclick="location.href='<?=base_url("Admin/logout")?>'">Logout</button>
                        <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

<script>
    jQuery(document).ready(function () {

        //load_vendor_flag('cboflagId',"<?//=base_url()?>//");
        //load_vendor_type('inputVendorType',"<?//=base_url()?>//");
        load_state('inputState',"<?=base_url()?>");
        $('#frmVendorCompletion').submit(function (e) {
            e.preventDefault();
            submit_complete_form(this,'btnSubmit','txtid');
        });
        $('#inputState').change(function () {
            var stateid=$('#inputState').val();
            load_district('inputDistrict',stateid,"<?=base_url()?>");
        });
        $('#inputDistrict').change(function () {
            var distid=$('#inputDistrict').val();
            load_city('inputCity',distid,"<?=base_url()?>");
        });

    });

    setTimeout(function() {
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#lunchModal").trigger('click');
    }, 10);
    // $('#myModal').modal({
    //     backdrop: 'static',
    //     keyboard: false
    // })
    function submit_complete_form(formid,btnid,txtid){
        $("#"+btnid).attr('disabled',true);
        $.ajax({
            type:'post',
            url:formid.action,
            data:new FormData(formid),
            crossDomain:true,
            dataType:'json',
            processData: false,
            contentType: false,
            cache: false,
            success:function (data) {
                if(data!=false){
                    console.log(data);
                    var status="";
                    if(data.status==true){
                        mytoast(data);
                        $('#myModal').modal('hide');
                        $("#"+formid.id).trigger('reset');
                    }else if(data.status==false){
                        mytoast(data);
                    }
                }
            },
            error : function(error){
                JSON.stringify(error);
                if(error.status == 500){
                    var str =  JSON.stringify(error.responseText);
                    var pos1 = str.indexOf("<p>",str.search("</p>"));
                    var pos = str.indexOf("</p>",pos1);
                    var res=[];
                    res['message']="Error";
                    res['data']=str.slice(pos1, pos);
                }else if( error.status == 404){
                    var str =  JSON.stringify(error.responseText);
                    var pos1 = str.search("<p>");
                    var pos = str.search("</p>");
                    var res=[];
                    res['message']="Error";
                    res['data']=str.slice(pos1, pos);
                }
                mytoast(data);
            }
        });
        $("#"+btnid).attr('disabled',false);
    }

</script>
<?php
//echo "<pre>";
//print_r($this->session);
//echo "</pre>";
//?>
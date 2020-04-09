<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Right sidebar Ends-->


    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Company</h5>
                    </div>
                    <div class="card-body">
                        <div class="btn-popup pull-right">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-original-title="test" data-target="#exampleModal">Add Company</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title f-w-600" id="exampleModalLabel">Company</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="needs-validation" id="frmCompany" method="post" action="<?=base_url('Company/create_company')?>" enctype="multipart/form-data">
                                                <input type="hidden" name="txtid" id="txtid" value="0">
                                                <div class="form">
                                                    <div class="form-group">
                                                        <label for="validationCustom01" class="mb-1">Company Name<span class="text-danger">*</span>:</label>
                                                        <input class="form-control" minlength="3" maxlength="50" id="txtCompany" name="txtCompany" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="validationCustom01" class="mb-1">Pan Number<span class="text-danger">*</span>:</label>
                                                        <input class="form-control" minlength="3" maxlength="10" id="txtPannumber" name="txtPannumber" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="validationCustom01" class="mb-1">Gst Number<span class="text-danger">*</span>:</label>
                                                        <input class="form-control" minlength="3" maxlength="20" id="txtGstnumber" name="txtGstnumber" type="text">
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <label for="validationCustom02" class="mb-1">Company Image:</label>
                                                        <input class="form-control" id="txtImage" name="txtImage" type="file">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="validationCustom01" class="mb-1">Address<span class="text-danger">*</span>:</label>
                                                        <textarea class="form-control" rows="3" id="txtaddress" name="txtaddress" maxlength="500" minlength="3" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="validationCustom01" class="mb-1">Status:</label><br>
                                                        <button class="btn btn-secondary">Enable</button>
                                                        <button class="btn btn-primary">Disable</button>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" type="button" id="modalClose" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-secondary" type="submit" id="btnSubmit" name="btnSubmit">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class='table table-bordered table-striped' id="showtablereport">
                                <thead class="bg-secondary text-white">
                                <tr>
                                    <th class="text-center">Sl.no</th>
                                    <th class="text-center">Company Name</th>
                                    <th class="text-center">Pan Number</th>
                                    <th class="text-center">Gst Number</th>
                                    <th class="text-center">Logo</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody id="showReportCompany"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->


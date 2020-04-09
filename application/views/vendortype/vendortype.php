<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Right sidebar Ends-->

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Vendor Type</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href=""><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Vendor Type</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Vendor Type</h5>
                    </div>
                    <div class="card-body">
                        <div class="btn-popup pull-right">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-original-title="test" data-target="#exampleModal">Add Vendor Type</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title f-w-600" id="exampleModalLabel">Vendor Type</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="needs-validation" id="frmvendor" method="post" action="<?=base_url('Vendor_type/create_vendor_type')?>" >
                                                <input type="hidden" name="txtid" id="txtid" value="0">
                                                <div class="form">
                                                    <div class="form-group">
                                                        <label for="validationCustom01" class="mb-1">Vendor Type<span class="text-danger">*</span>:</label>
                                                        <input class="form-control" minlength="3" maxlength="50" id="txtTypename" name="txtTypename" type="text">
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
                                    <th class="text-center">Vendor Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody id="showReportvendor"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
</div>
</div>

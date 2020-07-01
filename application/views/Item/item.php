<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Add Item Images</h5>
                </div>
                <div class="card-body">
                    <div class="btn-popup pull-right">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-original-title="test" data-target="#exampleModal">Add Item Images</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Item Images</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="needs-validation" id="frmItem" method="post" action="<?=base_url('ItemImage/create_itemimage')?>" enctype="multipart/form-data"  >
                                            <input type="hidden" name="txtid" id="txtid" value="0">
											<div class="row">
												<div class="col-12">
													<div class="form-group">
														<label class="col-form-label"><span>*</span>Category:</label>
														<select class="custom-select" id="cboCategory" name="cboCategory" required>
														</select>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group">
														<label class="col-form-label"><span>*</span>Subcategory:</label>
														<select class="custom-select" id="cboSubcategory" name="cboSubcategory" required>
														</select>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group">
														<label class="col-form-label"><span>*</span> Product:</label>
														<select class="custom-select" id="cboProductId" name="cboProductId" required>
														</select>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group">
														<label class="col-form-label"><span>*</span> Vendor Name</label>
														<select class="custom-select" id="CboVendorId" name="cboVendorId" required>
														</select>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group">
														<label class="col-form-label"><span>*</span> Brand Name</label>
														<select class="custom-select" id="cboBrandId" name="cboBrandId" required>
														</select>
													</div>
												</div>
											</div>
                                            <div class="form">
                                                <div class="form-group">
                                                    <label for="validationCustom01" class="mb-1">Item Id<span class="text-danger">*</span>:</label>
                                                    <select class="form-control" id="cboitem"  name="cboitem">

                                                    </select
                                                </div>
                                                <div class="form-group">
                                                    <label for="validationCustom01" class="mb-1">Image path<span class="text-danger">*</span>:</label>
                                                    <input class="form-control" id="txtImage" name="txtImage" type="file">
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
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class='table table-bordered table-striped' id="showtablereport">
                <thead class="bg-secondary text-white">
                <tr>
                    <th class="text-center">Sl.no</th>
                    <th class="text-center">Item Id</th>
                    <th class="text-center">Imagefull Path</th>
                </tr>
                </thead>
                <tbody id="showReportItem"></tbody>
            </table>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

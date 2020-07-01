<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <form action="<?=base_url('Item/item_creation')?>" method="post" id="frmItemCreation" enctype="multipart/form-data">
        <div class="row product-adding">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Item Form</h5>
                            </div>
                            <div class="card-body">
                                <div class="digital-add needs-validation">
                                    <div class="form-group">
                                        <input type="hidden" id="txtid" name="txtid" value="0">
                                        <label class="col-form-label"><span>*</span> Category Name</label>
                                        <select class="custom-select" id="cboCategoryId" name="cboCategoryId" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label"><span>*</span> Subcategory Name</label>
                                        <select class="custom-select" id="cboSubcategoryId" name="cboSubcategoryId" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label"><span>*</span> Product Name</label>
                                        <select class="custom-select" id="cboProductId" name="cboProductId" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label"><span>*</span> Brand Name</label>
                                        <select class="custom-select" id="cboBrandId" name="cboBrandId" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label"><span>*</span> Item Name</label>
                                        <input type="text" class="form-control" id="txtItemName" name="txtItemName" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label"><span>*</span> Item Code</label>
                                        <input type="text" class="form-control" id="txtItemCode" name="txtItemCode" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <br>
                            </div>
                            <div class="card-body">
                                <div class="digital-add needs-validation">
                                    <div class="form-group">
                                        <label for="validationCustom01" class="col-form-label"><span>*</span>Image</label>
                                        <input type="file" class="form-control" id="fileImage" name="fileImage"  required>
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom01" class="col-form-label"><span>*</span> Maximum Retail Price</label>
                                        <input class="form-control" id="txtMrp" name="txtMrp" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom01" class="col-form-label"><span>*</span> Taxrate</label>
                                        <select class="custom-select" id="cboTaxRate" name="cboTaxRate" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label"><span>*</span> Unit</label>
                                        <select class="custom-select" id="CboUnitId" name="CboUnitId" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom01" class="col-form-label"><span>*</span> Quantity</label>
                                        <input class="form-control" id="txtQuantity" name="txtQuantity" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom01" class="col-form-label"><span>*</span>Dimension</label>
                                        <input class="form-control" id="txtDimension" name="txtDimension" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <button type="button"  class="btn btn-danger f-left" id="btnReset">Reset</button> &nbsp;
                <button type="button" class="btn btn-success f-let" id="btnReport">Report</button>
                <button type="submit" class="btn btn-primary f-right" id="btnSubmit">Create</button>
            </div>
        </div>
    </form>
</div>
<br>
<div class="container-fluid" id="itemReportHeader" style="display: none;">
    <div class="table-responsive">
        <table class='table table-bordered table-striped' id="showtablereport">
            <thead class="bg-secondary text-white">
            <tr >
                <th class="text-center">Sl.no</th>
                <!--                <th class="text-center">Category</th>-->
                <!--                <th class="text-center">Subcategory</th>-->
                <th class="text-center">Product</th>
                <th class="text-center">Brand</th>
                <!--                <th class="text-center">Item Code</th>-->
                <th class="text-center">Item Name</th>
                <th class="text-center">MRP</th>
                <th class="text-center">Taxrate</th>
                <th class="text-center">Unit</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Dimension</th>
                <!--                <th class="text-center">Action</th>-->
            </tr>
            </thead>
            <tbody id="showReportItemList">
            </tbody>
            <!--            <div id="spinerview" style="display: none;" class="ml-auto mr-auto d-block">-->
            <!--                <i class="fa fa-spinner fa-spin"></i>-->
            <!--            </div>-->
        </table>
    </div>
</div>
<!-- Container-fluid Ends-->

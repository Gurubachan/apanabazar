<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Item</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Add Item</a>
                        </li>
                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Add Image</a>-->
                        <!--    </li>-->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Add Variant</a>
                        </li>
                    </ul><!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="row product-adding">
                                <div class="col-xl-12">
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Form</h5>
                                                </div>
                                                <form action="<?=base_url('Item/item_creation')?>" method="post" id="frmItemCreation" enctype="multipart/form-data">
                                                    <div class="card-body">
                                                        <div class="digital-add needs-validation">
                                                            <!--                                        <div class="form-group">-->
                                                            <input type="hidden" id="txtid" name="txtid" value="0">
                                                            <!--                                            <label class="col-form-label"><span>*</span> Category Name</label>-->
                                                            <!--                                            <select class="custom-select" id="cboCategoryId" name="cboCategoryId" required>-->
                                                            <!--                                            </select>-->
                                                            <!--                                        </div>-->
                                                            <!--                                        <div class="form-group">-->
                                                            <!--                                            <label class="col-form-label"><span>*</span> Subcategory Name</label>-->
                                                            <!--                                            <select class="custom-select" id="cboSubcategoryId" name="cboSubcategoryId" required>-->
                                                            <!--                                            </select>-->
                                                            <!--                                        </div>-->
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
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="col-form-label"><span>*</span> Taxrate</label>
                                                                <select class="custom-select" id="cboTaxRate" name="cboTaxRate" required>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="" class="col-form-label">Specifications</label>
                                                                <div id="showProductMap"></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 pb-5">
                                                        <button type="reset"  class="btn btn-danger f-left btn-sm" id="btnReset">Reset</button> &nbsp;
                                                        <button type="button" class="btn btn-success f-let" id="btnReport">Report</button>
                                                        <button type="submit" class="btn btn-primary f-right btn-sm" id="btnSubmit">Create</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Report</h5>
                                                </div>
                                                <div class="card-body" style="min-height: 750px; max-height: 750px; overflow-y: scroll;">
                                                    <div class="digital-add needs-validation table-responsive">
                                                        <table class="table table-bordered" id="tbaleItem">
                                                            <thead>
                                                            <tr>
                                                                <th>Sl#</th>
                                                                <th>Product</th>
                                                                <th>Brand</th>
                                                                <th>Item Name</th>
                                                                <th>Item Code</th>
                                                                <th>Tax Rate</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="showReportItemList">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--    <div class="tab-pane" id="tabs-2" role="tabpanel">-->
                        <!--        <p>Item Image</p>-->
                        <!--    </div>-->
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="container-fluid">
                                <br>
                                <form action="<?=base_url('Itemvariant/create_itemvariant')?>" method="post" id="frmItemVariantCreation" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <!--                                <div class="col-xl-12" style="background-color:#ffffff; ">-->
                                                    <div class="col-xl-12" style="background-color:#ffffff;">
                                                        <div class="card mr-auto ml-auto d-block" style="position: relative;width:40%; height: 150px; margin-top: 4%;">
                                                            <div class="form-group" style="">
                                                                <label class="col-form-label" style="font-weight: bold;">Search Item</label>
                                                                <input class="form-control" id="txtItem" name="txtItem" type="text" required autocomplete="off">
                                                                <div class="table-responsive pr-5 searchTable" id="searchTable" style="display: none;margin-top: 5px; background-color:#ffffff;
                                         -webkit-box-shadow: 0px 0px 7px 1px rgba(219,215,208,1);
                                         -moz-box-shadow: 0px 0px 7px 1px rgba(219,215,208,1);
                                         box-shadow: 0px 0px 7px 1px rgba(219,215,208,1);padding: 10px;">
                                                                    <table class="searchBox" id="searchBox">
                                                                        <tbody class="loadItemSearchData" id="loadItemSearchData" style="padding: 15px;">
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="loadItemResponse"></div>
                                            </div>
                                        </div>
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



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
                        <h5>Product Variant Map</h5>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <form class="needs-validation" id="frmProductVariantMap" method="post" action="<?=base_url('ProductVariantMap/create_product_variant_map')?>">
                                <input type="hidden" name="txtid" id="txtid" value="0">
                                <div class="form text-center">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <select name="cboProductList" id="cboProductList" class="form-control"></select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <select name="cboVariantList" id="cboVariantList" class="form-control"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="reset" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-secondary" type="submit" id="btnSubmit" name="btnSubmit">Map</button>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive" id="tableProductMap">
                            <table class='table table-bordered table-striped' id="showtablereport">
                                <thead class="bg-secondary text-white">
                                <tr >
                                    <th class="text-center">Sl.no</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Variant Name</th>
<!--                                    <th class="text-center">Action</th>-->
                                </tr>
                                </thead>
                                <tbody id="showReportProductVariantMap"></tbody>
                            </table>
                        </div>
                    </div>wee
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

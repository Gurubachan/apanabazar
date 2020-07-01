<div class="row">
    <div class="col-sm-12">
        <div class="card tab2-card">
            <div class="card-header">
                <h5> Add Delivery Address</h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist">
                    <li class="nav-item"><a class="nav-link active show" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="true" data-original-title="" title="">Account</a></li>
                    <li class="nav-item"><a class="nav-link" id="permission-tabs" data-toggle="tab" href="#permission" role="tab" aria-controls="permission" aria-selected="false" data-original-title="" title="">Permission</a></li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="account" role="tabpanel" aria-labelledby="account-tab">
                        <form class="needs-validation user-add" id="frmdeliveryaddress" method="post" action="<?=base_url('Delivery_address/create_add')?>" enctype="multipart/form-data">
                            <input type="hidden" name="txtid" id="txtid" value="0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="cboitem" class="col-xl-3 col-md-4"><span>*</span>Name</label>
                                        <input type="text" class="form-control col-xl-8 col-md-7" id="txtName" name="txtName" >
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group row">
                                        <label for="txtUniquecode" class="col-xl-3 col-md-4"><span>*</span>Mobile</label>
                                        <input type="tel" class="form-control col-xl-8 col-md-7" id="inputContactNumber" name="inputContactNumber" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="txtQuantity" class="col-xl-3 col-md-4"><span>*</span>Alternate Number</label>
                                        <input type="tel" class="form-control col-xl-8 col-md-7" id="inputAltContactNumber" name="inputAltContactNumber">

                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group row">
                                        <label for="txtMrp" class="col-xl-3 col-md-4"><span>*</span>Land Mark</label>
                                        <input type="text" class="form-control col-xl-8 col-md-7" id="txtlandmark" name="txtlandmark" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="txtmanfact" class="col-xl-3 col-md-4"><span>*</span>State</label>
                                        <select type="text" class="form-control col-xl-8 col-md-7" id="cboState" name="cboState" >
                                            <option value="">Select</option>
                                            <option value="1">Bihar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group row">
                                        <label for="txtexp" class="col-xl-3 col-md-4"><span>*</span>City</label>
                                        <select type="text" class="form-control col-xl-8 col-md-7" id="cboCity" name="cboCity" >
                                            <option value="">Select</option>
                                            <option value="1">Bhubaneswar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="txtoutst" class="col-xl-3 col-md-4"><span>*</span>User Id</label>
                                        <select type="text" class="form-control col-xl-8 col-md-7" id="cboUserid" name="cboUserid" >
                                            <option value="">Select</option>
                                            <option value="1">Atreya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group row">
                                        <label for="txtremain" class="col-xl-3 col-md-4"><span>*</span>Pin Code</label>
                                        <input type="text" class="form-control col-xl-8 col-md-7" id="txtpincode" name="txtpincode" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="txtremain" class="col-xl-3 col-md-4"><span>*</span>Address 1</label>
                                        <input type="text" class="form-control col-xl-8 col-md-7" id="txtaddress" name="txtaddress" >
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group row">
                                        <label for="txtremain" class="col-xl-3 col-md-4"><span>*</span>Address 2</label>
                                        <input type="text" class="form-control col-xl-8 col-md-7" id="txtaddre" name="txtaddre" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="txtremain" class="col-xl-3 col-md-4"><span>*</span>Address Type</label>
                                        <input type="text" class="form-control col-xl-8 col-md-7" id="txtaddtype" name="txtaddtype" >
                                    </div>
                                </div>


                            </div>
                        </form>

                    </div>
                    <div class="tab-pane fade" id="permission" role="tabpanel" aria-labelledby="permission-tabs">
                        <form class="needs-validation user-add" method="post" id="frmPermissions">
                            <h4>Permission</h4>
                            <div class="permission-block">
                                <div class="attribute-blocks">
                                    <h5 class="f-w-600 mb-3">Product Related permition </h5>
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-4">
                                            <label>Add Product</label>
                                        </div>
                                        <div class="col-xl-9 col-sm-8">
                                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
                                                <label class="d-block" for="edo-ani1">
                                                    <input class="radio_animated" id="edo-ani1" type="radio" name="rdo-ani">
                                                    Allow
                                                </label>
                                                <label class="d-block" for="edo-ani2">
                                                    <input class="radio_animated" id="edo-ani2" type="radio" name="rdo-ani" checked="">
                                                    Deny
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-4">
                                            <label>Update Product</label>
                                        </div>
                                        <div class="col-xl-9 col-sm-8">
                                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
                                                <label class="d-block" for="edo-ani3">
                                                    <input class="radio_animated" id="edo-ani3" type="radio" name="rdo-ani1">
                                                    Allow
                                                </label>
                                                <label class="d-block" for="edo-ani4">
                                                    <input class="radio_animated" id="edo-ani4" type="radio" name="rdo-ani1" checked="">
                                                    Deny
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-4">
                                            <label>Delete Product</label>
                                        </div>
                                        <div class="col-xl-9 col-sm-8">
                                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
                                                <label class="d-block" for="edo-ani5">
                                                    <input class="radio_animated" id="edo-ani5" type="radio" name="rdo-ani2">
                                                    Allow
                                                </label>
                                                <label class="d-block" for="edo-ani6">
                                                    <input class="radio_animated" id="edo-ani6" type="radio" name="rdo-ani2" checked="">
                                                    Deny
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-4">
                                            <label class="mb-0 sm-label-radio">Apply Discount</label>
                                        </div>
                                        <div class="col-xl-9 col-sm-8">
                                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated pb-0">
                                                <label class="d-block mb-0" for="edo-ani7">
                                                    <input class="radio_animated" id="edo-ani7" type="radio" name="rdo-ani3">
                                                    Allow
                                                </label>
                                                <label class="d-block mb-0" for="edo-ani8">
                                                    <input class="radio_animated" id="edo-ani8" type="radio" name="rdo-ani3" checked="">
                                                    Deny
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="attribute-blocks">
                                    <h5 class="f-w-600 mb-3">Category Related permition </h5>
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-4">
                                            <label>Add Category</label>
                                        </div>
                                        <div class="col-xl-9 col-sm-8">
                                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
                                                <label class="d-block" for="edo-ani9">
                                                    <input class="radio_animated" id="edo-ani9" type="radio" name="rdo-ani4">
                                                    Allow
                                                </label>
                                                <label class="d-block" for="edo-ani10">
                                                    <input class="radio_animated" id="edo-ani10" type="radio" name="rdo-ani4" checked="">
                                                    Deny
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-4">
                                            <label>Update Category</label>
                                        </div>
                                        <div class="col-xl-9 col-sm-8">
                                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
                                                <label class="d-block" for="edo-ani11">
                                                    <input class="radio_animated" id="edo-ani11" type="radio" name="rdo-ani5">
                                                    Allow
                                                </label>
                                                <label class="d-block" for="edo-ani12">
                                                    <input class="radio_animated" id="edo-ani12" type="radio" name="rdo-ani5" checked="">
                                                    Deny
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-4">
                                            <label>Delete Category</label>
                                        </div>
                                        <div class="col-xl-9 col-sm-8">
                                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
                                                <label class="d-block" for="edo-ani13">
                                                    <input class="radio_animated" id="edo-ani13" type="radio" name="rdo-ani6">
                                                    Allow
                                                </label>
                                                <label class="d-block" for="edo-ani14">
                                                    <input class="radio_animated" id="edo-ani14" type="radio" name="rdo-ani6" checked="">
                                                    Deny
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-4">
                                            <label class="mb-0 sm-label-radio">Apply discount</label>
                                        </div>
                                        <div class="col-xl-9 col-sm-8">
                                            <div class="form-group m-checkbox-inline custom-radio-ml d-flex radio-animated pb-0">
                                                <label class="d-block mb-0" for="edo-ani15">
                                                    <input class="radio_animated" id="edo-ani15" type="radio" name="rdo-ani7">
                                                    Allow
                                                </label>
                                                <label class="d-block mb-0" for="edo-ani16">
                                                    <input class="radio_animated" id="edo-ani16" type="radio" name="rdo-ani7" checked="">
                                                    Deny
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="pull-right">
                    <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class='table table-bordered table-striped' id="showtablereport">
                    <thead class="bg-secondary text-white">
                    <tr>
                        <th class="text-center">Sl.no</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Mobile</th>
                        <th class="text-center">Alt Mobile</th>
                        <th class="text-center">Land Mark</th>
                        <th class="text-center">User Id</th>
                        <th class="text-center">Pin Code</th>
                        <th class="text-center">Address Type</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody id="showReport"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

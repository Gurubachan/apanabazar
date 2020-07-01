<div class="container-fluid">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-styling">
                <thead>
                <tr>
                    <th>Sl#</th>
                    <th>Business Name</th>
<!--                    <th>Address</th>-->
                    <th>Phone</th>
                    <th>EMail</th>
<!--                    <th>Owner Name</th>-->
<!--                    <th>Pincode</th>-->
                    <th>Pic</th>
<!--                    <th>GST</th>-->
<!--                    <th>PAN</th>-->
<!--                    <th>AADHAR</th>-->
<!--                    <th>Company Details</th>-->
<!--                    <th>Geo Location</th>-->
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="load_vendordata">
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="vendorDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Vendor Details</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Business Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Owner Info</a>
                        </li>
                    </ul><!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel"  style="min-height: 500px;">
                            <div class="row">
                                <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-4 f-w-400" style="background-color: yellowgreen; width: 100%;" id="businessname"></div>
                                                    <div class="col-sm-8" id="photograph"></div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active" id="tabs-2" role="tabpanel"  style="min-height: 500px;">
                        <div id="ownerinfo"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="inventoryDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Vendor Item Details</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
<!--                    <div id="inventoryCheckDetails"></div>-->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>Item Name</th>
                                <th>Variant</th>
                            </tr>
                            </thead>
                            <tbody id="load_vendor_wise_item_details"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
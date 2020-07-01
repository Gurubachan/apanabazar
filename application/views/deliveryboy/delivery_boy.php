<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Container-fluid starts-->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Delivery Boy</h5>
				</div>
				<div class="card-body">
					<div class="btn-popup pull-right">
						<button type="button" class="btn btn-secondary" data-toggle="modal" data-original-title="test" data-target="#exampleModal">Add</button>
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title f-w-600" id="exampleModalLabel">Add Delivery Boy</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<form class="needs-validation" id="frmAggregator" method="post" action="<?=base_url('Aggregator/create_deliveryboy')?>">
											<input type="hidden" name="txtid" id="txtid" value="0">
											<div class="form">
												<div class="form-group">
													<label for="validationCustom01" id="nameLabel" class="mb-1">Name:</label>
													<input class="form-control" id="txtName" name="txtName" maxlength="50" minlength="3" type="text" required>
												</div>
                                                <div class="form-group">
                                                    <label for="validationCustom01" class="mb-1">Guardian Name:</label>
                                                    <input class="form-control" id="txtGuardian" name="txtGuardian" maxlength="100" type="text" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="validationCustom01" class="mb-1">Present Address:</label>
                                                    <textarea class="form-control" id="txtPresentAddress" name="txtPresentAddress" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="validationCustom01" class="mb-1">Permanent Address:</label>
                                                    <textarea class="form-control" id="txtPermanentAddress" name="txtPermanentAddress" required></textarea>
                                                </div>
                                               <div class="row">
                                                   <div class="col-sm-6">
                                                       <div class="form-group indi">
                                                           <label for="validationCustom01" class="mb-1">Age:</label>
                                                           <input class="form-control" id="txtAge" name="txtAge" maxlength="3" minlength="1" type="text">
                                                       </div>
                                                   </div>
                                                   <div class="col-sm-6">
                                                       <div class="form-group indi">
                                                           <label for="validationCustom01" class="mb-1">Gender:</label>
                                                           <select class="form-control" name="txtGender" id="txtGender" >
                                                               <option value="1">Male</option>
                                                               <option value="2">Female</option>
                                                           </select>
                                                       </div>
                                                   </div>
                                               </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="validationCustom01" class="mb-1">Mobile:</label>
                                                            <input class="form-control" id="txtContact" name="txtContact" maxlength="10" minlength="10" type="text" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="validationCustom01" class="mb-1">Email:</label>
                                                            <input class="form-control" id="txtEmail" name="txtEmail" maxlength="50" type="email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="validationCustom01" class="mb-1">Aadhar:</label>
                                                            <input class="form-control" id="txtAadhar" name="txtAadhar" maxlength="50" minlength="3" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="validationCustom01" class="mb-1">Pan:</label>
                                                            <input class="form-control" id="txtPan" name="txtPan" maxlength="10" minlength="10" type="text">
                                                        </div>
                                                    </div>
                                                </div>
											</div>
											<div class="modal-footer">
												<button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
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
                                <th>Sl#</th>
                                <th>Name</th>
                                <th>Guardian</th>
                                <th>Present Address</th>
                                <th>Permanent Address</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Pancard</th>
                                <th>Aadhar</th>
                            </tr>
							</thead>
							<tbody id="report_delivery_boy"></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Container-fluid Ends-->

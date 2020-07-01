<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Container-fluid starts-->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Aggregator</h5>
				</div>
				<div class="card-body">
					<div class="btn-popup pull-right">
						<button type="button" class="btn btn-secondary" data-toggle="modal" data-original-title="test" data-target="#exampleModal">Add</button>
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title f-w-600" id="exampleModalLabel">Add Aggregator</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<form class="needs-validation" id="frmAggregator" method="post" action="<?=base_url('Aggregator/create_aggregator')?>">
											<input type="hidden" name="txtid" id="txtid" value="0">
											<div class="form">
												<div class="form-group">
													<label for="validationCustom01" id="nameLabel" class="mb-1">Company Name:</label>
													<input class="form-control" id="txtName" name="txtName" maxlength="50" minlength="3" type="text" required>
												</div>
                                                <div class="form-group">
                                                    <label for="validationCustom01" class="mb-1">Address</label>
                                                    <textarea class="form-control" id="txtAddress" name="txtAddress" type="text" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="validationCustom01" class="mb-1">Contact:</label>
                                                    <input class="form-control" id="txtContact" name="txtContact" maxlength="10" minlength="10" type="text" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="validationCustom01" class="mb-1">Email:</label>
                                                    <input class="form-control" id="txtEmail" name="txtEmail" maxlength="50" minlength="3" type="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="validationCustom01" class="mb-1">Pan:</label>
                                                    <input class="form-control" id="txtPan" name="txtPan" maxlength="50" minlength="3" type="text">
                                                </div>
                                                <div class="form-group comp">
                                                    <label for="validationCustom01" class="mb-1">GST:</label>
                                                    <input class="form-control" id="txtGst" name="txtGst" maxlength="50" minlength="3" type="text">
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
                                <th>Type</th>
                                <th>Company</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Pancard</th>
                                <th>GST</th>
                                <th>Action</th>
                            </tr>
							</thead>
							<tbody id="report_aggregator"></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Container-fluid Ends-->

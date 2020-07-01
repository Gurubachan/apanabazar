<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Container-fluid starts-->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>User</h5>
				</div>
				<div class="card-body">
					<div class="btn-popup pull-right">
						<button type="button" class="btn btn-secondary" data-toggle="modal" data-original-title="test" data-target="#exampleModal">Add User</button>
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title f-w-600" id="exampleModalLabel">User</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<form class="needs-validation" id="frmUser" method="post" action="<?=base_url('User/create_user')?>">
											<input type="hidden" name="txtid" id="txtid" value="0">
											<div class="form">
												<div class="form-group">
													<label for="validationCustom01" class="mb-1">First Name:</label>
													<input class="form-control" id="txtFirstname" name="txtFirstname" maxlength="30" minlength="3" type="text">
												</div>
												<div class="form-group">
													<label for="validationCustom01" class="mb-1">Middle Name:</label>
													<input class="form-control" id="txtMiddlename" name="txtMiddlename" maxlength="30" minlength="3" type="text">
												</div>
												<div class="form-group">
													<label for="validationCustom01" class="mb-1">Last Name:</label>
													<input class="form-control" id="txtLastname" name="txtLastname" maxlength="30" minlength="3" type="text">
												</div>
												<div class="form-group">
													<label for="validationCustom01" class="mb-1">Mobile No:</label>
													<input class="form-control" id="txtMobileno" name="txtMobileno" maxlength="10" minlength="10" type="text">
												</div>
												<div class="form-group">
													<label for="validationCustom01" class="mb-1">Email Id:</label>
													<input class="form-control" id="txtEmail" name="txtEmail" type="email">
												</div>
												<div class="form-group">
													<label for="validationCustom01" class="mb-1">Gender:</label>
													<input id="rdoMale" name="Gender" type="radio" value="1"> Male
													<input id="txtFemale" name="Gender" type="radio" value="2"> Female
													<input id="txtOthers" name="Gender" type="radio" value="3"> Others
												</div>
												<div class="form-group">
													<label for="validationCustom01" class="mb-1">Pan Card:</label>
													<input class="form-control" id="txtPan" name="txtPan" type="text">
												</div>
												<div class="form-group">
													<label for="validationCustom01" class="mb-1">Status:</label><br>
													<button class="btn btn-secondary">Enable</button>
													<button class="btn btn-primary">Disable</button>
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
								<th class="text-center">Sl.no</th>
								<th class="text-center">First Name</th>
								<th class="text-center">Middle Name</th>
								<th class="text-center">Last Name</th>
								<th class="text-center">Mobile No.</th>
								<th class="text-center">Email Id</th>
								<th class="text-center">Gender</th>
								<th class="text-center">Pan Card</th>
								<th class="text-center">Action</th>
							</tr>
							</thead>
							<tbody id="showReportuser"></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Container-fluid Ends-->

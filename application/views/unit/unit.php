<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Container-fluid starts-->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Unit</h5>
				</div>
				<div class="card-body">
					<div class="btn-popup pull-right">
						<button type="button" class="btn btn-secondary" data-toggle="modal" data-original-title="test" data-target="#exampleModal">Add Unit</button>
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title f-w-600" id="exampleModalLabel">Unit</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<form class="needs-validation" id="frmunit" method="post" action="<?=base_url('Unit/create_unit')?>" >
											<input type="hidden" name="txtid" id="txtid" value="0">
											<div class="form">
												<div class="form-group">
													<label for="validationCustom01" class="mb-1">Unit<span class="text-danger">*</span>:</label>
													<input class="form-control" minlength="3" maxlength="30" id="txtunitname" name="txtunitname" type="text">
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
								<th class="text-center">Unit</th>
								<th class="text-center">Action</th>
							</tr>
							</thead>
							<tbody id="showReport"></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Container-fluid Ends-->

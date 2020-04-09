<div class="row">
	<div class="col-sm-12">
		<div class="card tab2-card">
			<div class="card-header">
				<h5> Add Vendor</h5>
			</div>
			<div class="card-body">
				<ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist">
					<li class="nav-item"><a class="nav-link active show" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="true" data-original-title="" title="">Account</a></li>
					<li class="nav-item"><a class="nav-link" id="permission-tabs" data-toggle="tab" href="#permission" role="tab" aria-controls="permission" aria-selected="false" data-original-title="" title="">Permission</a></li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade active show" id="account" role="tabpanel" aria-labelledby="account-tab">
						<form class="needs-validation user-add" id="frmVendorRegister" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="txtid" id="txtid" value="0">
							<h4>Basic Information</h4>
							<div class="form-group row">
								<label for="inputVendorType" class="col-xl-3 col-md-4"><span>*</span> Vendor Type</label>
								<select class="form-control col-xl-8 col-md-7" id="inputVendorType"  name="inputVendorType">
									<option value="">Select Vendor Type</option>
									<option value="1">Proprietorship</option>
									<option value="1">Pvt Ltd</option>
								</select>
							</div>
                            <div class="form-group row">
                                <label for="inputVendorType" class="col-xl-3 col-md-4"><span>*</span>Flag ID</label>
                                <select class="form-control col-xl-8 col-md-7" id="cboflagId"  name="cboflagId">
                                    <option value="0">Select Vendor ID</option>
                                </select>
                            </div>
							<div class="form-group row">
								<label for="inputID" class="col-xl-3 col-md-4"><span>*</span> Vendor ID</label>
								<input type="number" class="form-control col-xl-8 col-md-7" id="inputID" name="inputID" placeholder="Mobile Number Of AB" required>
							</div>
							<div class="form-group row">
								<label for="txtCompanyName" class="col-xl-3 col-md-4"><span>*</span> Company Name</label>
								<input type="text" class="form-control col-xl-8 col-md-7" id="txtCompanyName" name="txtCompanyName"  required>
							</div>
                            <div class="form-group row">
                                <label for="txtVendorName" class="col-xl-3 col-md-4"><span>*</span>Vendor Name</label>
                                <input type="text" class="form-control col-xl-8 col-md-7" id="txtVendorName" name="txtVendorName"  required>
                            </div>
							<h4>Vendor Contact Details</h4>
							<div class="form-group row">
								<label for="inputContactNumber" class="col-xl-3 col-md-4"><span>*</span> Contact Number</label>
								<input type="tel" class="form-control col-xl-8 col-md-7" id="inputContactNumber" name="inputContactNumber">
							</div>
							<div class="form-group row">
								<label for="inputAltContactNumber" class="col-xl-3 col-md-4"><span>*</span> Alternate Contact Number</label>
								<input type="tel" class="form-control col-xl-8 col-md-7" id="inputAltContactNumber" name="inputAltContactNumber">
							</div>
							<div class="form-group row">
								<label for="inputEmail" class="col-xl-3 col-md-4"><span>*</span> Email</label>
								<input class="form-control col-xl-8 col-md-7" id="inputEmail" name="inputEmail" type="email" required="">
							</div>
							<h4>Enter Vendor's Address</h4>

							<div class="row">
								<div class="col-lg-6">
									<div class="form-group row">
										<label for="txtOwnerName" class="col-xl-3 col-md-4"><span>*</span> Owner Name</label>
										<input type="text" class="form-control col-xl-8 col-md-7" id="txtOwnerName" name="txtOwnerName" required>
									</div>
								</div>
								<div class="col-lg-5">
									<div class="form-group row">
										<label for="txtPINcode" class="col-xl-3 col-md-4"><span>*</span> PIN Code</label>
										<input type="number" class="form-control col-xl-8 col-md-7" id="txtPINcode" name="txtPINcode" required>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="form-group row">
										<label for="inputPlot" class="col-xl-3 col-md-4"><span>*</span> Plot No.</label>
										<input type="text" class="form-control col-xl-8 col-md-7" id="inputPlot" name="inputPlot">

									</div>
								</div>
								<div class="col-lg-5">
									<div class="form-group row">
										<label for="inputPo" class="col-xl-3 col-md-4"><span>*</span> Post Office</label>
										<input type="text" class="form-control col-xl-8 col-md-7" id="inputPo" name="inputPo" >
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="form-group row">
										<label for="inputStreet" class="col-xl-3 col-md-4"><span>*</span> Street Locality</label>
										<input type="text" class="form-control col-xl-8 col-md-7" id="inputStreet" name="inputStreet" >
									</div>
								</div>
								<div class="col-lg-5">
									<div class="form-group row">
										<label for="inputState" class="col-xl-3 col-md-4"><span>*</span> State</label>
										<select type="text" class="form-control col-xl-8 col-md-7" id="inputState" name="inputState" >
											<option value="">Select State</option>
											<option value="1">Odisha</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group row">
										<label for="inputDistrict" class="col-xl-3 col-md-4"><span>*</span> District</label>
										<select type="text" class="form-control col-xl-8 col-md-7" id="inputDistrict" name="inputDistrict" >
											<option value="">Select District</option>
											<option value="1">Khurda</option>
										</select>
									</div>
								</div>
								<div class="col-lg-5">
									<div class="form-group row">
										<label for="inputCity" class="col-xl-3 col-md-4"><span>*</span> City</label>
										<select type="text" class="form-control col-xl-8 col-md-7" id="inputCity" name="inputCity" >
											<option value="">Select City</option>
											<option value="1">Bhubaneswar</option>
										</select>
									</div>
								</div>
							</div>

							<h4>Enter Vendor's Bank Details</h4>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group row">
										<label for="txtBankName" class="col-xl-3 col-md-4"><span>*</span> Bank Name</label>
										<input type="text" class="form-control col-xl-8 col-md-7" id="txtBankName" name="txtBankName">
									</div>
								</div>
								<div class="col-lg-5">
									<div class="form-group row">
										<label for="txtIFSC" class="col-xl-3 col-md-4"><span>*</span>IFSC</label>
										<input type="text" class="form-control col-xl-8 col-md-7" id="txtIFSC" name="txtIFSC">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group row">
										<label for="txtAccountHolderName" class="col-xl-3 col-md-4"><span>*</span> Account Holder's Name</label>
										<input type="text" class="form-control col-xl-8 col-md-7" id="txtAccountHolderName" name="txtAccountHolderName" >
									</div>
								</div>
								<div class="col-lg-5">
									<div class="form-group row">
										<label for="txtAccountNumber" class="col-xl-3 col-md-4"><span>*</span> Account Number</label>
										<input type="text" class="form-control col-xl-8 col-md-7" id="txtAccountNumber" name="txtAccountNumber" >
									</div>
								</div>
							</div>
							<h4>Enter Additional Details</h4>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group row">
										<label for="txtGSTN" class="col-xl-3 col-md-4"><span>*</span> GST Number</label>
										<input type="text" class="form-control col-xl-8 col-md-7" id="txtGSTN" name="txtGSTN" >
									</div>
								</div>
								<div class="col-lg-5">
									<div class="form-group row">
										<label for="txtAadhaar" class="col-xl-3 col-md-4"><span>*</span> Aadhaar Number</label>
										<input type="text" class="form-control col-xl-8 col-md-7" id="txtAadhaar" name="txtAadhaar" >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group row">
										<label for="txtPANnumber" class="col-xl-3 col-md-4"><span>*</span> PAN Number</label>
										<input type="text" class="form-control col-xl-8 col-md-7" id="txtPANnumber" name="txtPANnumber" >
									</div>
								</div>
							</div>

						</form>

					</div>
					<div class="tab-pane fade" id="permission" role="tabpanel" aria-labelledby="permission-tabs">
						<form class="needs-validation user-add" id="frmPermissions" enctype="multipart/form-data">
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
		</div>
	</div>
</div>


<!-- Container-fluid starts-->
<div class="container-fluid">
		<form action="<?=base_url('Inventory/inventory_creation')?>" method="post" id="frmInventory" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label class="col-form-label"><span>*</span>Category:</label>
						<select class="custom-select" id="cboCategory" name="cboCategory" required>
						</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label class="col-form-label"><span>*</span>Subcategory:</label>
						<select class="custom-select" id="cboSubcategory" name="cboSubcategory" required>
						</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label class="col-form-label"><span>*</span> Product:</label>
						<select class="custom-select" id="cboProductId" name="cboProductId" required>
						</select>
					</div>
				</div>
			</div>
			<div class="row product-adding">
			<div class="col-xl-6">
				<div class="card">
					<div class="card-header">
						<h5>Inventory Form</h5>
					</div>
					<div class="card-body">
						<div class="digital-add needs-validation">
							<div class="form-group">
								<input type="hidden" id="txtid" name="txtid" value="0">
								<label class="col-form-label"><span>*</span> Item Name</label>
								<input type="text" class="form-control" id="txtItemName" name="txtItemName" required>
							</div>
							<div class="form-group">
								<label class="col-form-label"><span>*</span> BrandItem Code</label>
								<input type="text" class="form-control" id="txtBrandItemCode" name="txtBrandItemCode" required>
							</div>
							<div class="form-group">
								<label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Maximum Retail Price</label>
								<input class="form-control" id="txtMrp" name="txtMrp" type="text" required>
							</div>
							<div class="form-group">
								<label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Sale Price</label>
								<input class="form-control" id="txtSalePrice" name="txtSalePrice" type="text" required>
							</div>
							<div class="form-group">
								<label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Discount</label>
								<input class="form-control" id="txtDiscount" name="txtDiscount" type="text" required>
							</div>
							<div class="form-group">
								<label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Taxrate</label>
								<input class="form-control" id="txtTaxRate" name="txtTaxRate" type="text" required>
							</div>
							<div class="form-group">
								<label class="col-form-label"><span>*</span> Unit</label>
								<select class="custom-select" id="CboUnitId" name="CboUnitId" required>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6">
				<div class="card">
					<div class="card-header">
						<h5></h5>
					</div>
					<div class="card-body">
						<div class="digital-add needs-validation">
							<div class="form-group">
								<label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Quantity</label>
								<input class="form-control" id="txtQuantity" name="txtQuantity" type="text" required>
							</div>
							<div class="form-group">
								<label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Dimension</label>
								<input class="form-control" id="txtDimension" name="txtDimension" type="text" required>
							</div>
							<div class="form-group">
								<label class="col-form-label"><span>*</span> Vendor Name</label>
								<select class="custom-select" id="CboVendorId" name="cboVendorId" required>
								</select>
							</div>
							<div class="form-group">
								<label class="col-form-label"><span>*</span> Brand Name</label>
								<select class="custom-select" id="cboBrandId" name="cboBrandId" required>
								</select>
							</div>
							<div class="form-group">
								<label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Track By</label>
								<input class="form-control" id="txtTrackBy" name="txtTrackBy" type="text" required>
							</div>
							<div class="form-group">
								<label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Opening Stock</label>
								<input class="form-control" id="txtOpeningStock" name="txtOpeningStock" type="text" required>
							</div>
							<div class="form-group">
								<label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Inward Stock</label>
								<input class="form-control" id="txtInwardStock" name="txtInwardStock" type="text" required>
							</div>
							<div class="form-group">
								<label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Outward Stock</label>
								<input class="form-control" id="txtOutwardStock" name="txtOutwardStock" type="text" required>
							</div>
						</div>
					</div>
				</div>
			</div>
				<div class="col-xl-12" style="text-align: center">
					<button type="button"  class="btn btn-danger" id="btnReset">Reset</button>
					<button type="submit" class="btn btn-primary" id="btnSubmit">Create</button>
				</div>
			</div>
		</form>
</div>
<!-- Container-fluid Ends-->

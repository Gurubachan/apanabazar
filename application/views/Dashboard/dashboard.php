<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
	<div class="row">
		<div class="col-xl-3 col-md-6 ">
			<div class="card o-hidden widget-cards">
				<div class="bg-secondary card-body">
					<div class="media static-top-widget row">
						<div class="icons-widgets col-4">
							<div class="align-self-center text-center"><i class="fa fa-shopping-cart font-secondary"></i></div>
						</div>
						<div class="media-body col-8"><span class="m-0">Total Orders</span>
							<h3 class="mb-0"><span class="counter">100</span></h3>
							<div class="float-right" style="cursor: pointer">
								<i id="details_view_button_total" class="fa fa-arrow-circle-down fa-2x" onclick="view_details_orders(1,this.id)"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card o-hidden  widget-cards">
				<div class="bg-warning card-body">
					<div class="media static-top-widget row">
						<div class="icons-widgets col-4">
							<div class="align-self-center text-center"><i class="fa fa-boxes font-warning"></i></div>
						</div>
						<div class="media-body col-8"><span class="m-0">Total Pending</span>
							<h3 class="mb-0"><span class="counter">40</span></h3>
							<div class="float-right" style="cursor: pointer">
								<i id="details_view_button_pending" class="fa fa-arrow-circle-down fa-2x" onclick="view_details_orders(2,this.id)"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card o-hidden widget-cards">
				<div class="bg-success card-body">
					<div class="media static-top-widget row">
						<div class="icons-widgets col-4">
							<div class="align-self-center text-center"><i class="fa fa-truck font-success"></i></div>
						</div>
						<div class="media-body col-8"><span class="m-0">Total Delivered</span>
							<h3 class="mb-0"><span class="counter">40</span></h3>
							<div class="float-right" style="cursor: pointer">
								<i id="details_view_button_delivered" class="fa fa-arrow-circle-down fa-2x" onclick="view_details_orders(3,this.id)"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card o-hidden widget-cards">
				<div class="bg-primary card-body">
					<div class="media static-top-widget row">
						<div class="icons-widgets col-4">
							<div class="align-self-center text-center"><i class="fa fa-window-close font-primary"></i></div>
						</div>
						<div class="media-body col-8"><span class="m-0">Total Canceled</span>
							<h3 class="mb-0"><span class="counter">20</span></h3>
							<div class="float-right" style="cursor: pointer">
								<i id="details_view_button_canceled" class="fa fa-arrow-circle-down fa-2x" onclick="view_details_orders(4,this.id)"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="order_details_div" style="display: none">
		<div class="col-12">
			<div class="card">
				<div id="order_details_card_header" class="card-header">
					<h3 class="text-white" id="order_details_card_heading"></h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table" id="order_details_table">
							<thead>
								<tr>
									<th>Slno</th>
									<th>Order number</th>
									<th>Invoice number</th>
									<th>Order details</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="order_details_tbody"></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="loadVendorCompleteModal"></div>
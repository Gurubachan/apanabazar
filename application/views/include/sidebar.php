<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="page-body-wrapper">

	<!-- Page Sidebar Start-->
	<div class="page-sidebar">
		<div class="main-header-left d-none d-lg-block">
			<div class="logo-wrapper">
                <a href="index.html">
<!--                    <img class="blur-up lazyloaded" src="../assets/images/dashboard/multikart-logo.png" alt="">-->
                   <h3>APANABAZAR</h3>
                </a>
            </div>
		</div>
		<div class="sidebar custom-scrollbar">
<!--			<div class="sidebar-user text-center">-->
<!--				<div><img class="img-60 rounded-circle lazyloaded blur-up" src="../assets/images/dashboard/man.png" alt="#">-->
<!--				</div>-->
<!--				<h6 class="mt-3 f-14">JOHN</h6>-->
<!--				<p>general manager.</p>-->
<!--			</div>-->
			<ul class="sidebar-menu">
				<li><a class="sidebar-header" href="<?=base_url('Dashboard/')?>"><i data-feather="home"></i><span>Dashboard</span></a></li>
                <?php
                if($this->session->adminLogin['usertype']=='Vendor'){
                    ?>
                    <li><a class="sidebar-header" href="#"><i data-feather="dollar-sign"></i><span>Items</span><i class="fa fa-angle-right float-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?=base_url('Inventory/')?>"><i class="fa fa-circle"></i>Inventory</a></li>
                            <li><a href="<?=base_url('Sales/')?>"><i class="fa fa-circle"></i>Orders</a></li>
                        </ul>
                    </li>
                    <?php
                }else{
                    ?>
                    <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Products</span><i class="fa fa-angle-right float-right"></i></a>
<!--                        <ul class="sidebar-submenu">-->
<!--                            <li>-->
<!--                                <a href="#"><i class="fa fa-circle"></i>-->
<!--                                    <span>Physical</span> <i class="fa fa-angle-right float-right"></i>-->
<!--                                </a>-->
<!--                                <ul class="sidebar-submenu">-->
<!--                                    <li><a href="--><?//=base_url('Category/')?><!--"><i class="fa fa-circle"></i>Category</a></li>-->
<!--                                    <li><a href="--><?//=base_url('Subcategory/')?><!--"><i class="fa fa-circle"></i>Sub Category</a></li>-->
<!--                                    <li><a href="--><?//=base_url('Product/')?><!--"><i class="fa fa-circle"></i>Products</a></li>-->
<!--                                    <li><a href="--><?//=base_url('Manufacture/')?><!--"><i class="fa fa-circle"></i>Manufacturers</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                        </ul>-->
                        <ul class="sidebar-submenu">
                            <li><a href="<?=base_url('Category/')?>"><i class="fa fa-circle"></i>Category</a></li>
                            <li><a href="<?=base_url('Subcategory/')?>"><i class="fa fa-circle"></i>Sub Category</a></li>
                            <li><a href="<?=base_url('Product/')?>"><i class="fa fa-circle"></i>Products</a></li>
                            <li><a href="<?=base_url('Manufacture/')?>"><i class="fa fa-circle"></i>Manufacturers</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="dollar-sign"></i><span>Items</span><i class="fa fa-angle-right float-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?=base_url('Unit/')?>"><i class="fa fa-circle"></i>Add Unit</a></li>
<!--                            <li><a href="--><?//=base_url('Attributegroup/')?><!--"><i class="fa fa-circle"></i>Add Attribute Group</a></li>-->
<!--                            <li><a href="--><?//=base_url('Attribute/')?><!--"><i class="fa fa-circle"></i>Add Attribute</a></li>-->
                            <li><a href="<?=base_url('Variant/')?>"><i class="fa fa-circle"></i>Add Variant</a></li>
                            <li><a href="<?=base_url('ProductVariantMap/')?>"><i class="fa fa-circle"></i>Add Product Variant Map</a></li>
<!--                            <li><a href="--><?//=base_url('Manufacture/')?><!--"><i class="fa fa-circle"></i>Add Brands</a></li>-->
                            <li><a href="<?=base_url('Item/')?>"><i class="fa fa-circle"></i>Add Items</a></li>
                            <li><a href="<?=base_url('Inventory/')?>"><i class="fa fa-circle"></i>Add Inventory</a></li>
<!--                            <li><a href="--><?//=base_url('ItemImage/')?><!--"><i class="fa fa-circle"></i>Add Item Images</a></li>-->
<!--                            <li><a href="--><?//=base_url('Itemvariant/')?><!--"><i class="fa fa-circle"></i>Add Item Variant</a></li>-->
<!--                            <li><a href="--><?//=base_url('Itemsummery/')?><!--"><i class="fa fa-circle"></i>Add Item Summary</a></li>-->
                            <li><a href="<?=base_url('Batch/')?>"><i class="fa fa-circle"></i>Add Batch</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="dollar-sign"></i><span>Sales</span><i class="fa fa-angle-right float-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?=base_url('Sales/')?>"><i class="fa fa-circle"></i>Orders</a></li>
                            <li><a href="<?=base_url('Sales/transactions')?>"><i class="fa fa-circle"></i>Transactions</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="tag"></i><span>Coupons</span><i class="fa fa-angle-right float-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="coupon-list.html"><i class="fa fa-circle"></i>List Coupons</a></li>
                            <li><a href="coupon-create.html"><i class="fa fa-circle"></i>Create Coupons </a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="clipboard"></i><span>Address</span><i class="fa fa-angle-right float-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?=base_url('State/')?>"><i class="fa fa-circle"></i>Create State</a></li>
                            <li><a href="<?=base_url('District/')?>"><i class="fa fa-circle"></i>Create District</a></li>
                            <li><a href="<?=base_url('City/')?>"><i class="fa fa-circle"></i>Create City</a></li>
                            <li><a href="<?=base_url('Delivery_address/')?>"><i class="fa fa-circle"></i>Create Address</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="media.html"><i data-feather="camera"></i><span>Media</span></a></li>
                    <li><a class="sidebar-header" href="#"><i data-feather="list"></i><span>Services</span><i class="fa fa-angle-right float-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?=base_url('Services/')?>"><i class="fa fa-circle"></i>Create Services</a></li>
                            <li><a href="<?=base_url('Services/permission')?>"><i class="fa fa-circle"></i>Permission</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="shopping-cart"></i><span>Delivery</span><i class="fa fa-angle-right float-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?=base_url('Aggregator/')?>"><i class="fa fa-circle"></i>Aggregator</a></li>
                            <li><a href="<?=base_url('Aggregator/delivery_boy')?>"><i class="fa fa-circle"></i>Delivery Boy</a></li>
<!--                            <li><a href="--><?//=base_url('Services/permission')?><!--"><i class="fa fa-circle"></i>Permission</a></li>-->
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="align-left"></i><span>Menus</span><i class="fa fa-angle-right float-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="menu-list.html"><i class="fa fa-circle"></i>Menu Lists</a></li>
                            <li><a href="create-menu.html"><i class="fa fa-circle"></i>Create Menu</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="user-plus"></i><span>Users</span><i class="fa fa-angle-right float-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="user-list.html"><i class="fa fa-circle"></i>User List</a></li>
                            <li><a href="<?=base_url('Usertype/')?>"><i class="fa fa-circle"></i>Create User Type</a></li>
                            <li><a href="<?=base_url('User/')?>"><i class="fa fa-circle"></i>Create User</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="users"></i><span>Vendors</span><i class="fa fa-angle-right float-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?=base_url('Vendor/vendorlist')?>"><i class="fa fa-circle"></i>Vendor List</a></li>
                            <li><a href="<?=base_url('Vendor_type/')?>"><i class="fa fa-circle"></i>Add Vendor Type</a></li>
                            <li><a href="<?=base_url('Vendor_flag/')?>"><i class="fa fa-circle"></i>Add Vendor Flag</a></li>
                            <li><a href="<?=base_url('VendorRegistration/')?>"><i class="fa fa-circle"></i>Create Vendor</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="chrome"></i><span>Localization</span><i class="fa fa-angle-right float-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="translations.html"><i class="fa fa-circle"></i>Translations</a></li>
                            <li><a href="currency-rates.html"><i class="fa fa-circle"></i>Currency Rates</a></li>
                            <li><a href="taxes.html"><i class="fa fa-circle"></i>Taxes</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="reports.html"><i data-feather="bar-chart"></i><span>Reports</span></a></li>
                    <li><a class="sidebar-header" href="#"><i data-feather="settings" ></i><span>Settings</span><i class="fa fa-angle-right float-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="profile.html"><i class="fa fa-circle"></i>Profile</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="<?=base_url('Invoice/')?>"><i data-feather="archive"></i><span>Invoice</span></a></li>
                    <?php
                }
                ?>

				<?php
                if($this->session->adminLogin['userid']){
                    ?>
                    <li><a class="sidebar-header" href="<?=base_url('Admin/logout')?>"><i data-feather="log-in"></i><span>Logout</span></a></li>
                <?php
                }
                ?>

			</ul>
		</div>
	</div>
	<!-- Page Sidebar Ends-->

	<!-- Right sidebar Start-->
	<!-- Right sidebar Ends-->

	<div class="page-body">

		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="page-header">
				<div class="row">
					<div class="col-lg-6">
						<div class="page-header-left">
							<h3>
                                <?php
//                                echo $this->uri->segment(1)
                                ?>
                            </h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item"><?=$this->uri->segment(1)?></li>
							<li class="breadcrumb-item active"><?=$this->uri->segment(2)?></li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->

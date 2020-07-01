<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Container-fluid starts-->
            <div class="container-fluid"  style="background-color:#ffffff;">
                        <div class="row product-adding">
                        <div class="col-xl-12" style="height: 200px;">
                            <div class="card mr-auto ml-auto d-block" style="width:40%; margin-top: 4%;z-index: 999">
                                <form id="frmInventory" autocomplete="off">
                                <div class="form-group" style="">
                                    <label class="col-form-label" style="font-weight: bold;">Search Item</label>
                                    <input class="form-control" id="txtItem" name="txtItem" type="text" required>
                                    <div class="table-responsive pr-5"
                                         id="searchTable"
                                         style="display: none;margin-top: 5px; background-color:#ffffff;
                                         -webkit-box-shadow: 0px 0px 7px 1px rgba(219,215,208,1);
                                         -moz-box-shadow: 0px 0px 7px 1px rgba(219,215,208,1);
                                         box-shadow: 0px 0px 7px 1px rgba(219,215,208,1);padding: 10px;">
                                        <table class="" id="searchBox">
                                            <tbody id="loadSearchData" style="padding: 15px;">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        </div>
                <div class="row" style="background-color:#ffffff;min-height: 500px;position: relative;">
                    <div id="load_inventory_form"></div>
                </div>
            </div>
            <!-- Container-fluid Ends-->


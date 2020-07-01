<?php
$shop_name="";
$shop_address="";
$total=0;
$quantity=0;
if(isset($result)){
    foreach ($result as $r){
        foreach ($inventory as $in){
            foreach ($vendor as $v){
                $shop_name=$v['vendorname'];
                $shop_address=$v['vendoraddress'];
                $quantity=$r['noofitems'];
                if($r['noofitems']>1){
                    $total=$r['noofitems']*$in['saleprice'];
                }else{
                    $total=$in['saleprice'];
                }
            }
        }
    }
}else{
    echo "sorry";
}
?>
<section id="main-content">
    <section class="wrapper">
        <div class="col-lg-12">
            <div class="row content-panel">
                <div class="col-lg-12">
                    <div class="invoice-body">
                        <div class="pull-left">
                            <h3><?=$shop_name?></h3>
                            <address>
                               <?=$shop_address?>
                            </address>
                        </div>
                        <div class="pull-right">
                            <h2>invoice</h2>
                        </div>

                        <div class="clearfix"></div>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-9">
                                <h4>G Singh</h4>
                                <address>
                                    <strong>ApanaBazar.com</strong><br>
                                    Cuttack<br>
                                    Odisha<br>
                                    <abbr title="Phone">P:</abbr> 8976596565
                                </address>
                            </div>

                            <div class="col-md-3">
                                <br>
                                <div>
                                    <div class="pull-left"> INVOICE NO : </div>
                                    <div class="pull-right"> 000283 </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div>

                                    <div class="pull-left"> INVOICE DATE : </div>
                                    <div class="pull-right"><?=date('d-m-Y')?></div>
                                    <div class="clearfix"></div>
                                </div>

                                <!-- /invoice-body -->
                            </div>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width:60px" class="text-center">QTY</th>
                                    <th class="text-left">DESCRIPTION</th>
                                    <th style="width:140px" class="text-right">UNIT PRICE</th>
                                    <th style="width:90px" class="text-right">TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center"><?=$quantity?></td>
                                    <td><?=$in['itemname']?></td>
                                    <td class="text-right"><?=$in['saleprice']?></td>
                                    <td class="text-right"><?=$total?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" rowspan="4">
                                        <h4>Terms and Conditions</h4>
                                        <p>Thank you for your business. We do expect payment before delivery otherwise your delivery will be cancel.</p>
                                    <td class="text-right"><strong>Subtotal</strong></td>
                                    <td class="text-right"><?=$in['saleprice']?></td>
                                </tr>
                                <tr>
                                    <td class="text-right "><strong>Shipping</strong></td>
                                    <td class="text-right">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-right"><strong>VAT Included in Total</strong></td>
                                    <td class="text-right">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <div><strong>Total</strong></div>
                                    </td>
                                    <td class="text-right"><strong><?=$in['saleprice']?></strong></td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
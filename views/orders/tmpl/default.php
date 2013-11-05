<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//print_r($this->pendingInvites);
// $this->user->setParam('welcome', '0');
?>
<script>
    function tab(x){
        jQuery('.tab').hide();
        jQuery('.tab'+x).show(); 
        
    }
 
</script> 

<div class="row-fluid">
    <div class="span12 my-account-nav">
        <h1>Advanced Fundamentals Management</h1>
        <?php echo myaccountController::buildHeader(1); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <h1>Order List </h1>
        <table class="table table-striped table-bordered">
            <tr>
                <th width="50%">
                   Order Info
                </th>

                <th>
                  Items
                </th>

            </tr>
            <?php
            if (count($this->orders) == 0) {
                echo"<tr><td colspan='3'>No orders</td></tr>";
            } else {
                foreach ($this->orders as $order) {
                  if ( $order->discount_type == 'pct') {
                        $pc =  $order->discount_amt * 100;
                         $order->dtxt = $pc . "% off";
                         $order->third =  $order->total *  $order->discount_amt;
                         $order->total = $order->total -  $order->third;
                    } else {
                        $order->dtxt = '$' .  $order->discount_amt . " off";
                         $order->third =  $order->discount_amt;
                        $order->total =  $order->total -  $order->discount_amt;
                    }
                    ?>
                    <tr>
                        <td>
                           <h2> User: <?php echo $order->first ?> <?php echo $order->last ?> </h2> <br/>
                           <h2>Billing Info</h2> <?php $binfo= json_decode(base64_decode($order->billing_info));
                            foreach($binfo as $key=>$val){
                               echo '<strong>'.ucwords($key).'</strong>: '.$val.' <br/>'; 
                            }
                            ?>  
                            
                        </td>

                        <td>
                            <table class="table table-striped table-bordered" style="max-width:700px">

                                <?php foreach ($this->model->getOrderItems($order->orderid) as $orderItem) {
                                    ?>
                                    <tr>
                                        <td ><?php echo $orderItem->title; ?></td>
                                        <td  style="text-align: right;">$<?php echo number_format($orderItem->price, 2); ?></td>
                                    </tr>
                                    <?php
                                } if ($order->discount_code_used != '') {
                                    if ($order->discount_type) {
                                        
                                    }
                                    ?>
                                    <tr>
                                        <td style="text-align: right;font-weight:bold;font-size:18px">Coupon Code: <?php echo $order->discount_code_used; ?></td>
                                        <td  style="text-align: right;font-weight:bold;font-size:18px"><?php echo $order->dtxt; ?></td>
                                    </tr>
                                <?php } ?>  
                                          <tr>
                        <td style="text-align: right;font-weight:bold;font-size:18px">Total:</td>
                        <td style="text-align: right;font-weight:bold;font-size:18px">$<?php echo number_format($order->total,2); ?></td>
                    </tr>
                            </table>
                        </td>

                    </tr>
                <?php }
            } ?>
        </table>
    </div>
</div>

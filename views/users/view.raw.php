<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Paybook class for the Paybook Component
 */
class myaccountViewusers extends JViewLegacy {

    // Overwriting JView display method
    function display($tpl = null) {
        $action = JRequest::getVar('action');
        $user = JRequest::getVar('uid');
        $this->model = & $this->getModel();

        switch ($action) {
            case 'certificates':
                ?>
<h4>Below is a list of certificates for USER ID <?php echo $user; ?></h4>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Certificate ID</th>
                        <th>Issue Date</th>
                        <th>Course & ID</th>
                    </tr>
                    <?php
                    $certs = $this->model->getCerts($user);
                    if (count($certs) > 0) {
                        foreach ($certs as $cert) {
                            ?>
                            <tr>
                                <td><?php echo $cert->cert_id ?> - <?php echo $cert->cert_title ?></td>
                                <td><?php echo $cert->completed_date ?></td>
                                <td><?php echo $cert->course_id ?> - <?php echo $cert->course_title ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="3">No certificates issued</td> 
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
                break;
            case 'courses':
                ?>
<h4>Below is a list of Courses  USER ID <?php echo $user; ?> has purchased</h4>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Course ID</th>
                        <th>Course Title/th>
                        <th>Completed Date</th>
                        <th>Score</th>
                    </tr>
                    <?php
                    $certs = $this->model->getCourses($user);
                    if (count($certs) > 0) {
                        foreach ($certs as $cert) {
                            if($cert->completed_date=='0000-00-00 00:00:00'){
                                $date='Not Completed';
                            }else{
                                $date=$cert->completed_date;
                                
                                }
                                if($cert->score !==''){
                                    $score=$cert->score;
                                }else{
                                    $score='Incomplete';
                                }
                            ?>
                            <tr>
                                <td><?php echo $cert->id ?>  </td>
                                <td><?php echo $cert->title ?></td>
                                <td><?php echo $date ?>  </td>
                                 <td><?php echo $score?> </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="3">No certificates issued</td> 
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
                break;
            case 'orders':
                        $orders = $this->model->getOrders($user);
//                    if (count($orders) > 0) {
//                        foreach ($certs as $order) {
//                            ?
//                        }
//                    }else{echo"No orders";}
                ?>
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
            if (count($orders) == 0) {
                echo"<tr><td colspan='3'>No orders</td></tr>";
            } else {
                foreach ($orders as $order) {
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

                                <?php foreach ($this->model->getOrderItems($order->id) as $orderItem) {
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
<?php 
                break;
            case 'exams':
                break;
        }
    }

}


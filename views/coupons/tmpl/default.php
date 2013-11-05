<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//print_r($this->pendingInvites);
// $this->user->setParam('welcome', '0');
?>
<script>
        function deleteItem(x){
        var r=confirm("Are you sure you want to delete this item? This will remove any related assets permanently from all users.");
        if (r==true)
        {
           // x="You pressed OK!";
           window.location='index.php?option=com_myaccount&view=coupons&delete='+x;
        }
        
    }
    function tab(x){
        jQuery('.tab').hide();
        jQuery('.tab'+x).show(); 
        
    }
 
</script> 
<div class="modal hide fade" id="newcoupon">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>New coupon</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?option=com_myaccount&view=coupons&action=newcoupon" enctype="multipart/form-data">
            <table class="table table-striped table-bordered">
                <tr>
                    <td>Code</td>
                    <td><input type="text" name="code" value=" "/></td>
                </tr>
                <tr>
                    <td>Type</td>
                    <td>
                        <select name="type">
                            <option value="pct">Percentage off</option>
                            <option value="dollar">Dollar off</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Amt Value </td>
                    <td> $<input type="text" name="amt" value=" "/></td>
                </tr>
                 

            </table>
            <input type="submit" name="save2" class="btn btn-success" value="Add coupon"/>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn"  data-dismiss="modal" aria-hidden="true">Close</a> 
    </div>
</div>
<div class="row-fluid">
    <div class="span12 my-account-nav">
        <h1>Advanced Fundamentals Management</h1>
        <?php echo myaccountController::buildHeader(1); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <h1>Existing coupons <a href="javascript:void(0)" onclick="jQuery('#newcoupon').modal('show');" class="btn btn-primary">Add New coupon</a></h1>
        <table class="table table-striped table-bordered">
            <tr>
                <th>
                    Status
                </th>
                <th>
                    Code
                </th>
                <th>
                   Type
                </th>
                <th>
                   Amt
                </th>
                <th>
                    Actions
                </th>
            </tr>
            <?php
            if (count($this->coupons) == 0) {
                echo"<tr><td colspan='3'>No coupons</td></tr>";
            } else {
                foreach ($this->coupons as $coupon) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            if ($coupon->publish == 1) {
                                echo"<a href='index.php?option=com_myaccount&view=coupons&publish=1&id=" . $coupon->id . "'>Published</a>";
                            } else {
                                echo"<a href='index.php?option=com_myaccount&view=coupons&publish=2&id=" . $coupon->id . "'>Unpublished</a>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $coupon->code ?>
                        </td>
                        <td>
                            <?php echo $coupon->discount_type ?>
                        </td>
                        <td>
                            <?php echo $coupon->discount_amt ?>
                        </td>
                        <td>
                            <a href="index.php?option=com_myaccount&view=coupons&id=<?php echo $coupon->id ?>">Edit</a> | <a href="javascript:void(0);" onclick="deleteItem(<?php echo $coupon->id ?>)">Delete</a>
                        </td>
                    </tr>
                <?php }
            } ?>
        </table>
    </div>
</div>

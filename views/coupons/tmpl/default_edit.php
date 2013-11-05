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
        <h1> Edit Course</h1>
        <form method="post" action="index.php?option=com_myaccount&view=coupons&id=<?php echo $this->coupon->id ?>" enctype="multipart/form-data">
            <table class="table table-striped table-bordered">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="code" value="<?php echo $this->coupon->code ?>"/></td>
                </tr>
                <tr>
                    <td>Publish</td>
                    <td><input type="checkbox" <?php
        if ($this->coupon->publish == 1) {
            echo"checked='checked'";
        }
        ?> name="publish" value="1"/></td>
                </tr>


                <tr>
                    <td>Type</td>
                    <td><select name="cat">
                            <option  <?php if ($this->coupon->type == 'pct') {
                                   echo 'selected="selected"';
                               } ?> value="pct">Percentage off</option>
                            <option  <?php if ($this->coupon->type == 'dollar') {
                                   echo 'selected="selected"';
                               } ?> value="dollar">Dollar off</option>  
                        </select></td>
                </tr>
                <tr>
                    <td>Amt</td>
 
                    <td> 
                        <input type="type" name="amt" value="<?php echo $this->coupon->discount_amt ?>"/></td>
                </tr>

            </table>
            <input type="submit" name="save" class="btn btn-success" value="Update Coupon"/>
        </form>
    </div>
</div>

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
    function getCerts(x){
        jQuery('#modal').modal('show');
        jQuery.get('index.php?option=com_myaccount&view=users&format=raw&action=certificates&uid='+x, function(data) {
            jQuery('.modal-body').html(data); 
             jQuery('.modal h3').html('Certificates'); 
        });

    }
        function getCourses(x){
        jQuery('#modal').modal('show');
        jQuery.get('index.php?option=com_myaccount&view=users&format=raw&action=courses&uid='+x, function(data) {
            jQuery('.modal-body').html(data); 
             jQuery('.modal h3').html('Courses'); 
        });

    }
         function getOrders(x){
        jQuery('#modal').modal('show');
        jQuery.get('index.php?option=com_myaccount&view=users&format=raw&action=orders&uid='+x, function(data) {
            jQuery('.modal-body').html(data); 
             jQuery('.modal h3').html('Courses'); 
        });

    }
</script> 
<div id="modal" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3> </h3>
    </div>
    <div class="modal-body">
        <p>Loading....</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Close</a>
        <a href="#" class="hide btn btn-primary">Save changes</a>
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
        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>First</th>
                <th>Last</th>
                <th>Email</th>
                <th>View User Certificates</th>
                <th>View User Courses</th>
                <th>View Order History</th>
                <th>View User Exams</th>

            </tr>
            <?php foreach ($this->userinfo as $ui) { ?>
                <tr>
                    <td><a href=""><?php echo $ui->user_id ?></a></td>
                    <td><?php echo $ui->first ?></td>
                    <td><?php echo $ui->last ?></td>
                    <td><?php echo $ui->email ?></td>
                    <td><a href="javascript:getCerts(<?php echo $ui->user_id ?>)" class="btn btn-primary"> User Certificates</a></td>
                    <td><a href="javascript:getCourses(<?php echo $ui->user_id ?>)" class="btn btn-primary"> User Courses</a></td>
                    <td><a href="javascript:getOrders(<?php echo $ui->user_id ?>)"  href="" class="btn btn-primary"> Order History</a></td>
                    <td><a href="" class="btn btn-primary"> User Exams</a></td>
                </tr>
            <?php } ?>
        </table>

    </div>
</div>

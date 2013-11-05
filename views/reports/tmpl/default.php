<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//print_r($this->pendingInvites);
// $this->user->setParam('welcome', '0');
?>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
 
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-lightness/jquery-ui.min.css" type="text/css">
<script>
     
       
   jQuery( document ).ready(function( $ ) {
  // Code using $ as usual goes here.
   jQuery( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
   jQuery( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
});
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
        <?php echo myaccountController::buildHeader(9); ?>
    </div>
</div>


<div class="row-fluid">
    <div class="span12">
        <div class="well">
            <form method="POST" action="index.php?option=com_myaccount&view=reports">
            <label>Report Type
            <select name="type">
                <option value="0">Purchases</option>
                <option value="1">Quiz Completions</option>
            </select>
            </label>
            
            <label>
                Time Frame  </label>
                <table>
                    <tr>
                        <td><input id="datepicker2" type="text" name="start" placeholder="Start Date:"/></td>
                        <td><input id="datepicker" type="text" name="end" placeholder="End Date:"/></td>
                    </tr>
                </table>
          
                <input type="submit" value="Get Results" class="btn btn-success" />
                <a class="btn btn-inverse" href="index.php?option=com_myaccount&view=reports&export=1&format=raw">Export results below to Excel</a>
            </form>
        </div>
        <table class="table table-striped table-bordered">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>State license issued in</th>
                <th>State License #</th>
                <th>License #2</th>
                <th>License #3</th>
                <th>Purchase Date</th>
                <th>Course Name</th>
                <th>Course #</th>
                <th>Completion Date</th>
                <th>Price Paid</th>
                   

            </tr>
            <?php  foreach ($this->reportRecords as $r) { 
                $lics=  base64_decode($r->lic_number);
                 $lics=  json_decode($lics);
                $lic1=$lics[0];
                $lic2=$lics[1];
                $lic3=$lics[2];
                ?>
                <tr>
                      <td><?php echo $r->first .' '.$r->last ; ?></td>
                <td><?php echo $r->email ?></td>
                <td><?php echo $r->phone ?></td>
                <td><?php echo $r->street1 ?> <?php echo $r->street2 ?></td>
                <td><?php echo $r->city ?></td>
                <td><?php echo $r->state ?></td>
                <td>Florida</td>
                <td><?php echo $lic1 ?></td>
                <td><?php echo $lic2 ?></td>
                <td><?php echo $lic3 ?></td>
                <td><?php echo $r->date ?></td>
                <td><?php echo $r->title ?></td>
                <td><?php echo $r->item_id ?></td>
                <td><?php echo $r->completed_date ?></td>
                <td><?php echo $r->price ?></td>
                </tr>
            <?php } ?>
        </table>

    </div>
</div>

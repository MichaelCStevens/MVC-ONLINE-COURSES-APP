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
           window.location='index.php?option=com_myaccount&view=seminars&delete='+x;
        }
        
    }
    function tab(x){
        jQuery('.tab').hide();
        jQuery('.tab'+x).show(); 
        
    }
 
</script> 
<div class="modal hide fade" id="newseminar">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>New seminar</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?option=com_myaccount&view=seminars&action=newseminar" enctype="multipart/form-data">
            <table class="table table-striped table-bordered">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" value=" "/></td>
                </tr>
                <tr>
                    <td>Publish</td>
                    <td>
                        <select name="publish">
                            <option value="1">Publish</option>
                            <option value="0">Unpublished</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Price:  </td>
                    <td> $<input type="text" name="price" value=" "/></td>
                </tr>
                <tr>
                    <td>Hours</td>
                    <td><input type="text" name="hours" value=" "/></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td><select name="cat">
                            <?php foreach ($this->cats as $cat) { ?>
                                <option value="<?php echo $cat->id ?>"><?php echo $cat->title ?></option>
                            <?php } ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td> <textarea  name="description"> </textarea></td>
                </tr>
<!--                <tr>
                    <td>Material</td>
                    <td> 
                        <br/>
                        <input type="file" name="material" value=" "/></td>
                </tr>-->

            </table>
            <input type="submit" name="save2" class="btn btn-success" value="Add seminar"/>
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
        <h1>Existing seminars <a href="javascript:void(0)" onclick="jQuery('#newseminar').modal('show')" class="btn btn-primary">Add New seminar</a></h1>
        <table class="table table-striped table-bordered">
            <tr>
                <th>
                    Status
                </th>
                <th>
                    Hours
                </th>
                <th>
                    seminar Title
                </th>
                <th>
                    Category
                </th>
                <th>
                    Actions
                </th>
            </tr>
            <?php
            if (count($this->seminars) == 0) {
                echo"<tr><td colspan='3'>No seminars</td></tr>";
            } else {
                foreach ($this->seminars as $seminar) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            if ($seminar->publish == 1) {
                                echo"<a href='index.php?option=com_myaccount&view=seminars&publish=1&id=" . $seminar->id . "'>Published</a>";
                            } else {
                                echo"<a href='index.php?option=com_myaccount&view=seminars&publish=2&id=" . $seminar->id . "'>Unpublished</a>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $seminar->hours ?>
                        </td>
                        <td>
                            <?php echo $seminar->title ?>
                        </td>
                        <td>
                            <?php echo $seminar->catTitle ?>
                        </td>
                        <td>
                            <a href="index.php?option=com_myaccount&view=seminars&id=<?php echo $seminar->id ?>">Edit</a> | <a href="javascript:void(0);" onclick="deleteItem(<?php echo $seminar->id ?>)">Delete</a>
                        </td>
                    </tr>
                <?php }
            } ?>
        </table>
    </div>
</div>

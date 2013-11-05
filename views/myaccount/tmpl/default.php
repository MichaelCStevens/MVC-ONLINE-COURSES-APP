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
    function deleteCat(id){
        var r=confirm("Are you sure you want to delete this category?");
        if (r==true)
        {
            window.location='index.php?option=com_myaccount&action=deletecat&id='+id;
        } 
    }
</script> 
<style>
    div.modal {
        width:50%;
        left:40%;
    }
</style>
<div class="row-fluid">
    <div class="span12 my-account-nav">
        <h1>Advanced Fundamentals Management</h1>
        <?php echo myaccountController::buildHeader(1); ?>
    </div>
</div>
<div class="modal hide fade" id="newcat">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>New Category</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?option=com_myaccount&action=newcat" >
            <table class="table table-striped table-bordered">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" value="<?php echo $this->course->title ?>"/></td>
                </tr>


            </table>
            <input type="submit" name="save" class="btn btn-success" value="Save"/>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn"  data-dismiss="modal" aria-hidden="true">Close</a> 
    </div>
</div>
<div class="modal hide fade" id="orderemail">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Email</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?option=com_myaccount&action=updateEmail" >
            <table class="table table-striped table-bordered">
                <tr>
                    <td><span>
                            Tags:
                            <br/> <br/> 
                            [name] = Full name of user when generated<br/> 
                            <br/> <br/> <br/> 
                        </span>
                        <?php
                        $editor = JFactory::getEditor();
                        echo $editor->display('email_text', $this->emailText, '350', '400', '60', '20', false);
                        ?></td>
                </tr>


            </table>
            <input type="submit" name="save" class="btn btn-success" value="Save"/>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn"  data-dismiss="modal" aria-hidden="true">Close</a> 
    </div>
</div>
<div class="modal hide fade" id="coursecopy">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Course Copy</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?option=com_myaccount&action=updateCCopy" >
            <table class="table table-striped table-bordered">
                <tr>
                    <td><span>
                            Top copy
                            <br/> <br/> <br/> 
                        </span>
                        <?php
                        $editor1 = JFactory::getEditor();
                        echo $editor1->display('course_copy', $this->courseCopy[0], '350', '400', '60', '20', false);
                        ?>

                        <br/> <br/> <br/> 
                        Lower copy
                        <br/> <br/> <br/> 
                        </span>
                        <?php
                        $editor1 = JFactory::getEditor();
                        echo $editor1->display('course_copy2', $this->courseCopy[1], '350', '400', '60', '20', false);
                        ?>


                    </td>
                </tr>


            </table>
            <input type="submit" name="save" class="btn btn-success" value="Save"/>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn"  data-dismiss="modal" aria-hidden="true">Close</a> 
    </div>
</div>

<div class="modal hide fade" id="seminarcopy">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Live Course Copy</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?option=com_myaccount&action=updateSCopy" >
            <table class="table table-striped table-bordered">
                <tr>
                    <td><span>
                            Top copy
                            <br/> <br/> <br/> 
                        </span>
                        <?php
                        $editor2 = JFactory::getEditor();
                        echo $editor2->display('course_copy', $this->seminarCopy[0], '350', '400', '60', '20', false);
                        ?>

                        <br/> <br/> <br/> 
                        Lower copy
                        <br/> <br/> <br/> 
                        </span>
                        <?php
                        $editor3 = JFactory::getEditor();
                        echo $editor3->display('course_copy2', $this->seminarCopy[1], '350', '400', '60', '20', false);
                        ?>


                    </td>
                </tr>


            </table>
            <input type="submit" name="save" class="btn btn-success" value="Save"/>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn"  data-dismiss="modal" aria-hidden="true">Close</a> 
    </div>
</div>



<br/><br/><br/>
<div class="row-fluid" >
    <div class="span12">
        <div class="row-fluid">
            <div class="span4">
                <div class="well">
                    <h1>Manage Categories </h1>
                    <ul>
                        <?php
                        foreach ($this->cats as $cat) {
                            if ($cat->id == $this->course->cat) {
                                $sel = 'selected="selected"';
                            } else {
                                $sel = '';
                            }
                            ?>
                            <li <?php echo $sel ?> value="<?php echo $cat->id ?>"><?php echo $cat->title ?>
                                <a href="javascript:deleteCat(<?php echo $cat->id ?>)">Delete</a></li>
<?php } ?>
                    </ul>
                    <a class="btn btn-inverse" href="javascript:void(0);" onclick="jQuery('#newcat').modal('show');">New Category</a>
                </div>
            </div>
            <div class="span8">
                <div class="well">
                    <a class="btn btn-large btn-primary">Export </a><br/>
                    <a class="btn btn-large btn-warning" onclick="jQuery('#orderemail').modal('show');">Order Summary Email </a>
                    <a class="btn btn-large btn-warning" onclick="jQuery('#coursecopy').modal('show');">Change Courses Page Copy</a>
                     <a class="btn btn-large btn-warning" onclick="jQuery('#seminarcopy').modal('show');">Change Live Courses Page Copy</a>
                    <h1> Settings </h1>
                    <form>
                        <label></label>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

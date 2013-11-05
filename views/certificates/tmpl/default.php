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
           window.location='index.php?option=com_myaccount&view=certificates&delete='+x;
        }
        
    }
    function tab(x){
        jQuery('.tab').hide();
        jQuery('.tab'+x).show(); 
        
    }
 
</script> 
<div class="modal hide fade" id="newcourse">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>New Certificate</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?option=com_myaccount&view=certificates&action=newcertificate" enctype="multipart/form-data">
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
                    <td>Course</td>
                    <td><select name="cat">
                            <?php foreach ($this->courses as $cat) {
                                if ($cat->id == $this->certificate->course_id) {
                                    $sel = 'selected="selected"';
                                } else {
                                    $sel = '';
                                } ?>
                                <option <?php echo $sel ?> value="<?php echo $cat->id ?>"><?php echo $cat->title ?></option>
<?php } ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Certificate</td>
                    <td>
                        <span>
                            Tags:
                            <br/> <br/> 
                            [name] = Full name of user when generated<br/> 
                            [title] = title of course<br/> 
                            [completion-date] = date of user completion<br/> 
                            [course-number] = course number<br/> 
                            [awarded] = CEUs awarded<br/> <br/> <br/> 
                        </span>
<?php
$editor = JFactory::getEditor();
echo $editor->display('cert_text', '', '850', '400', '60', '20', false);
?>
                    </td>
                </tr>
                <tr>
                    <td>Email Text</td>
                    <td>
<?php
$editor2 = JFactory::getEditor();
echo $editor2->display('email_text', 'Hello <span>[name],<br /><br />You have successfully completed the course [course], and your certificate is attached to this email<br /><br />Thanks,<br />Advanced Fundamentals</span> ', '850', '400', '60', '20', false);
?>
                    </td>
                </tr>

            </table>
            <input type="submit" name="save" class="btn btn-success" value="Create Certificate"/>
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
        <h1>Existing Certificates<a href="javascript:void(0)" onclick="jQuery('#newcourse').modal('show');" class="btn btn-primary">Add New Certificate</a></h1>
        <table class="table table-striped table-bordered">
            <tr>
                <th>
                    Status
                </th>

                <th>
                    Certificate Title
                </th>
                <th>
                    Course
                </th>
                <th>
                    Actions
                </th>
            </tr>
            <?php
            if (count($this->certificates) == 0) {
                echo"<tr><td colspan='3'>No courses</td></tr>";
            } else {
                foreach ($this->certificates as $certificate) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            if ($certificate->publish == 1) {
                                echo"<a href='index.php?option=com_myaccount&view=certificates&publish=1&id=" . $certificate->id . "'>Published</a>";
                            } else {
                                echo"<a href='index.php?option=com_myaccount&view=certificates&publish=2&id=" . $certificate->id . "'>Unpublished</a>";
                            }
                            ?>
                        </td>

                        <td>
                            <?php echo $certificate->title ?>
                        </td>
                        <td>
                            <?php
                            foreach ($this->model->getCertCourses2($certificate->id) as $course) {
                                echo $course->title . '<br/>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="index.php?option=com_myaccount&view=certificates&id=<?php echo $certificate->id ?>">Edit</a> | <a href="javascript:void(0);" onclick="deleteItem(<?php echo $certificate->id ?>)">Delete</a>
                        </td>
                    </tr>
    <?php }
} ?>
        </table>
    </div>
</div>

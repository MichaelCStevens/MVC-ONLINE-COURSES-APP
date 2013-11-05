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
           window.location='index.php?option=com_myaccount&view=exams&delete='+x;
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
        <h3>New Exam</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="index.php?option=com_myaccount&view=exams&action=newexam" enctype="multipart/form-data">
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
                    <td>Attempts (0=unlimited)</td>
                    <td><input type="text" name="attemps" value="0"/></td>
                </tr>
                <tr>
                    <td>Threshold (in %)</td>
                    <td><input type="text" name="threshold" value="60"/></td>
                </tr>
                <tr>
                    <td>Courses</td>
                    <td><select name="cat">
                            <?php foreach ($this->courses as $cat) { ?>
                                <option value="<?php echo $cat->id ?>"><?php echo $cat->title ?></option>
                            <?php } ?>
                        </select></td>
                </tr>


            </table>
            <input type="submit" name="save" class="btn btn-success" value="Create Exam"/>
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
        <h1>Existing Exams <a href="javascript:void(0)" onclick="jQuery('#newcourse').modal('show')" class="btn btn-primary">Add New Exam</a></h1>
        <table class="table table-striped table-bordered">
            <tr>
                <th>
                    Status
                </th>

                <th>
                    Exam Title
                </th>
                <th>
                    For Courses
                </th>
                <th>
                    Actions
                </th>
            </tr>
            <?php
            if (count($this->exams) == 0) {
                echo"<tr><td colspan='3'>No courses</td></tr>";
            } else {
                foreach ($this->exams as $course) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            if ($course->publish == 1) {
                                echo"<a href='index.php?option=com_myaccount&view=exams&publish=1&id=" . $course->id . "'>Published</a>";
                            } else {
                                echo"<a href='index.php?option=com_myaccount&view=exams&publish=2&id=" . $course->id . "'>Unpublished</a>";
                            }
                            ?>
                        </td>

                        <td>
                            <?php echo $course->title ?>
                        </td>
                        <td>
                            <?php
                            foreach ($this->model->getExamCourses2($course->id) as $course) {
                                echo $course->title . '<br/>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="index.php?option=com_myaccount&view=exams&id=<?php echo $course->exam_id ?>">Edit</a> | <a href="javascript:void(0);" onclick="deleteItem(<?php echo $course->exam_id ?>)">Delete</a>
                        </td>
                    </tr>
                <?php }
            } ?>
        </table>
    </div>
</div>

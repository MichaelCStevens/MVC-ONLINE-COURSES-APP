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
        <form method="post" action="index.php?option=com_myaccount&view=courses&id=<?php echo $this->course->id ?>" enctype="multipart/form-data">
            <table class="table table-striped table-bordered">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" value="<?php echo $this->course->title ?>"/></td>
                </tr>
                <tr>
                    <td>Publish</td>
                    <td><input type="checkbox" <?php
        if ($this->course->publish == 1) {
            echo"checked='checked'";
        }
        ?> name="publish" value="1"/></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td> $<input type="text" name="price" value="<?php echo number_format($this->course->price, '2') ?>"/></td>
                </tr>
                <tr>
                    <td>Hours</td>
                    <td><input type="text" name="hours" value="<?php echo $this->course->hours ?>"/></td>
                </tr>
                 <tr>
                    <td>External Course ID</td>
                    <td><input type="text" name="ext" value="<?php echo $this->course->course_ext_id ?>"/></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td><select name="cat">
                            <?php
                            foreach ($this->cats as $cat) {
                                if ($cat->id == $this->course->cat) {
                                    $sel = 'selected="selected"';
                                } else {
                                    $sel = '';
                                }
                                ?>
                                <option <?php echo $sel ?> value="<?php echo $cat->id ?>"><?php echo $cat->title ?></option>
<?php } ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td> 
<?php
$editor = JFactory::getEditor();
echo $editor->display('description', $this->course->description, '550', '400', '60', '20', false);
?>
<!--                        <textarea style="min-width:600px;min-height:100px" name="description"> <?php echo $this->course->description ?></textarea>-->
                    </td>
                </tr>
                <tr>
                    <td>Material</td>
                    <td>
                        <h2>Course Links (internal)</h2>
                        <textarea style="width:600px"><a class="btn btn-large btn-inverse" href="javascript:void(0);" onclick="purchase(<?php echo $this->course->id ?>);">Purchase <?php echo $this->course->title ?> Now</a>
                        </textarea>
                        
                        <h2>Uploaded Files</h2>
                        <?php
                        if ($this->course->material != '') {
                            echo"Current File: <a href='" . $this->course->material . "'>" . $this->course->material . "</a>";
                        } else {
                            echo"No course material uploaded";
                        }
                        ?>
                        <br/>
                        <input type="file" name="material" value=" "/></td>
                </tr>

            </table>
            <input type="submit" name="save" class="btn btn-success" value="Update Course"/>
        </form>
    </div>
</div>

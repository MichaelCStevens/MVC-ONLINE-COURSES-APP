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
       <h1> Edit Certificate</h1>
       <form method="post" action="index.php?option=com_myaccount&view=certificates&id=<?php echo $this->certificate->id ?>" enctype="multipart/form-data">
        <table class="table table-striped table-bordered">
            <tr>
                <td>Title</td>
                <td><input type="text" name="title" value="<?php echo $this->certificate->title ?>"/></td>
            </tr>
            <tr>
                <td>Publish</td>
                <td><input type="checkbox" <?php if($this->certificate->publish==1){echo"checked='checked'";}?> name="publish" value="1"/></td>
            </tr>
        
         <tr>
                    <td>Select Courses Exam applies to:<br/> (Tip: Hold CTRL to select multiple)</td>
                    <td>
                        <?php //print_r($this->examCourses); ?>
                        <select name="cat[]" multiple>
                            <?php
                            foreach ($this->courses as $cat) {
                                $sel = '';
                             
                                foreach ($this->certCourses as $xc) {
                                    if (in_array($cat->id, $xc)) {
                                        $sel = 'selected="selected"';
                                    }
                                }
                                ?>
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
                     [license] = license number<br/> 
                     [awarded] = CEUs awarded<br/> <br/> <br/> 
                    </span>
                  <?php
$editor = JFactory::getEditor();
echo $editor->display('cert_text', $this->certificate->cert_text, '850', '400', '60', '20', false);
?>
              </td>
            </tr>
                        <tr>
                <td>Email Text</td>
                <td>
                                      <?php
$editor2 = JFactory::getEditor();
echo $editor2->display('email_text', $this->certificate->email_text, '850', '400', '60', '20', false);
?>
                </td>
            </tr>

        </table>
       <input type="submit" name="save" class="btn btn-success" value="Update Certificate"/>
    </form>
    </div>
</div>

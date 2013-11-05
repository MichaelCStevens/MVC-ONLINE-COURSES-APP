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
       <h1> Edit Study Material</h1>
       <form method="post" action="index.php?option=com_myaccount&view=study&id=<?php echo $this->study->id ?>" enctype="multipart/form-data">
        <table class="table table-striped table-bordered">
            <tr>
                <td>Title</td>
                <td><input type="text" name="title" value="<?php echo $this->study->title ?>"/></td>
            </tr>
            <tr>
                <td>Publish</td>
                <td><input type="checkbox" <?php if($this->study->publish==1){echo"checked='checked'";}?> name="publish" value="1"/></td>
            </tr>
        
            <tr>
                <td>Course</td>
                <td><select name="cat">
                       <?php foreach($this->courses as $cat){ 
                           if($cat->id==$this->study->course_id){$sel='selected="selected"';}else{$sel='';}?>
                        <option <?php echo $sel ?> value="<?php echo $cat->id ?>"><?php echo $cat->title ?></option>
                       <?php }?>
                </select></td>
            </tr>
            <tr>
                <td>Material</td>
                <td>
                    <?php if($this->study->pdf!=''){
                        echo"Current File: <a href='".$this->study->pdf."'>".$this->study->pdf."</a>";
                    }else{
                        echo"No course material uploaded";
                    } ?>
                    <br/>
                    <input type="file" name="material" value=" "/></td>
            </tr>

        </table>
       <input type="submit" name="save" class="btn btn-success" value="Update Course"/>
    </form>
    </div>
</div>

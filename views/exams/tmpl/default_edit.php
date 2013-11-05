<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//print_r($this->pendingInvites);
// $this->user->setParam('welcome', '0');
?>
<style>
    .question{border:solid 1px; padding:10px;margin-bottom:15px;}
    .answer-input {width:50px;}
    .question-text textarea{min-width:600px;min-height:100px}
</style>

<script>
    var x=0;
    function tab(x){
        jQuery('.tab').hide();
        jQuery('.tab'+x).show(); 
        
    }
    function removeQ(x){
        jQuery('.question-container .question-'+x).remove();
    }
    function addAnswer(x){
        
        jQuery('.question-'+x+' .no-answer').remove();
        var order= jQuery('.question-'+x+' .answer:last-child').attr('data-order');
        order=parseInt(order)+parseInt(1);
        var html='<div class="answer" data-order="'+order+'">'+
            '<div class="answer-text">'+ 
            '<input type="text" name="answer['+x+']['+order+'][text]" value="" />'+
            '<input type="text" class="answer-input" name="answer['+x+']['+order+'][correct]" value="0" />'+
            '</div>'+
            '</div>';
        jQuery('.question-'+x).append(html);
    }
    function addQuestion(){
       
        var order= jQuery('.question-container .question:first-child').attr('data-order');
        var order2= jQuery('.question-container .question:last-child').attr('data-order');
        if(isNaN(order2)==true){order2=0;x=1;}else{}
        if(order==0){order2=1;}
   
        order2=parseInt(order)+parseInt(1);
       
        order=parseInt(order)+parseInt(1);
        if(isNaN(order)==true){order=0;}
        if(isNaN(order2)==true){order2=1;}
        var html='<div class="question question-'+order+'" data-order="'+order+'">'+
            '<h2>Question #'+order2+':<a class="btn btn-danger" onclick="removeQ('+order+')">Delete</a></h2>'+
            '<div class="question-text"> '+
            '<textarea name="question['+order+'][question]" ></textarea>'+
            '</div>'+
            '<select name="question['+order+'][type]">'+
            '<option value="radio">Radio (Single answer)</option>'+
            ' <label>Answer Type<option value="checkbox">Checkbox (Multiple Answers)</option></label>'+
            '</select>'+ 
            '<h2>Possible Answer(s)  <a class="btn btn-info" href="javascript:addAnswer('+order+')">Add Answer</a></h2>'+ 
            '<div class="answer" data-order="0">'+
            '<div class="answer-text"> '+
            '<input type="text" name="answer['+order+'][0][text]" value=""/>'+
            '<input type="text" class="answer-input" name="answer['+order+'][0][correct]" value="1"/>'+
            '</div>'+
            '</div>'+  
            '</div>';
        jQuery('.question-container').prepend(html);
    }
</script> 
<div class="clone">

</div>
<div class="row-fluid">
    <div class="span12 my-account-nav">
        <h1>Advanced Fundamentals Management</h1>
        <?php echo myaccountController::buildHeader(1); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <h1> Edit Exam</h1>
        <form method="post" action="index.php?option=com_myaccount&view=exams&id=<?php echo $this->exam->id ?>"  >
            <table class="table table-striped table-bordered">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" value="<?php echo $this->exam->title ?>"/></td>
                </tr>
                <tr>
                    <td>Publish</td>
                    <td><input type="checkbox" <?php
        if ($this->exam->publish == 1) {
            echo"checked='checked'";
        }
        ?> name="publish" value="1"/></td>
                </tr>
                <tr>
                    <td>Attempts (0=unlimited)</td>
                    <td><input type="text" name="attemps" value="<?php echo $this->exam->attempts ?>"/></td>
                </tr>
                <tr>
                    <td>Threshold (in %)</td>
                    <td><input type="text" name="threshold" value="<?php echo $this->exam->threshold ?>"/></td>
                </tr>
                <tr>
                    <td>Select Courses Exam applies to:<br/> (Tip: Hold CTRL to select multiple)</td>
                    <td>
                        <?php //print_r($this->examCourses); ?>
                        <select name="cat[]" multiple>
                            <?php
                            foreach ($this->courses as $cat) {
                                $sel = '';
                                foreach ($this->examCourses as $xc) {
                                    if (in_array($cat->id, $xc)) {
                                        $sel = 'selected="selected"';
                                    }
                                }
                                ?>
                                <option <?php echo $sel ?> value="<?php echo $cat->id ?>"><?php echo $cat->title ?></option>
                            <?php } ?>
                        </select></td>
                </tr>


            </table>
            <a class="btn btn-larg btn-primary" href="javascript:addQuestion()">Add Question</a>     
            <input type="submit" name="save" class="btn btn-success" value="Save Exam"/>
            <input type="submit" name="save" class="btn btn-success" value="Update Exam"/>
            <br clear="both"/>
            <br clear="both"/>
            <div class="question-container">


                <?php
                foreach ($this->questions as $question) {
                    ?>
                    <div class="question question-<?php echo $question->order ?>" data-order="<?php echo $question->order ?>">
                        <h2>Question #<?php echo $question->order + 1 ?>:<a class="btn btn-danger" onclick="removeQ(<?php echo $question->order ?>)">Delete</a></h2>

                        <div class="question-text"> 
                            <textarea name="question[<?php echo $question->order ?>][question]" ><?php echo $question->question ?></textarea>
                        </div>
                        <label>Answer Type
                            <select name="question[<?php echo $question->order ?>][type]">
                                <option <?php
                if ($question->type == 'radio') {
                    echo"selected='selected'";
                }
                    ?> value="radio">Radio (Single answer)</option>
                                <option <?php
                                if ($question->type == 'checkbox') {
                                    echo"selected='selected'";
                                }
                    ?> value="checkbox">Checkbox (Multiple Answers)</option>
                            </select>
                        </label>
                        <h2>Possible Answer(s)  <a class="btn btn-info" href="javascript:addAnswer(<?php echo $question->order ?>)">Add Answer</a></h2>
                        <?php
                        $c = 0;
                        $answers = json_decode(base64_decode($question->answer));
                        // print_r($answers);
                        if (is_array($answers)) {
                            foreach ($answers as $answer) {
                                // print_r($answer); 
                                ?>
                                <div class="answer" data-order="<?php echo $c; ?>">
                                    <div class="answer-text"> 
                                        <input type="text"  value="<?php echo $answer->text ?>" name="answer[<?php echo $question->order ?>][<?php echo $c ?>][text]"/>
                                        <input type="text" class="answer-input" value="<?php echo $answer->correct ?>" name="answer[<?php echo $question->order ?>][<?php echo $c ?>][correct]" />
                                    </div>
                                </div>
                                <?php
                                $c++;
                            }
                        } else {
                            echo"<h3 class='no-answer'>This question needs an answer</h3>";
                        }
                        ?>

                    </div>
                    <?php
                }
                ?>
            </div>
            <input type="submit" name="save" class="btn btn-success" value="Update Exam"/>
        </form>
    </div>
</div>

<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<style>
    .depbtns,.moduletable .row-fluid, .alertt {display:none}
    #content {margin-top:325px}
    #sidebar{margin-top:300px}
    body.view-home .header{ }
    .footer{margin-top:994px}

</style>
<script>
    function slidedown(){
        jQuery(".carousel-control").slideDown();
        jQuery(".carousel-control").animate({
            opacity: 0.9,
            duration: 800
        }).delay(500).animate({
            duration: 800,
            opacity: 0.6
        }).animate({
            duration: 800,
            opacity: 0.9
        }).animate({
            duration: 800,
            opacity: 0.6
        }).removeAttr('style').attr('style', 'display:block ');
      
    }
    jQuery(document).ready(function($) {
        jQuery(".carousel-control").hover( function () {
            jQuery(".carousel-control").animate({
                opacity: 0.9,
                duration: 800
            }) 
        },
        function () {
            jQuery(".carousel-control").animate({
                duration: 800,
                opacity: 0.6
            }).removeAttr('style').attr('style', 'display:block ');
        });
        $('#myCarousel').carousel({
            interval: 6000
        })
        setTimeout('slidedown()', 500); 
        jQuery("#create-league").validate();
        jQuery(".icon, .icon img").click(function() {resetDate();
            jQuery(this).next().children('[name="season_id"]').attr("checked", true);
            jQuery(".other-season").val('');
            // alert('clicked');
        });
        jQuery(".radio text").click(function() {
            resetDate();
            jQuery(this).prev().attr("checked", true);
            jQuery(".other-season").val('');
            // alert('clicked');
        });
        jQuery(".other-season").click(function() {
            jQuery(this).prev().prev().attr("checked", true);
            resetDate();
            // alert('clicked');
        });
        jQuery(".fee-calc .up, .fee-calc .up i").click(function() {
            var fee=jQuery('#LatePaymentFee').val();
            var newfee= parseInt(fee)+ 1;
            console.log('new fee '+newfee);
            jQuery('#LatePaymentFee').val(newfee);
            jQuery('.fee-calc .viewfee span').text(newfee);
        });
        jQuery(".fee-calc .down, .fee-calc .down i").click(function() {
            var fee=jQuery('#LatePaymentFee').val();
            if(fee==0){return;}
            var newfee= parseInt(fee)- parseInt(1);
            console.log('new fee '+newfee);
            jQuery('#LatePaymentFee').val(newfee);
            jQuery('.fee-calc .viewfee span').text(newfee);
        });
        jQuery(".cr-calc .up, .cr-calc .up i").click(function() {
            var fee=jQuery('#CommissionerReimbursementAmount').val();
            var newfee= parseInt(fee)+ 1;
            console.log('new fee '+newfee);
            jQuery('#CommissionerReimbursementAmount').val(newfee);
            jQuery('.cr-calc .viewfee span').text(newfee);
        });
        jQuery(".cr-calc .down, .cr-calc .down i").click(function() {
            var fee=jQuery('#CommissionerReimbursementAmount').val();
            if(fee==0){return;}
            var newfee= parseInt(fee)- parseInt(1);
            console.log('new fee '+newfee);
            jQuery('#CommissionerReimbursementAmount').val(newfee);
            jQuery('.cr-calc .viewfee span').text(newfee);
        });
       
    });
    function toggleDeadline(){
        if(jQuery('#PaymentDeadline').attr('readonly') =='readonly'){
            jQuery('#PaymentDeadline').removeAttr("readonly");
            jQuery("#PaymentDeadline").datepicker({});
        }else{
            jQuery('#PaymentDeadline').attr('readonly', true);
            jQuery("#PaymentDeadline").datepicker("destroy");
        }
    }
    function resetDate(){
        jQuery('#PaymentDeadline').attr('readonly', true);
        jQuery("#PaymentDeadline").datepicker("destroy");
        jQuery("#PaymentDeadline").val('');
    }
    function toggleLate(){
        if(jQuery('#LatePaymentFee').attr('readonly') =='readonly'){
            jQuery('#LatePaymentFee').removeAttr("readonly");
        }else{
            console.log('payment attr: '+jQuery('#LatePaymentFee').attr('readonly'));
            jQuery('#LatePaymentFee').attr('readonly', true);
        }
    } function toggleCom(){
        if(jQuery('#CommissionerReimbursementAmount').attr('readonly') =='readonly'){
            jQuery('#CommissionerReimbursementAmount').removeAttr("readonly");
        }else{
            console.log('payment attr: '+jQuery('#CommissionerReimbursementAmount').attr('readonly'));
            jQuery('#CommissionerReimbursementAmount').attr('readonly', true);
        }
    } </script>
<div class="green-stripe">
    <div class="row-fluid ">
        <div class="span4 green1" style=" ">&nbsp;</div>
        <div class="span4 green2" style=" ">&nbsp;</div>
        <div class="span4 green3" style=" ">&nbsp;</div>
    </div></div>
<div class="new-blue top">
    <div class="container">
        <div class="row-fluid ">
            <div class="span4 " style=" "> 
                <div class="box box1">
                    Create a group and register an account
                </div>
            </div>
            <div class="span4 " style=" "> 
                <div class="box box2">
                    Invite group members with automated emails and sign up.
                </div>

            </div>
            <div class="span4 " style=" "> 
                <div class="box box3">
                    Withdraw your funds, collecting your group payments just became easier!
                </div>

            </div>
        </div>
        <div class="row-fluid">
            <div class="span12 heading-msg">
                Pay as a group in three easy steps.
            </div>
        </div>
    </div>
</div>
<div class="green-stripe green-stripe2">
    <div class="row-fluid ">
        <div class="span4 green1" style=" ">&nbsp;</div>
        <div class="span4 green2" style=" ">&nbsp;</div>
        <div class="span4 green3" style=" ">&nbsp;</div>
    </div></div>


<div class="info-box">
    <div class="txt-bg">
        <h2 id="create-league">What is GroupPaybook?</h2>
        Easily collect funds for your Group Event. GroupPaybook takes away all the hassle of collecting funds from a group of people 
        <a style="width:90%"class="btn btn-primary" href="https://grouppaybook.com/updated/grouppaybook/index.php?option=com_grouppaybook&view=CreateGroup">Get Started</a>
    </div>
</div>


<div class="row-fluid">
    <div class="span12"> 
        <div id="myCarousel" class="carousel slide">
            <!-- Carousel items -->
            <div class="carousel-inner">

                <div class="active  item item1 ">




                </div>
                <div class="item item2"> <div id="create-league">

                        <!--   <a class="btn btn-large btn-warning" href="index.php?option=com_grouppaybook&view=grouppaybook&action=Make-Payment">Get Started</a>--></div>
                </div>
                <div class="item item3"> <div id="create-league">

                        <!--                        <a class="btn btn-large btn-warning" href="index.php?option=com_grouppaybook&view=grouppaybook&action=Make-Payment">Get Started</a>--></div>
                </div>

            </div>
            <!-- Carousel nav -->
            <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </div>
    </div>

</div>
<!--
<div class="row-fluid" style="margin-bottom: 25px">
    <div class="span12">
        <h1>  The online solution for your group transactions</h1>
        We make multiple participant payments easier.
        Many features including multiple payment options, commissions, deadlines etc. 

    </div>
</div>

<div class="row-fluid" style="margin-bottom: 8px">
    <div class="span12">
        <a class="btn btn-large btn-success"href="index.php?option=com_grouppaybook&view=CreateGroup">Get Started</a> 
    </div>

</div>-->
<div class="row-fluid contests">

    <div class="span12 panel-bg" style="">
        <div style="padding:10px">
            <h1>2013 Contests</h1>
            2013 Grouppaybook Fantasy Football Contest - We'll pay your dues - <a href="#">find out how</a>
        </div>
    </div>
</div>
<br/>

<div class="row-fluid two-col">
    <div class="span8 panel-bg col" style=" ">
        <div style="padding:10px">
            <h1>Find out whats happening </h1>
            <?php
            jimport('joomla.application.module.helper');
            $module = JModuleHelper::getModule('mod_latestblogs', 'Featured Groups');
            $params = '{"type":"0","routingtype":"default","menuitemid":"152","catid":["all"],"usefeatured":"1","bloggerlisttype":"exclude","bloggerlist":"","showbavatar":"0","showwebsite":"0","showbcount":"0","biography_length":"50","cid":"0","showcavatar":"0","showccount":"0","tagid":"","showtcount":"1","tid":"","showtavatar":"1","striptags":"0","dateformat":"%d %B %Y","count":"3","showintro":"1","textcount":"350","showcontent":"0","showauthor":"0","showavatar":"0","showcommentcount":"1","showratings":"0","enableratings":"1","showhits":"0","showreadmore":"1","showdate":"1","showcategory":"1","includesubcategory":"0","sortby":"latest","video_show":"1","video_width":"250","video_height":"250","photo_show":"1","photo_width":"","photo_height":"","alignment":"default","moduleclass_sfx":"","cache":"0","cache_time":"900","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}';
            jimport('joomla.application.module.helper');
            $modulePosition = "position-fp";
            $modules = JModuleHelper::getModules($modulePosition);

            foreach ($modules as $module) {
               // print_r($module);echo"<br/><br/><br/>";
                $module->params = $params; // $eventid is Unique ID for Event  
               // print_r($module);
                echo JModuleHelper::renderModule($module);
            }
            ?>


        </div> 
    </div>   
    <div class="span4 panel-bg col" style=" ">
        <div style="padding:10px">
            <h1>Featured Groups</h1>  
            <?php foreach ($this->featuredGroups as $group) { ?>
                <div class="featured-item">
                    <div class="image">
                        <a href="index.php?option=com_grouppaybook&view=group&id=<?php echo $group->id ?>"> 
                            <?php if ($group->photo == '') { ?>
                                <img src="images/groups/default-group.gif"/> 
                            <?php } else { ?>
                                <img src="images/groups/<?php echo $group->photo ?>"/>
                            <?php } ?>
                        </a>
                    </div>
                    <div class="caption"> <a href="index.php?option=com_grouppaybook&view=group&id=<?php echo $group->id ?>"><?php echo $group->group_name ?></a></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<br/>


<div class="expand-full">
    <div class="green-stripe bst" style="">
        <div class="row-fluid ">
            <div class="span4 green1" style=" ">&nbsp;</div>
            <div class="span4 green2" style=" ">&nbsp;</div>
            <div class="span4 green3" style=" ">&nbsp;</div>
        </div>

    </div>
    <div class="new-blue testimonials bst" style=" ">
       

        <div class="container">
            <div class="row-fluid ">
                <div class="span4 " style=" "> 
                    <div class="box box1">
                        I like GroupPaybook
                        <br/><br/>
                        <span>-Happy Customer</span>
                    </div>
                </div> 
                <div class="span4 " style=" "> 
                    <div class="box box1">
                        Another great testimonial
                        <br/><br/>
                        <span>-Happy Customer</span>
                    </div> 
                </div>
                <div class="span4 " style=" "> 
                    <div class="box box1">
                        Get Started 
                        <br/><br/>
                        <span>-Happy Customer</span>
                    </div> 
                </div>
            </div>
        </div>
    </div>


    <div class="green-stripe green-stripe2 bst" style="position:relative">
        <div class="row-fluid ">
            <div class="span4 green1" style=" ">&nbsp;</div>
            <div class="span4 green2" style=" ">&nbsp;</div>
            <div class="span4 green3" style=" ">&nbsp;</div>
        </div>

    </div>
</div>
<div class="expand-full how-does ">
    <div class="row-fluid">
        <div class="span2" style=" "></div>
             <div class="span4" style=" "><img src="images/tablet.png"/></div>
             <div class="span4" style=" ">
                 <h3>How does Group Paybook work?</h3>
                 But I must explain to you how all this mistaken idea of denouncing pleasure 
                 and praising pain was born and I will give you a complete account of the system, 
                 and expound the actual teachings of the great explorer of the truth, the master-builder 
                 of human happiness. 
             </div>
              <div class="span2" style=" "></div>
    </div>
    
</div>

<div class="expand-full expand-last">
    <div class="green-stripe bst" style="">
        <div class="row-fluid ">
            <div class="span4 green1" style=" ">&nbsp;</div>
            <div class="span4 green2" style=" ">&nbsp;</div>
            <div class="span4 green3" style=" ">&nbsp;</div>
        </div>

    </div>
    <div class="new-blue bst" style=" ">
        <div class="container">
            <div class="row-fluid ">
                <div class="span12 " style="text-align:center">  
                    <a class="btn btn-primary">Get Started</a>
                </div>
            </div>
        </div>

    </div>
    <div class="green-stripe green-stripe2 bst" style="position:relative">
        <div class="row-fluid ">
            <div class="span4 green1" style=" ">&nbsp;</div>
            <div class="span4 green2" style=" ">&nbsp;</div>
            <div class="span4 green3" style=" ">&nbsp;</div>
        </div>
    </div>
</div>







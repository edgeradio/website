<?php include '../templates/common_start.php'; ?>
<body>
<?php include '../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="one_column">
    <img src="swagtop.png">
<div style="padding-right: 230px; background: #FFFFFF;" class="rounded">
        <h1 style="font-size: 48px; font-weight: normal;" class="title">Get Creative!</h1>
        <p>Get your creative hat on and help Edge come up with our new t-shirt designs!</p>

<p>Edge Radio is needs some radical new tee designs to promote who we are and the important part youth community radio plays in the local community. So let us concentrate on bringing you our never ending flow of new local, national and international music, and you help us by coming up with some new t-shirt designs and a catch phase for the massive year that 2012 is lining up to be.</p>

<p>We at Edge are great at what we do but some of us aren’t the most creative people in the world when it comes to this stuff. But we do know what we like so we will select the best three of each and then load them up on the website so you the listeners can decide.</p>

<p>This time, we need your help, we need you to get creative and while you are at it don’t forget to let us know your thoughts and opinions!</p>
       
      </div>
      <br>
      

      
      <div style="padding-right: 200px; background: #FFFFFF;" class="rounded">
        <h1 style="font-size: 48px; font-weight: normal; font-weight: normal;" class="title">What Can You Win?</h1>
        
        
    <div style="clear: both; margin-bottom: 10px;">
     <div class="title" style="float: left; width: 30px; min-height: 30px; text-align: center; background-color: #F01313; padding: 10px; color: #FFFFFF;">1st<br><span style="font-size: 16px;">PRIZE</span></div>
     <div style="float: left; width: 670px; min-height: 50px; background-color: #F0F0F0; padding: 10px; color: #000000;">
     <div class="title" style="line-height: 28px;">Edge Radio Scooter + Edge Radio Tee With Your Design!</div>
     <p>Nothing says 'I own the road!' more than an Edge Radio Scooter! A must have for swag strutters around Hobart streets. Easy folding, Adjustable height, High-Speed ABEC-5 bearing and 125mm pimp wheels. <i>(Valued at over $70+)</i></p>
     </div>
     </div>
     <div style="clear: both;"></div>
     <br>
     <div style="clear: both; margin-bottom: 10px;">
     <div class="title" style="float: left; width: 30px; min-height: 30px; text-align: center; background-color: #F01313; padding: 10px; color: #FFFFFF;">2nd<br><span style="font-size: 16px;">PRIZE</span></div>
     <div style="float: left; width: 670px; min-height: 50px; background-color: #F0F0F0; padding: 10px; color: #000000;">
     <div class="title" style="line-height: 28px;">Red Herring Surf Gift Voucher + Edge Radio Tee With Your Design!</div>
     <p>Earn more swag with some clothing from Tassies original surf clothing shop! A Red Herring Surf gift voucher will be yours!</p>
     </div>
     </div>
     <div style="clear: both;"></div>
       <br>
      </div>
      <br>
      
        <div class="rounded">
        <h1 style="font-size: 48px; font-weight: normal;" class="title">Vote For Your Fav!</h1>


<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
$(function() {

$(".vote").click(function() 
{

var id = $(this).attr("id");
var name = $(this).attr("name");
var dataString = 'id='+ id ;
var parent = $(this);


if(name=='up')
{

$(this).fadeIn(200).html('...');
$.ajax({
   type: "POST",
   url: "up_vote.php",
   data: dataString,
   cache: false,

   success: function(html)
   {
    parent.html(html);
  
  }  });
  
}
else
{

$(this).fadeIn(200).html('...');
$.ajax({
   type: "POST",
   url: "down_vote.php",
   data: dataString,
   cache: false,

   success: function(html)
   {
       parent.html(html);
  }
   
 });


}
  
  
   
 

return false;
	});

});
</script>

<style type="text/css">
#main
{
height:280px; border-bottom:1px dashed #000000;margin:7px;
}
a
{
color:#DF3D82;
text-decoration:none;

}
a:hover
{
color:#DF3D82;
text-decoration:underline;

}
.up
{
height:28px; font-size:24px; text-align:center; background-color:#009900; margin-bottom:2px;padding-top:12px;
-moz-border-radius: 6px;-webkit-border-radius: 6px;
}
.up a
{
color:#FFFFFF;
text-decoration:none;

}
.up a:hover
{
color:#FFFFFF;
text-decoration:none;

}
.down
{
height:28px; font-size:24px; text-align:center; background-color:#cc0000; margin-top:2px;padding-top:12px;
-moz-border-radius: 6px;-webkit-border-radius: 6px;
}

.down a
{
color:#FFFFFF;
text-decoration:none;

}
.down a:hover
{
color:#FFFFFF;
text-decoration:none;

}
.box1
{
float:left; height:250px; width:50px;
}

.box2
{
float:left; text-align:left;
margin-left:10px;height:250px;margin-top:10px;
font-weight:bold;width:800px;

font-size:18px;
}

</style>

<?php
include('config.php');
$sql=mysql_query("SELECT * FROM messages  LIMIT 9");
while($row=mysql_fetch_array($sql))
{
$msg=$row['msg'];
$msg2=$row['msg2'];
$mes_id=$row['mes_id'];
$img=$row['image'];
$up=$row['up'];
$down=$row['down'];
?>

<div id="main">


<div class="box1">
<div class='up'><a href="" class="vote" id="<?php echo $mes_id; ?>" name="up">

<?php echo $up; ?></a></div>


</div>


<div class='box2' ><img style="float: right; width: 250px; height: 220px;" src="<?php echo $img; ?>"><div class="title" style="font-weight: normal; font-size: 58px; padding: 5px;"><?php echo $msg; ?></div>
<div class="title" style="font-weight: normal; font-size: 28px; padding: 5px;"><?php echo $msg2; ?></div></div>




</div>


<?php
}

?>



</div>
<br />
      
      
    
      <div class="rounded">
        <h1 style="font-size: 48px; font-weight: normal;" class="title">Terms & Conditions</h1>
        
        <small>You may enter the competition as many times as you like, but please, no duplicate entries. Any duplicates will be counted as one entry. The top three entries each will be judged by the Edge staff and posted online for users to vote. Entries open 25th June 2013 and close on 15th July 2012. Sorry worldwide folks, Australian entrants only. Feel free to submit an entry if you like, but be aware we won't be able to consider you for a prize.</small>
        
        <br>
<br>
        <small>Edge Radio reserves the rights to re-publish all content submitted via the form (including t-shirt designs). All credits will be respected for your designs (such as your name in the description of the Edge Shop).</small>
       
        <br>
<br>
          
      </div>
      
  <div id="footer">
        <?php include '../templates/footer.php'; ?>
      </div>
      
    </div>
  </div>
</div>
<?php include '../templates/common_end.php'; ?>

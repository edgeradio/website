<?php include('scheduleMaker.php');
include '../inc/database.programs.php'; ?>

<div id="schedule" style="height: 1320px">
<?php 

   $sm = new ScheduleMaker(500, 1300, 0, 0, 1);
   $sm->setBeginEndTime("6:00", "25:00");
   
$event = new Event('6am', '0', '6:00', '7:00', '');
   $sm->addEvent($event);
$event = new Event('7am', '0', '7:00', '8:00', '');
   $sm->addEvent($event);
$event = new Event('8am', '0', '8:00', '9:00', '');
   $sm->addEvent($event);
$event = new Event('9am', '0', '9:00', '10:00', '');
   $sm->addEvent($event);
$event = new Event('10am', '0', '10:00', '11:00', '');
   $sm->addEvent($event);
$event = new Event('11am', '0', '11:00', '12:00', '');
   $sm->addEvent($event);
$event = new Event('12pm', '0', '12:00', '13:00', '');
   $sm->addEvent($event);
$event = new Event('1pm', '0', '13:00', '14:00', '');
   $sm->addEvent($event);
$event = new Event('2pm', '0', '14:00', '15:00', '');
   $sm->addEvent($event);
$event = new Event('3pm', '0', '15:00', '16:00', '');
   $sm->addEvent($event);
$event = new Event('4pm', '0', '16:00', '17:00', '');
   $sm->addEvent($event);
$event = new Event('5pm', '0', '17:00', '18:00', '');
   $sm->addEvent($event);
$event = new Event('6pm', '0', '18:00', '19:00', '');
   $sm->addEvent($event);
$event = new Event('7pm', '0', '19:00', '20:00', '');
   $sm->addEvent($event);
$event = new Event('8pm', '0', '20:00', '21:00', '');
   $sm->addEvent($event);
$event = new Event('9pm', '0', '21:00', '22:00', '');
   $sm->addEvent($event);
$event = new Event('10pm', '0', '22:00', '23:00', '');
   $sm->addEvent($event);
$event = new Event('11pm', '0', '23:00', '24:00', '');
   $sm->addEvent($event);
$event = new Event('12am - 6am', '0', '24:00', '25:00', '');
   $sm->addEvent($event);
   
   $event = new Event('Edge Tunes', '1234567', '24:00', '25:00', 'All Night');
   $sm->addEvent($event);

$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%H:%i') as start_time, DATE_FORMAT(end_time, '%H:%i') as end_time FROM program_info WHERE edgetunes != 'true'",$db);
 while ($info = mysql_fetch_array($inforesult)) {
  
  if($info['day_time'] == 'Monday') {
   $day_time = 1;
   } elseif($info['day_time'] == 'Tuesday') {
   $day_time = 2;
   } elseif($info['day_time'] == 'Wednesday') {
   $day_time = 3;
   } elseif($info['day_time'] == 'Thursday') {
   $day_time = 4;
   } elseif($info['day_time'] == 'Friday') {
   $day_time = 5;
   } elseif($info['day_time'] == 'Saturday') {
   $day_time = 6;
   } elseif($info['day_time'] == 'Sunday') {
   $day_time = 7;
   } 
$title = stripslashes($info['title']);

if($info['end_time'] == '00:00') {
 $end_time = '24:00';
 } else {
  $end_time = $info['end_time'];
  }

$start_time = $info['start_time'];

  $event = new Event('<a style="color: #000000;" href="http://www.edgeradio.org.au/programs/'.$info['day_time'].'/'.str_replace(" ","-",$info['seotitle']).'/">'.$title.'</a>', ''.$day_time.'', ''.$start_time.'', ''.$end_time.'', ''.stripslashes($info['summary']).'');
   $sm->addEvent($event);
  
  }
  
  $inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%H:%i') as start_time, DATE_FORMAT(end_time, '%H:%i') as end_time FROM program_info WHERE edgetunes = 'true'",$db);
 while ($info = mysql_fetch_array($inforesult)) {
  
  if($info['day_time'] == 'Monday') {
   $day_time = 1;
   } elseif($info['day_time'] == 'Tuesday') {
   $day_time = 2;
   } elseif($info['day_time'] == 'Wednesday') {
   $day_time = 3;
   } elseif($info['day_time'] == 'Thursday') {
   $day_time = 4;
   } elseif($info['day_time'] == 'Friday') {
   $day_time = 5;
   } elseif($info['day_time'] == 'Saturday') {
   $day_time = 6;
   } elseif($info['day_time'] == 'Sunday') {
   $day_time = 7;
   } 
$title = stripslashes($info['title']);

if($info['end_time'] == '00:00') {
 $end_time = '24:00';
 } else {
  $end_time = $info['end_time'];
  }

$start_time = $info['start_time'];

  $event = new Event('<b>'.$title.'</b>', ''.$day_time.'', ''.$start_time.'', ''.$end_time.'', '');
   $sm->addEvent($event);
  
  }
   
   
   $sm->printHTML();

?>
</div>
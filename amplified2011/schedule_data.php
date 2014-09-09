<?php include('scheduleMaker.php');
include '../inc/database.programs.php'; ?>

<div id="schedule" style="height: 730px">
<?php 

   $sm = new ScheduleMaker(730, 700, 0, 0, 1);
   $sm->setBeginEndTime("10:00", "24:00");
   
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
   
   $event = new Event('<a href="http://www.facebook.com/event.php?eid=215424491836706" target="_blank">Music Industry Legals Workshop</a>', '1', '18:30', '21:00', 'Presented by Darren Sanicki of DS Lawyers.');
   $sm->addEvent($event);
   
   $event = new Event('<a href="http://www.facebook.com/event.php?eid=215424491836706" target="_blank">Stories at the Theatre</a>', '1', '16:00', '18:00', 'Dean Stevenson & the Arco Set, Lincoln le Fevre, The Colemans.');
   $sm->addEvent($event);
   
   $event = new Event('<a href="http://www.facebook.com/event.php?eid=215424491836706" target="_blank">Wide Angle Music Video Competition</a>', '1', '19:00', '21:00', 'Presented by Wide Angle. Phone 6223 8334 or email info@wideangle.org.au to register.');
   $sm->addEvent($event);
   
   $event = new Event('<a href="http://www.facebook.com/event.php?eid=215424491836706" target="_blank">Music Markets 1-on-1</a>', '2', '12:00', '17:00', 'Presented by Millie Millgate of Sounds Australia. Email programofficer@cmst.com.au to register.');
   $sm->addEvent($event);
   
   $event = new Event('<a href="http://www.facebook.com/event.php?eid=215424491836706" target="_blank">Edge Radio Live from the Mall</a>', '2', '12:00', '15:00', 'Featuring: James Dilger, Daylight Tremor, The Colemans, Sarah Everett, Deb Wace. Simulcast on Edge Radio 99.3FM.');
   $sm->addEvent($event);
   
   $event = new Event('<a href="http://www.facebook.com/event.php?eid=215424491836706" target="_blank">Youth ARC Showcase: Local. Live. Loud.</a>', '2', '18:00', '21:30', 'Featuring: Maddy Jane, Jane Young, Asta Evelyn, Treehouse, Bring Sophy to Me, Ben Wells and the Middle Names.');
   $sm->addEvent($event);
   
   $event = new Event('<a href="http://www.facebook.com/event.php?eid=215424491836706" target="_blank">One Fine Weekend</a>', '2', '18:00', '24:00', 'Featuring: Adam Cousens Band, Enola Fall, New Saxons, Sole Stickers, Guthrie, Wolfe Brothers, Agent Fontaine, Invisible Boy. $12 pre/$15 door/$28 weekend.');
   $sm->addEvent($event);
   
   $event = new Event('<a href="http://www.facebook.com/event.php?eid=215424491836706" target="_blank">APRA Roadshow</a>', '2', '19:00', '21:00', 'Presented by APRA. Email programofficer@cmst.com.au to register.');
   $sm->addEvent($event);
   
   
   $sm->printHTML();

?>
</div>
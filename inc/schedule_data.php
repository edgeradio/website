<?php include('inc/scheduleMaker.php'); ?>

<div id="schedule" style="height: 920px">
<?php 

   $sm = new ScheduleMaker(500, 900, 0, 0, 1);
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
$event = new Event('12am', '0', '12:00', '13:00', '');
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
$event = new Event('12pm-7am', '0', '24:00', '25:00', '');
   $sm->addEvent($event);

//Edge Tunes

  $event = new Event('Edge Tunes all night', '1234567', '24:00', '25:00', '');
   $sm->addEvent($event);
   
   $event = new Event('Edge Tunes', '12345', '6:00', '7:00', '');
   $sm->addEvent($event);

$event = new Event('Edge Tunes', '1234', '15:00', '16:00', '');
   $sm->addEvent($event);
   
   $event = new Event('Edge Tunes', '12345', '16:00', '17:00', '');
   $sm->addEvent($event);
   
        $event = new Event('Edge Tunes', '3', '10:00', '11:00', '');
   $sm->addEvent($event);
   
      $event = new Event('Edge Tunes', '4', '21:00', '22:00', '');
   $sm->addEvent($event);
   
  $event = new Event('Edge Tunes', '5', '14:00', '15:00', '');
   $sm->addEvent($event);
   
    $event = new Event('Edge Tunes', '7', '21:00', '22:00', '');
   $sm->addEvent($event);
        

//Mondays Programming

   $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?f=11&t=1715">Edge & Bacon</a>', '1', '7:00', '10:00', 'Wake Up On The Right Side Of The Bed with Alex');
   $sm->addEvent($event);

  $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=778&amp;postorder=desc">Borderlines</a>', '1', '10:00', '12:00', 'Get Fabulously Queer With Borderlines!');
   $sm->addEvent($event);
   
    $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1410&amp;postorder=desc">Edge Lunchbox</a>', '1', '12:00', '14:00', 'Opening Up A Lunchtime Treat With Kate');
   $sm->addEvent($event);
   
    $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1428&amp;postorder=desc">The F1 Show</a>', '1', '14:00', '15:00', 'Tasmania&rsquo;s Only Formula 1 Show
');
   $sm->addEvent($event);
   
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1499&amp;postorder=desc">Hobart Comedy Shake&rsquo;n&rsquo;Bake</a>', '1', '17:00', '18:00', 'Weekly Wrap Of Hobart&rsquo;s Comedy Scene');
   $sm->addEvent($event);
     
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=622&amp;postorder=desc">What I Say</a>', '1', '18:00', '19:00', 'Music: All Genres, All Eras');
   $sm->addEvent($event);
        
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=733&amp;postorder=desc">My Vinyl Weighs a Ton</a>', '1', '19:00', '20:00', 'Dusty Fingers Digging Funk, Jazz &amp; Afro-Grooves');
   $sm->addEvent($event);
           
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1436&amp;postorder=desc">Unknown Pleasures/Under The Influence</a>', '1', '20:00', '22:00', 'Hip, Interesting, Compelling &amp; Contemporary');
   $sm->addEvent($event);
   
         $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1560&amp;postorder=desc">Living In The Past</a>', '1', '22:00', '24:00', 'Musically');
   $sm->addEvent($event);
   
   
   //Tuesdays Programming
   
      $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=834&amp;postorder=desc">The Morning Bell</a>', '2', '7:00', '10:00', 'Unravelling The Mysteries Of Everyday Life');
   $sm->addEvent($event);

  $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1109&amp;postorder=desc">Entree</a>', '2', '10:00', '12:00', 'Take A Bite Of Entree With Ana &amp; Tat');
   $sm->addEvent($event);
   
    $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1500&amp;postorder=desc">Edge Lunchbox</a>', '2', '12:00', '14:00', 'Opening Up A Lunchtime Treat');
   $sm->addEvent($event);
   
    $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1107&amp;postorder=desc">The Bugle</a>', '2', '14:00', '15:00', 'Community Focused News &amp; Interviews');
   $sm->addEvent($event);
   
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=368&amp;postorder=desc">Film Central</a>', '2', '17:00', '18:00', 'Film-Related News &amp; Reviews');
   $sm->addEvent($event);
     
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=950&amp;postorder=desc">The Book Show</a>', '2', '18:00', '19:00', 'Everything Book Related With Paige Turner');
   $sm->addEvent($event);
        
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1474&amp;postorder=desc">Return To Oz</a>', '2', '19:00', '20:00', 'New Australian Releases &amp; Classics');
   $sm->addEvent($event);
           
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=791&amp;postorder=desc">Tasmusica</a>', '2', '20:00', '22:00', 'Tassie&rsquo;s Best Local &amp; Original Music');
   $sm->addEvent($event);
   
         $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=792&amp;postorder=desc">Killawatts</a>', '2', '22:00', '24:00', 'Hobart&rsquo;s Premier Hard Rock Show');
   $sm->addEvent($event);
    
   
   
     //Wednesdays Programming
	 
   $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?f=11&t=1624">Edge Breakfast</a>', '3', '7:00', '10:00', 'Wake Up On The Right Side Of The Bed with Melanie');
   $sm->addEvent($event);
   
   $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1561&amp;postorder=desc">Talk Derby To Me</a>', '3', '11:00', '12:00', 'Women&rsquo;s Flat Track Roller Derby');
   $sm->addEvent($event);
   
    $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1477&amp;postorder=desc">Edge Lunchbox</a>', '3', '12:00', '14:00', 'Opening Up A Lunchtime Treat With Nicole &amp; Oz');
   $sm->addEvent($event);
   
   	      $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewforum.php?f=1528&amp;postorder=desc">To The Edge Of Within</a>', '3', '14:00', '15:00', 'Mind, Spirit &amp; Everything Inbetween');
   $sm->addEvent($event);
   
          $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1501&amp;postorder=desc">Half Back Flankers</a>', '3', '17:00', '18:00', 'This Weeks Sporting Banter');
   $sm->addEvent($event);
      
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1397&amp;postorder=desc">Culture Shock</a>', '3', '18:00', '19:00', 'The Same Stuff, But Different');
   $sm->addEvent($event);
        
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1562&amp;postorder=desc">The Punters Club</a>', '3', '19:00', '20:00', 'Gig Previews &amp; Reviews');
   $sm->addEvent($event);
           
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=983&amp;postorder=desc">Microphone Check</a>', '3', '20:00', '22:00', 'Edge&rsquo;s Newest Hip Hop Tunes');
   $sm->addEvent($event);
   
         $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1314&amp;postorder=desc">Sonography</a>', '3', '22:00', '24:00', 'Experimental Music &amp; Soundscapes');
   $sm->addEvent($event);
    
   
   
       //Thursdays Programming
	   
   $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1399&amp;postorder=desc">Dawn Transmission</a>', '4', '7:00', '9:59', 'Sunrise, For Your Ears');
   $sm->addEvent($event);
   
   $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1502&amp;postorder=desc">Listen Up With Georgie</a>', '4', '10:00', '12:00', 'News, Views &amp; Great Tunes');
   $sm->addEvent($event);
   
    $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1413&amp;postorder=desc">Edge Lunchbox</a>', '4', '12:00', '14:00', 'Opening Up A Lunchtime Treat');
   $sm->addEvent($event);
   
    $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1563&amp;postorder=desc">Craft Is The New Black</a>', '4', '14:00', '15:00', 'Quirky, Creative &amp; Crafty Conversations');
   $sm->addEvent($event);
   
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1372&amp;postorder=desc">Edge Radio Recommends</a>', '4', '17:00', '18:00', 'Recommended By Us');
   $sm->addEvent($event);
     
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1564&amp;postorder=desc">The Vivisection</a>', '4', '18:00', '19:00', 'New Release Music');
   $sm->addEvent($event);
        
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1433&amp;postorder=desc">North American Scum</a>', '4', '19:00', '21:00', 'Canadian &amp; US Indie Music');
   $sm->addEvent($event);
   
         $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1409&amp;postorder=desc">Hallowed Sounds</a>', '4', '22:00', '24:00', 'Goth Across The Spectrum');
   $sm->addEvent($event);
    
   
   

       //Fridays Programming	 
	 
   $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=889&amp;postorder=desc">Breakfast On The Brink</a>', '5', '7:00', '10:00', 'Hobart&rsquo;s Voice For Inclusion');
   $sm->addEvent($event);
   
    $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1313&amp;postorder=desc">Grassroots Eco Radio</a>', '5', '10:00', '12:00', 'Environmental Radio');
   $sm->addEvent($event);
   
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1478&amp;postorder=desc">Edge Lunchbox</a>', '5', '12:00', '14:00', 'Opening Up A Lunchtime Treat');
   $sm->addEvent($event);

$event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?f=11&t=1758">Arvos</a>', '5', '15:00', '17:00', 'with Ivor and Nyssa');
   $sm->addEvent($event);
   
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1485&amp;postorder=desc">The Soul Funk Experiment</a>', '5', '17:00', '18:00', 'It&rsquo;s Soulful, It&rsquo;s Funky');
   $sm->addEvent($event);
     
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=788&amp;postorder=desc">In The House</a>', '5', '18:00', '20:00', 'Deep, Funky, Jazzy &amp; Disco House');
   $sm->addEvent($event);
           
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1377&amp;postorder=desc">Synaesthetics</a>', '5', '20:00', '22:00', 'Robotic, Rhythmic, Futuristic, Atmospheric');
   $sm->addEvent($event);
   
         $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1565&amp;postorder=desc">Attack Decay Sustain Release</a>', '5', '22:00', '24:00', 'Electronic, Dance, Trance, House &amp; Clubbing');
   $sm->addEvent($event);
    
          
   

       //Saturdays Programming

   $event = new Event('Mourning Air', '6', '6:00', '10:00', 'Lament The Loss Of Sleep With Chilled Music');
   $sm->addEvent($event);
   
          $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1506&amp;postorder=desc">The Meltdown</a>', '6', '10:00', '12:00', 'Saturday Morning Therapy Session');
   $sm->addEvent($event);
   
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=800&amp;postorder=desc">The Edge Of Reason</a>', '6', '12:00', '13:00', 'Discussing The Paranormal');
   $sm->addEvent($event);
      
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1115&amp;postorder=desc">unradio</a>', '6', '13:00', '14:00', 'International News &amp; Current Affairs');
   $sm->addEvent($event);
   
          $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1108&amp;postorder=desc">Radio Amnesty</a>', '6', '14:00', '15:00', 'Topical Human Rights Issues');
   $sm->addEvent($event);
   
             $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1401&amp;postorder=desc">Image Of Africa</a>', '6', '15:00', '16:00', 'African News &amp; Music');
   $sm->addEvent($event);
   
            $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=805&amp;postorder=desc">Chez Geek</a>', '6', '16:00', '17:00', 'Weekly Wrap Of Geek Culture');
   $sm->addEvent($event);
   
               $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1439&amp;postorder=desc1">Live And Loud</a>', '6', '17:00', '18:00', 'Live Music, Living Bands');
   $sm->addEvent($event);
   
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1566&amp;postorder=desc">Speak No Evil</a>', '6', '18:00', '19:00', 'Jazz, Beats, Nu Jazz, Free Jazz');
   $sm->addEvent($event);
   
          $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1567&amp;postorder=desc">Red, Gold &amp; Green</a>', '6', '19:00', '20:00', 'Colour, Spice, Rhythms, Style &amp; Roots');
   $sm->addEvent($event);
           
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1505&amp;postorder=desc">The One Hour Empire</a>', '6', '20:00', '21:00', 'Space Age Bachelor Pad Music');
   $sm->addEvent($event);
    
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1510&amp;postorder=desc">Remixed</a>', '6', '21:00', '22:00', 'Discover Something New In What You&rsquo;ve Heard');
   $sm->addEvent($event);
   
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=810&amp;postorder=desc">Dialectic</a>', '6', '22:00', '24:00', 'Transglobal Beats &amp; Multilingual Mash');
   $sm->addEvent($event);
  
     

       //Sundays Programming

   $event = new Event('Mourning Air', '7', '6:00', '10:00', 'Lament The Loss Of Sleep With Chilled Music');
   $sm->addEvent($event);
   
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=878&amp;postorder=desc">Adrian&rsquo;s Attic</a>', '7', '10:00', '11:00', 'Soulful, Pop, Creative, Roots');
   $sm->addEvent($event);
   
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1568&amp;postorder=desc">Years In Music</a>', '7', '11:00', '12:00', 'Popular Songs Year By Year');
   $sm->addEvent($event);
      
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1569&amp;postorder=desc">Duets</a>', '7', '12:00', '13:00', 'It Takes Two');
   $sm->addEvent($event);
   
          $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=952&amp;postorder=desc">Get Folked</a>', '7', '13:00', '14:00', 'Original Folk From Dylan To Now');
   $sm->addEvent($event);
   
          $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1438&amp;postorder=desc1">Flashbacks</a>', '7', '14:00', '15:00', 'A Long Time Ago...');
   $sm->addEvent($event);
      
	            $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=1472&amp;postorder=desc1">Arvos</a>', '7', '15:00', '16:00', 'with Duncan');
   $sm->addEvent($event);
	  
            $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=847&amp;postorder=desc">Arts On The Edge</a>', '7', '16:00', '18:00', 'Diverse Exploration Of Hobart Art');
   $sm->addEvent($event);
   
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=880&amp;postorder=desc">Kaleidoscope Ears</a>', '7', '18:00', '20:00', 'Classic Rock Though The Ages');
   $sm->addEvent($event);
             
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?t=801&amp;postorder=desc">The Aftermath</a>', '7', '20:00', '21:00', 'Hi-Fi/Lo-Fi Music Appreciation 101');
   $sm->addEvent($event);

       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?f=11&t=1760">It&rsquo;s A Podcast, On The Radio</a>', '7', '21:00', '22:00', 'Podcast music on the radio!');
   $sm->addEvent($event);
   
       $event = new Event('<a href="http://www.edgeradio.org.au/hub/viewtopic.php?f=11&t=1463&amp;postorder=desc">How B Grade Movies Saved (or Ruined) My Life</a>', '7', '22:00', '24:00', 'B Grade Movie Heaven');
   $sm->addEvent($event);
   
   
   $sm->printHTML();

?>
</div>
<?php

///////////////////////////////////////////////////////////////////
//
// PHP ScheduleMaker 
//
// Copyright (c) 2005 by Yisong Yue <yisongyue@gmail.com>
// Permission to copy all or part of this work is granted, provided
// that the copies are not made or distributed for resale, and that
// the copyright notice and this notice are retained.
//
// THIS WORK IS PROVIDED ON AN "AS IS" BASIS.  THE AUTHOR PROVIDES 
// NO WARRANTY WHATSOEVER, EITHER EXPRESS OR IMPLIED, REGARDING THE 
// WORK, INCLUDING WARRANTIES WITH RESPECT TO ITS MERCHANTABILITY 
// OR FITNESS FOR ANY PARTICULAR PURPOSE.
//
//  

?>

<?php

   //class which creates a schedule in html
   //holds a collection of Event objects (defined below)
   class ScheduleMaker
   {
      //member variables
      
      var $width; //total width of schedule
      var $height; //total height of schedule
      var $left; //left offset of schedule
      var $top; //top offset of schedule
      var $beginTime = "6:00";
      var $endTime = "25:00";
      var $events = array();
      var $padding; //side padding of schedule 

      //constructor
      //usage: $sm = new ScheduleMaker(100,100,100,100,5);
      function ScheduleMaker($width=0, $height=0, $left=0, $top=0, $padding=1)
      {
         $this->width = $width;
         $this->height = $height;
         $this->left = $left;
         $this->top = $top;
         $this->padding = $padding;
      }

      //set the begin and end time of the entire schedule
      //input format:  "hour:min" in military time
      function setBeginEndTime($begin, $end)
      {
         $this->beginTime = $begin;
         $this->endTime = $end;
      }

      //adds a new Event to the schedule
      //look at the definiteion of Event below
      function addEvent($event)
      {
         array_push($this->events, $event);
      }

      //prints to HTML
      function printHTML()
      {
         $w = $this->width;
         $h = $this->height;
         $l = $this->left -105;
         $t = $this->top;

         //cumulative width and height of event cells
         $totalWidth = $w - $this->padding*6;
         $totalHeight = $h - $this->padding*2;

         $totalTime = TimeToNumeric($this->endTime) - TimeToNumeric($this->beginTime);

         //width of a single column of events
         $colwidth = 165; //$totalWidth * 0.2;
         
         //start and end horizontal locations of each column
        
		 $starts[0] = $l + $this->padding;
         $ends[0] = $starts[0] + $colwidth;
         $starts[1] = $ends[0] + $this->padding;
         $ends[1] = $starts[1] + $colwidth;
         $starts[2] = $ends[1] + $this->padding;
         $ends[2] = $starts[2] + $colwidth;
         $starts[3] = $ends[2] + $this->padding;
         $ends[3] = $starts[3] + $colwidth;
         $starts[4] = $ends[3] + $this->padding;
         $ends[4] = $starts[4] + $colwidth;
         $starts[5] = $ends[4] + $this->padding;
         $ends[5] = $starts[5] + $colwidth;
		 $starts[6] = $ends[5] + $this->padding;
         $ends[6] = $starts[6] + $colwidth;
		 $starts[7] = $ends[6] + $this->padding;
         $ends[7] = $starts[7] + $colwidth;


         echo '<div class="background" style="position:absolute left:' . ${l} . 'px; top:' . ${t} . 'px; height:' . ${h} . 'px width:' . ${w} . 'px">';

         echo '<div class="weeklabel" align="center" style="position:absolute; left:0px; top:' . ${t} . 'px; width:61px">Time</div>';
         echo '<div class="weeklabel" align="center" style="position:absolute; left:' . $starts[1] . 'px; top:' . ${t} . 'px; width:' . ${colwidth} . 'px">Thursday</div>';
         echo '<div class="weeklabel" align="center" style="position:absolute; left:' . $starts[2] . 'px; top:' . ${t} . 'px; width:' . ${colwidth} . 'px">Friday</div>';
		 echo '<div class="weeklabel" align="center" style="position:absolute; left:' . $starts[3] . 'px; top:' . ${t} . 'px; width:' . ${colwidth} . 'px">Saturday</div>';
		 echo '<div class="weeklabel" align="center" style="position:absolute; left:' . $starts[4] . 'px; top:' . ${t} . 'px; width:' . ${colwidth} . 'px">Sunday</div>';
        
		 
         foreach( $this->events as $event )
         {
            for($i = 0; $i <= 7; $i++)
            {
               $startTime = TimeToNumeric($event->startTime);
               $endTime = TimeToNumeric($event->endTime);
               $interval = TimeToNumeric($endTime) - TimeToNumeric($startTime);
               $top = $t+ $this->padding + (TimeToNumeric($startTime) - TimeToNumeric($this->beginTime)) * $totalHeight / $totalTime + 16;
               $height = $totalHeight * $interval / $totalTime; 
               $id = $event->id;
               $location = $event->location;
               
               $startTime = TimeToAMPM($event->startTime);
               $endTime = TimeToAMPM($event->endTime);

               $cssClass = "required";
               if($event->required == 0)
               {
                  $cssClass = "tentative";
               }

               if(preg_match("/$i/", $event->days) == 1)
               {
                  if($i == 0) {
					 
				  $html = '<div class="time" align="center" style="position:absolute; left:0px; top:' . ${top} . 'px; width:61px; height:' . ${height} . 'px; z-index:' . $z . '">';
                  $z++;
                  $html .= "$id";
                  $html .= "</div>\n";
                  echo $html;
				  
				  } else {
				
				 $html = '<div class="' . $cssClass .'" align="center" style="position:absolute; left:' . $starts[$i] . 'px; top:' . ${top} . 'px; width:' . ${colwidth} . 'px; height:' . ${height} . 'px; z-index:' . $z . '">';
                  $z++;
                  $html .= "<b>$id</b><br /><i>$location<br /></i>"; //$startTime - $endTime\n
                  $html .= "</div>\n";
                  echo $html;
					  
				  }
               }
            } 
         }
         echo "</div>\n";
      }

   }

   //a single event in a schedule
   //can occur multiple times in a week
   class Event
   {
      //member variables
      var $days; //which days of the week (e.g. "135" for MWF)
      var $startTime; //format "hour:min" in military time
      var $endTime; //format "hour:min"
      var $id;  //name of event
      var $location; //location of event
      var $required; //1 for required, 0 otherwise

      function Event( $id, $days, $start, $end, $location, $required=1 )
      {
         $this->days = $days;
         $this->startTime = $start;
         $this->endTime = $end;
         $this->id = $id;
         $this->location = $location;
         $this->required = $required;
      }
   }

   //converts time to a real number
   //example: 8:45 will convert to 8.75
   function TimeToNumeric($time)
   {
      list($hour, $minute) = split(":", $time, 2);
      $new_time = $hour + $minute/60.0;
      return $new_time;
   }

   //converts military time to AM/PM time string
   //example: "17:40" will convert to "5:40 PM"
   function TimeToAMPM($time)
   {
      list($hour, $minute) = split(":", $time, 2);
      if($hour < 12)
      {
         if($hour == 0)
         {
            $hour = 12;
         }

         $new_time = $time." AM";
         return $new_time;
      }
      else
      {
         if($hour != 12)
         {
            $hour -= 12;
         }
         
         $new_time =  "$hour:$minute PM";
         return $new_time;
      }
   }
?>

<?php

putenv("TZ=Australia/Hobart");
$h = date('G');
$d = date('w');

putenv("TZ=Australia/Hobart");


// Sunday
if ($d == 0 && $h >= 0 && $h < 6) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = 'All Night';
 	$next_title = 'Mourning Air';
 	$next_sub = '6am - 10am';
} 
elseif ($d == 0 && $h >= 6 && $h < 10) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Mourning Air';
 	$sub = '6am - 10am';
 	$next_title = 'Adrian\'s Attic';
 	$next_sub = '10am - 11am';
}
elseif ($d == 0 && $h >= 10 && $h < 11) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Adrian\'s Attic';
 	$sub = '10am - 11am';
 	$next_title = 'Years In Music';
 	$next_sub = '11am - 12pm';
}
elseif ($d == 0 && $h >= 11 && $h < 12) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Years In Music';
 	$sub = '11am - 12pm';
 	$next_title = 'Duets';
 	$next_sub = '12pm - 1pm';
}
elseif ($d == 0 && $h >= 12 && $h < 13) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Duets';
 	$sub = '12pm - 1pm';
 	$next_title = 'Get Folked';
 	$next_sub = '1pm - 2pm';
}
elseif ($d == 0 && $h >= 13 && $h < 14) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Get Folked';
 	$sub = '1pm - 2pm';
 	$next_title = 'Flashbacks';
 	$next_sub = '2pm - 3pm';
}
elseif ($d == 0 && $h >= 14 && $h < 15) { 
 	$img = 'flashbacks.jpg';
 	$title = 'Flashbacks';
 	$sub = '2pm - 3pm';
 	$next_title = 'Rebell Yell';
 	$next_sub = '3pm - 4pm';
}
elseif ($d == 0 && $h >= 15 && $h < 16) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Rebell Yell';
 	$sub = '3pm - 4pm';
 	$next_title = 'Arts On The Edge';
 	$next_sub = '4pm - 6pm';
}
elseif ($d == 0 && $h >= 16 && $h < 18) { 
 	$img = 'artsontheedge.jpg';
 	$title = 'Arts On The Edge';
 	$sub = '4pm - 6pm';
 	$next_title = 'Kaleidoscope Ears';
 	$next_sub = '6pm - 8pm';
}
elseif ($d == 0 && $h >= 18 && $h < 20) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Kaleidoscope Ears';
 	$sub = '6pm - 8pm';
 	$next_title = 'The Aftermath';
 	$next_sub = '8pm - 9pm';
}
elseif ($d == 0 && $h >= 20 && $h < 21) { 
 	$img = 'edgeradio.jpg';
 	$title = 'The Aftermath';
 	$sub = '8pm - 9pm';
 	$next_title = 'Edge Tunes';
 	$next_sub = '9pm - 10pm';
}
elseif ($d == 0 && $h >= 21 && $h < 22) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = '9pm - 10pm';
 	$next_title = 'How B Grade Movies Saved (or Ruined) My Life';
 	$next_sub = '10pm - 12am';
}
elseif ($d == 0 && $h >= 22 && $h < 24) { 
 	$img = 'bgrade.jpg';
 	$title = 'How B Grade Movies Saved (or Ruined) My Life';
 	$sub = '10pm - 12am';
 	$next_title = 'Edge Tunes';
 	$next_sub = 'All Night';
}


// Monday
if ($d == 1 && $h >= 0 && $h < 7) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = 'All Night';
 	$next_title = 'Edge Breakfast';
 	$next_sub = '7am - 10am';
} 
elseif ($d == 1 && $h >= 7 && $h < 10) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Breakfast';
 	$sub = '7am - 10am';
 	$next_title = 'Borderlines';
 	$next_sub = '10am - 12pm';
}
elseif ($d == 1 && $h >= 10 && $h < 12) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Borderlines';
 	$sub = '10am - 12pm';
 	$next_title = 'Edge Lunchbox';
 	$next_sub = '12pm - 2pm';
}
elseif ($d == 1 && $h >= 12 && $h < 14) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Lunchbox';
 	$sub = '12pm - 2pm';
 	$next_title = 'The F1 Show';
 	$next_sub = '2pm - 3pm';
}
elseif ($d == 1 && $h >= 14 && $h < 15) { 
 	$img = 'thef1show.jpg';
 	$title = 'The F1 Show';
 	$sub = '2pm - 3pm';
 	$next_title = 'Edge Tunes';
 	$next_sub = '3pm - 4pm';
}
elseif ($d == 1 && $h >= 15 && $h < 16) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = '3pm - 4pm';
 	$next_title = 'Edge Tunes';
 	$next_sub = '4pm - 5pm';
}
elseif ($d == 1 && $h >= 16 && $h < 17) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = '4pm - 5pm';
 	$next_title = 'Hobart Comedy Shake \'n\' Bake';
 	$next_sub = '5pm - 6pm';
}
elseif ($d == 1 && $h >= 17 && $h < 18) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Hobart Comedy Shake \'n\' Bake';
 	$sub = '5pm - 6pm';
 	$next_title = 'What I Say';
 	$next_sub = '6pm - 7pm';
}
elseif ($d == 1 && $h >= 18 && $h < 19) { 
 	$img = 'edgeradio.jpg';
 	$title = 'What I Say';
 	$sub = '6pm - 7pm';
 	$next_title = 'My Vinyl Weighs a Ton';
 	$next_sub = '7pm - 8pm';
}
elseif ($d == 1 && $h >= 19 && $h < 20) { 
 	$img = 'edgeradio.jpg';
 	$title = 'My Vinyl Weighs a Ton';
 	$sub = '7pm - 8pm';
 	$next_title = 'Unknown Pleasures/Under The Influence';
 	$next_sub = '8pm - 10pm';
}
elseif ($d == 1 && $h >= 20 && $h < 22) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Unknown Pleasures/Under The Influence';
 	$sub = '8pm - 10pm';
 	$next_title = 'Living In The Past';
 	$next_sub = '10pm - 12am';
}
elseif ($d == 1 && $h >= 22 && $h < 24) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Living In The Past';
 	$sub = '10pm - 12am';
 	$next_title = 'Edge Tunes';
 	$next_sub = 'All Night';
}


// Tuesday
if ($d == 2 && $h >= 0 && $h < 7) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = 'All Night';
 	$next_title = 'The Morning Bell';
 	$next_sub = '7am - 10am';
} 
elseif ($d == 2 && $h >= 7 && $h < 10) { 
 	$img = 'edgeradio.jpg';
 	$title = 'The Morning Bell';
 	$sub = '7am - 10am';
 	$next_title = 'Entree';
 	$next_sub = '10am - 12pm';
}
elseif ($d == 2 && $h >= 10 && $h < 12) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Entree';
 	$sub = '10am - 12pm';
 	$next_title = 'Edge Lunchbox';
 	$next_sub = '12pm - 2pm';
}
elseif ($d == 2 && $h >= 12 && $h < 14) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Lunchbox';
 	$sub = '12pm - 2pm';
 	$next_title = 'The Bugle';
 	$next_sub = '2pm - 3pm';
}
elseif ($d == 2 && $h >= 14 && $h < 15) { 
 	$img = 'thebugle.jpg';
 	$title = 'The Bugle';
 	$sub = '2pm - 3pm';
 	$next_title = 'Edge Tunes';
 	$next_sub = '3pm - 4pm';
}
elseif ($d == 2 && $h >= 15 && $h < 16) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = '3pm - 4pm';
 	$next_title = 'Edge Tunes';
 	$next_sub = '4pm - 5pm';
}
elseif ($d == 2 && $h >= 16 && $h < 17) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = '4pm - 5pm';
 	$next_title = 'Film Central';
 	$next_sub = '5pm - 6pm';
}
elseif ($d == 2 && $h >= 17 && $h < 18) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Film Central';
 	$sub = '5pm - 6pm';
 	$next_title = 'The Book Show';
 	$next_sub = '6pm - 7pm';
}
elseif ($d == 2 && $h >= 18 && $h < 19) { 
 	$img = 'edgeradio.jpg';
 	$title = 'The Book Show';
 	$sub = '6pm - 7pm';
 	$next_title = 'Return To Oz';
 	$next_sub = '7pm - 8pm';
}
elseif ($d == 2 && $h >= 19 && $h < 20) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Return To Oz';
 	$sub = '7pm - 8pm';
 	$next_title = 'Tasmusica';
 	$next_sub = '8pm - 10pm';
}
elseif ($d == 2 && $h >= 20 && $h < 22) { 
 	$img = 'tasmusica.jpg';
 	$title = 'Tasmusica';
 	$sub = '8pm - 10pm';
 	$next_title = 'Killawatts';
 	$next_sub = '10pm - 12am';
}
elseif ($d == 2 && $h >= 22 && $h < 24) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Killawatts';
 	$sub = '10pm - 12am';
 	$next_title = 'Edge Tunes';
 	$next_sub = 'All Night';
}


// Webnesday
if ($d == 3 && $h >= 0 && $h < 7) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = 'All Night';
 	$next_title = 'Edge Breakfast';
 	$next_sub = '7am - 10am';
} 
elseif ($d == 3 && $h >= 7 && $h < 10) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Breakfast';
 	$sub = '7am - 10am';
 	$next_title = 'Edge Tunes';
 	$next_sub = '10am - 11pm';
}
elseif ($d == 3 && $h >= 10 && $h < 11) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = '10am - 11pm';
 	$next_title = 'Talk Derby To Me';
 	$next_sub = '11am - 12pm';
}
elseif ($d == 3 && $h >= 11 && $h < 12) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Talk Derby To Me';
 	$sub = '11am - 12pm';
 	$next_title = 'Edge Lunchbox';
 	$next_sub = '12pm - 2pm';
}
elseif ($d == 3 && $h >= 12 && $h < 14) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Lunchbox';
 	$sub = '12pm - 2pm';
 	$next_title = 'To The Edge Of Within';
 	$next_sub = '2pm - 3pm';
}
elseif ($d == 3 && $h >= 14 && $h < 15) { 
 	$img = 'edgeradio.jpg';
 	$title = 'To The Edge Of Within';
 	$sub = '2pm - 3pm';
 	$next_title = 'Edge Tunes';
 	$next_sub = '3pm - 4pm';
}
elseif ($d == 3 && $h >= 15 && $h < 16) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = '3pm - 4pm';
 	$next_title = 'Edge Tunes';
 	$next_sub = '4pm - 5pm';
}
elseif ($d == 3 && $h >= 16 && $h < 17) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = '4pm - 5pm';
 	$next_title = 'Half Back Flankers';
 	$next_sub = '5pm - 6pm';
}
elseif ($d == 3 && $h >= 17 && $h < 18) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Half Back Flankers';
 	$sub = '5pm - 6pm';
 	$next_title = 'Culture Shock';
 	$next_sub = '6pm - 7pm';
}
elseif ($d == 3 && $h >= 18 && $h < 19) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Culture Shock';
 	$sub = '6pm - 7pm';
 	$next_title = 'The Punters Club';
 	$next_sub = '7pm - 8pm';
}
elseif ($d == 3 && $h >= 19 && $h < 20) { 
 	$img = 'edgeradio.jpg';
 	$title = 'The Punters Club';
 	$sub = '7pm - 8pm';
 	$next_title = 'Microphone Check';
 	$next_sub = '8pm - 10pm';
}
elseif ($d == 3 && $h >= 20 && $h < 22) { 
 	$img = 'microphonecheck.jpg';
 	$title = 'Microphone Check';
 	$sub = '8pm - 10pm';
 	$next_title = 'Sonography';
 	$next_sub = '10pm - 12am';
}
elseif ($d == 3 && $h >= 22 && $h < 24) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Sonography';
 	$sub = '10pm - 12am';
 	$next_title = 'Edge Tunes';
 	$next_sub = 'All Night';
}


// Thursday
if ($d == 4 && $h >= 0 && $h < 7) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = 'All Night';
 	$next_title = 'Dawn Transmission';
 	$next_sub = '7am - 10am';
} 
elseif ($d == 4 && $h >= 7 && $h < 10) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Dawn Transmission';
 	$sub = '7am - 10am';
 	$next_title = 'Listen Up With Georgie';
 	$next_sub = '10am - 12pm';
}
elseif ($d == 4 && $h >= 10 && $h < 12) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Listen Up With Georgie';
 	$sub = '10am - 12pm';
 	$next_title = 'Edge Lunchbox';
 	$next_sub = '12pm - 2pm';
}
elseif ($d == 4 && $h >= 12 && $h < 14) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Lunchbox';
 	$sub = '12pm - 2pm';
 	$next_title = 'Craft Is The New Black';
 	$next_sub = '2pm - 3pm';
}
elseif ($d == 4 && $h >= 14 && $h < 15) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Craft Is The New Black';
 	$sub = '2pm - 3pm';
 	$next_title = 'Edge Tunes';
 	$next_sub = '3pm - 4pm';
}
elseif ($d == 4 && $h >= 15 && $h < 16) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = '3pm - 4pm';
 	$next_title = 'Edge Tunes';
 	$next_sub = '4pm - 5pm';
}
elseif ($d == 4 && $h >= 16 && $h < 17) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = '4pm - 5pm';
 	$next_title = 'Edge Radio Recommends';
 	$next_sub = '5pm - 6pm';
}
elseif ($d == 4 && $h >= 17 && $h < 18) { 
 	$img = 'edgeradiorecommends.jpg';
 	$title = 'Edge Radio Recommends';
 	$sub = '5pm - 6pm';
 	$next_title = 'The Vivisection';
 	$next_sub = '6pm - 7pm';
}
elseif ($d == 4 && $h >= 18 && $h < 19) { 
 	$img = 'vivisection.jpg';
 	$title = 'The Vivisection';
 	$sub = '6pm - 7pm';
 	$next_title = 'North American Scum';
 	$next_sub = '7pm - 9pm';
}
elseif ($d == 4 && $h >= 19 && $h < 21) { 
 	$img = 'northamericanscum.jpg';
 	$title = 'North American Scum';
 	$sub = '7pm - 9pm';
 	$next_title = 'Edge Tunes';
 	$next_sub = '9pm - 10pm';
}
elseif ($d == 4 && $h >= 21 && $h < 22) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = '9pm - 10pm';
 	$next_title = 'Hallowed Sounds';
 	$next_sub = '10pm - 12am';
}
elseif ($d == 4 && $h >= 22 && $h < 24) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Hallowed Sounds';
 	$sub = '10pm - 12am';
 	$next_title = 'Edge Tunes';
 	$next_sub = 'All Night';
}


// Friday
if ($d == 5 && $h >= 0 && $h < 7) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = 'All Night';
 	$next_title = 'Breakfast On The Brink';
 	$next_sub = '7am - 10am';
} 
elseif ($d == 5 && $h >= 7 && $h < 10) { 
 	$img = 'thebrink.jpg';
 	$title = 'Breakfast On The Brink';
 	$sub = '7am - 10am';
 	$next_title = 'Grassroots Eco Radio';
 	$next_sub = '10am - 12pm';
}
elseif ($d == 5 && $h >= 10 && $h < 12) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Grassroots Eco Radio';
 	$sub = '10am - 12pm';
 	$next_title = 'Edge Lunchbox';
 	$next_sub = '12pm - 2pm';
}
elseif ($d == 5 && $h >= 12 && $h < 14) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Lunchbox';
 	$sub = '12pm - 2pm';
 	$next_title = 'Edge Tunes';
 	$next_sub = '2pm - 3pm';
}
elseif ($d == 5 && $h >= 14 && $h < 15) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = '2pm - 3pm';
 	$next_title = 'Edge Tunes';
 	$next_sub = '3pm - 4pm';
}
elseif ($d == 5 && $h >= 15 && $h < 16) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = '3pm - 4pm';
 	$next_title = 'Edge Tunes';
 	$next_sub = '4pm - 5pm';
}
elseif ($d == 5 && $h >= 16 && $h < 17) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = '4pm - 5pm';
 	$next_title = 'The Soul Funk Experiment';
 	$next_sub = '5pm - 6pm';
}
elseif ($d == 5 && $h >= 17 && $h < 18) { 
 	$img = 'soulfunkexperiment.jpg';
 	$title = 'The Soul Funk Experiment';
 	$sub = '5pm - 6pm';
 	$next_title = 'In The House';
 	$next_sub = '6pm - 8pm';
}
elseif ($d == 5 && $h >= 18 && $h < 20) { 
 	$img = 'edgeradio.jpg';
 	$title = 'In The House';
 	$sub = '6pm - 8pm';
 	$next_title = 'Synaesthetics';
 	$next_sub = '8pm - 10pm';
}
elseif ($d == 5 && $h >= 20 && $h < 22) { 
 	$img = 'synaesthetics.jpg';
 	$title = 'Synaesthetics';
 	$sub = '8pm - 10pm';
 	$next_title = 'Attack Decay Sustain Release';
 	$next_sub = '10pm - 12am';
}
elseif ($d == 5 && $h >= 22 && $h < 24) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Attack Decay Sustain Release';
 	$sub = '10pm - 12am';
 	$next_title = 'Edge Tunes';
 	$next_sub = 'All Night';
}


// Friday
if ($d == 6 && $h >= 0 && $h < 6) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Edge Tunes';
 	$sub = 'All Night';
 	$next_title = 'Mourning Air';
 	$next_sub = '6am - 10am';
} 
elseif ($d == 6 && $h >= 6 && $h < 10) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Mourning Air';
 	$sub = '6am - 10am';
 	$next_title = 'The Meltdown';
 	$next_sub = '10am - 12pm';
}
elseif ($d == 6 && $h >= 10 && $h < 12) { 
 	$img = 'edgeradio.jpg';
 	$title = 'The Meltdown';
 	$sub = '10am - 12pm';
 	$next_title = 'The Edge Of Reason';
 	$next_sub = '12pm - 1pm';
}
elseif ($d == 6 && $h >= 12 && $h < 13) { 
 	$img = 'edgeofreason.jpg';
 	$title = 'The Edge Of Reason';
 	$sub = '12pm - 1pm';
 	$next_title = 'unradio';
 	$next_sub = '1pm - 2pm';
}
elseif ($d == 6 && $h >= 13 && $h < 14) { 
 	$img = 'unradio.jpg';
 	$title = 'unradio';
 	$sub = '1pm - 2pm';
 	$next_title = 'Radio Amnesty';
 	$next_sub = '2pm - 3pm';
}
elseif ($d == 6 && $h >= 14 && $h < 15) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Radio Amnesty';
 	$sub = '2pm - 3pm';
 	$next_title = 'Image Of Africa';
 	$next_sub = '3pm - 4pm';
}
elseif ($d == 6 && $h >= 15 && $h < 16) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Image Of Africa';
 	$sub = '3pm - 4pm';
 	$next_title = 'Chez Geek';
 	$next_sub = '4pm - 5pm';
}
elseif ($d == 6 && $h >= 16 && $h < 17) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Chez Geek';
 	$sub = '4pm - 5pm';
 	$next_title = 'Live And Loud';
 	$next_sub = '5pm - 6pm';
}
elseif ($d == 6 && $h >= 17 && $h < 18) { 
 	$img = 'liveandloud.jpg';
 	$title = 'Live And Loud';
 	$sub = '5pm - 6pm';
 	$next_title = 'Speak No Evil';
 	$next_sub = '6pm - 7pm';
}
elseif ($d == 6 && $h >= 18 && $h < 19) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Speak No Evil';
 	$sub = '6pm - 7pm';
 	$next_title = 'Red, Gold & Green';
 	$next_sub = '7pm - 8pm';
}
elseif ($d == 6 && $h >= 19 && $h < 20) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Red, Gold & Green';
 	$sub = '7pm - 8pm';
 	$next_title = 'The One Hour Empire';
 	$next_sub = '8pm - 9pm';
}
elseif ($d == 6 && $h >= 20 && $h < 21) { 
 	$img = 'onehourempire.jpg';
 	$title = 'The One Hour Empire';
 	$sub = '8pm - 9pm';
 	$next_title = 'Remixed';
 	$next_sub = '9pm - 10pm';
}
elseif ($d == 6 && $h >= 21 && $h < 22) { 
 	$img = 'remixed.jpg';
 	$title = 'Remixed';
 	$sub = '9pm - 10pm';
 	$next_title = 'Dialectic';
 	$next_sub = '10pm - 12am';
}
elseif ($d == 6 && $h >= 22 && $h < 24) { 
 	$img = 'edgeradio.jpg';
 	$title = 'Dialectic';
 	$sub = '10pm - 12am';
 	$next_title = 'Edge Tunes';
 	$next_sub = 'All Night';
}

?>
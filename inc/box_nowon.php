<div class="rounded">
  <h1 class="greyheader">On Air Now</h1>


<?php

include'nowplay_data.php';

echo'<div style="text-align: center;"><img style="width: 163px; height: 163px;" src="http://www.edgeradio.org.au/images/edgepics/' . $img . '"></div><br>
<div style="padding-left: 5px; padding-bottom: 5px; font-size: 12px;"><b>' . $title . '</b><br><i>' . $sub . '</i></div>

<h1 class="greyheader">Coming Up</h1>
<div style="padding-left: 5px;"><b>' . $next_title . '</b><br><i>' . $next_sub . '</i></div>
';


?>



</div>

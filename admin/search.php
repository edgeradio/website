 <?php
   if(isset($_GET['query'])) { $query = $_GET['query']; } else { $query = ""; }

if(isset($_GET['type'])) { $type = $_GET['type']; } else { $query = "count"; }

if($type == "results")

{

   
   $completeurl =
"http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=$query&api_key=969c9f4dadfd85339594b7e438689e33";
$xml = simplexml_load_file($completeurl);

   
   echo '<img src="'.$xml->artist->image[3].'">';
echo '<input name="image" style="border:solid 1px #990000;" type="hidden" size="25" value="'.$xml->artist->image[3].'" />';


}
   
   ?>
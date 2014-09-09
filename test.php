
       
       <?php 
       
       
       
       include'BILBOARD.ASC';
       
       echo'<br><br>';
       
       $data = file_get_contents('http://edgeradio.org.au/BILBOARD.ASC');
       $data = str_replace("_", " ", $data);
       $data = str_replace("Playing", " - ", $data);
       $data = ucwords(strtolower($data));

$data = explode("Song",$data,2);
echo $data[0]; ?>
   
<?php include '../inc/common_start.php'; ?>
<body>
<?php include '../inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="../images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="one_column">
    <div style="background-image: url(http://www.edgeradio.org.au/images/programguidetop.png); height: 190px;" class="rounded"></div>
    <br>

    
      <div class="rounded">
        <h1 class="greyheader">Edge Radio Program Schedule</h1>
        <p>Click on the program names to enter their program pages - playlists, comments, links, music info, fun and frivolity await you!</p>
        <?php
    include'schedule_data.php';
        ?>
        
        
    <h1 class="greyheader">GOT A HANKERING FOR YOUR FAVOURITE SHOW THAT'S NOT ON AIR ANYMORE?</h1>
        <p class="text">Put the tissues away because you can read about them <a href="http://www.edgeradio.org.au/hub/">HERE</a>.</p>
        <p class="text">Edge Radio implements a new schedule a few times a year so there's always a chance for you to find something you're interested in, or maybe even apply for your own show!</p>
        <p class="text">Edge Radio is always looking for fresh talent!</p>
        <p class="text">If you are interested in applying for a program, download an application form below:</p>

        <p class="text">Application: <a href="downloads/ProgramApplication.doc">Word version</a></p>
        <p class="text">Application: <a href="downloads/ProgramApplication.pdf">PDF version</a></p>
        <p class="text">Listen to Edge Radio 99.3 FM in Hobart and work out what YOU think Edge Radio needs!</p>
      </div>
      <div id="footer">
        <?php include '../inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../inc/common_end.php'; ?>

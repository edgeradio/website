<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="one_column">
    
    
    
      <div class="rounded">
        <h1 class="title-head-right-one">Edge Radio Program Schedule</h1>
        <p>Click on the program names to enter their program pages - playlists, comments, links, music info, fun and frivolity await you!</p>
        <?php
    include'schedule_data.php';
        ?>
        
        
  
      </div>
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

<?php include 'inc/common_start.php'; ?>
<body>
<?php include 'inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="left_column">
<?php include 'inc/box_leftbanner.php'; ?>
        <br />
      <?php include 'inc/box_supporter.php'; ?>
      <br />
      <?php include 'inc/box_signup.php'; ?>
    </div>
    <div id="right_column">
        <?php include 'inc/box_rightbanner.php'; ?>
        <br />
<?php include 'inc/box_nowon.php'; ?>
<br />
<?php include 'inc/box_hub.php'; ?>
          </div>
    <div id="three_column">
      <div class="rounded">
        <?php include 'inc/display_wo.php'; ?>
        </div>
        <br />
        <div class="rounded">
        <?php include 'inc/display_err.php'; ?>
        </div>
        <br />
        <div class="rounded">
        <?php include 'inc/display_erp.php'; ?>
        </div>
        <br />
        <div class="rounded">
        <?php include 'inc/display_news.php'; ?>
        </div>
      <div id="footer">
        <?php include 'inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/common_end.php'; ?>

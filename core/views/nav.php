<?php
    if(!defined('WPINSTALL')) {die('Direct access not permitted'); }
?>
<div class="navbar-fixed-top site-manager">
  <div class="container">
    <div class="row">
      <div class="col-sm-8 home-link">
        <nav><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></nav>
      </div>
      <div class="col-sm-4">
          <nav>
            <a id="manager" href="#manager"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Site Manager </a> 
            <a href="manage.php"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> WP Manager </a>
          </nav>
      </div>
    </div>
  </div>
</div>
<div class="progress navbar-fixed-top" style="border-radius: 0">
    <div id="progress" class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
        20%
    </div>
</div>

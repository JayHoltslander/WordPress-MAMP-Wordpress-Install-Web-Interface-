<?php
    if(!defined('WPINSTALL')) {die('Direct access not permitted'); }
?>
<div class="navbar-default site-manager <?php echo $class; ?> animated slideInDown">
  <div class="container">
    <div class="row">
      <div class="col-xs-4 home-link">
        <nav><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></nav>
      </div>
      <div class="col-xs-8">
          <nav>
          
            <?php 
              //version control
                $fileAPP_version = 'https://raw.githubusercontent.com/michelve/WordPress-MAMP-Wordpress-Install-Web-Interface-/master/core/temp/sites/.config';
                $get_version = file_get_contents($fileAPP_version);
                //print $get_version;

                if ($current_version >= $get_version) {
                //print("No Update");
                }
                else {
                print('<a target="_blank" href="https://github.com/michelve/WordPress-MAMP-Wordpress-Install-Web-Interface-"> <span class="badge update-bg"> Update Available! </span></a>');
                $u_notice = '<div class="alert alert-info alert-dismissible animated slideInDown center" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Warning!</strong> There is a new version update for this app. Update as soon as possible.
                </div>';
                }
            ?>
            <a id="manager" href="#manager"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Site Manager </a> 
            <a href="manage.php"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> WP Manager </a>
            <!-- <a href="migrate.php" class="migrate"><i class="fa fa-server"></i></span> WP Migration </a> -->
          </nav>
      </div>
    </div>
  </div>
</div>
<?php //echo $u_notice;?>
<!-- <div class="progress navbar-fixed-top" style="border-radius: 0">
    <div id="progress" class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
        20%
    </div>
</div> -->

<?php if(!defined('WPINSTALL')) {die('Direct access not permitted'); }?>

<div class="modal fade" id="checkreqs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Requirements Analyzer</h4>
      </div>
      <div class="modal-body">
          <?php  
            $app_location = '/Applications/MAMP';  
            
            if (file_exists($app_location)) {  
                echo '<p class="bg-success"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> MAMP is installed </p>';  
            } else {  
                // mkdir("folder/{$app_location}", 0777);  
                echo '<p class="bg-danger"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> MAMP is not Installed</p>';  
            }  
          ?> 

          <?php 
            exec("ps aux | grep -i 'MAMP' | grep -v grep", $pids);
            if(empty($pids)) {
                    print "<p class='bg-danger'> <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> MAMP is not running!</p>\n";
            }
            else {
                    print "<p class='bg-success'> <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> MAMP is running</p>\n";
            }
          ?>
          <?php 
            $mac_host_file = '/private/etc/hosts';

            if (is_writable($mac_host_file)) {
                echo '<p class="bg-success"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Host File is writable  <br> <b>Location:</b> '.$mac_host_file.'</p>';
            }
            else {
                echo '<p class="bg-danger"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Host File is not writable. Please correct this, see the documentation. <br> <b>Location:</b> '.$mac_host_file.' </p>';
            }
          ?>

          <?php 
              $amp_host_file = '/Applications/MAMP/conf/apache/extra/httpd-vhosts.conf';

              if (is_writable($amp_host_file)) {
                  echo '<p class="bg-success"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> httpd-vhosts.conf is writable  <br> <b>Location:</b> '.$amp_host_file.'</p>';
              }
              else {
                  echo '<p class="bg-danger"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> httpd-vhosts.conf is not writable. Please correct this, see the documentation. <br> <b>Location:</b> '.$amp_host_file.'</p>';
              }
          ?>
          <?php 
              //version control
                $fileAPP_version = 'https://raw.githubusercontent.com/michelve/WordPress-MAMP-Wordpress-Install-Web-Interface-/master/core/temp/sites/.config';
                $get_version = file_get_contents($fileAPP_version);

                if ($current_version >= $get_version) {
                echo '<p class="bg-info"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> No Updates Available</p>';
                }
                else {
                echo '<p class="bg-warning"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Please update the app.</p>';
                }
            ?>

      </div>
      <div class="modal-footer">
        <a class="btn btn-success" href="/documentation.html">See Documentation</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




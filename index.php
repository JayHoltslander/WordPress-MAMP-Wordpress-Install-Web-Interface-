<?php 
// @Author: Michel Velis
// @Repository: https://github.com/michelve/WordPress-MAMP-Wordpress-Install-Web-Interface-
// @Version: 1.0.3
// @Author URL: https://velismichel.com

define('WPINSTALL', TRUE); 
// ob_start(); 
// session_start(); 

// Include MAMP Files
if(file_exists('/Applications/MAMP/bin/mamp/php/functions.php')) {
  include_once '/Applications/MAMP/bin/mamp/php/functions.php';
}
if(file_exists('/Applications/MAMP/bin/phpMyAdmin/config.inc.php')) {
  include_once('/Applications/MAMP/bin/phpMyAdmin/config.inc.php');
}
  
$nullpath = '';
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$localhostpath = pathinfo(realpath($nullpath), PATHINFO_DIRNAME);
//echo $localhostpath;


if (isset($_POST['config'])) {

    $protectsession = "<?php if(!defined('WPINSTALL')) {die('Direct access not permitted'); }?>"."\n";
    $php_starts      = '<?php ';
      $localhostdir  = '  $localhostdir = "' . $_REQUEST['localhostdir'];
      $sitename      = '  $sitename     = "' . $_REQUEST['sitename'];
      $dbname        = '  $dbname       = "' . $_REQUEST['dbname'];
      $dbuser        = '  $dbuser       = "' . $_REQUEST['dbuser'];
      $host          = '  $host         = "' . $_REQUEST['host'];
      $dbpass        = '  $dbpass       = "' . $_REQUEST['dbpass'];
      $dbprefix      = '  $dbprefix     = "' . $_REQUEST['dbprefix'];
    $php_ends        = '?>';

    $config_file = fopen("core/setup.php","w");

    fwrite($config_file,$protectsession."\n");
    fwrite($config_file,$php_starts."\n");
      fwrite($config_file,$localhostdir."\";\n");
      fwrite($config_file,$sitename."\";\n");
      fwrite($config_file,$dbname."\";\n");
      fwrite($config_file,$dbuser."\";\n");
      fwrite($config_file,$dbprefix."\";\n");
      fwrite($config_file,$host."\";\n");
      fwrite($config_file,$dbpass."\";\n");
    fwrite($config_file,$php_ends."\n");

    fclose($config_file);
    print_r(error_get_last());
    mkdir($_REQUEST['sitename'].'.com', 0755);

    if (empty($_POST['localhostdir']) || empty($_POST['sitename']) || empty($_POST['dbname']) || empty($_POST['dbuser']) || empty($_POST['host']) || empty($_POST['dbpass']))  {
        print ("please enter the required values");
    }
  }
?>

<html>
  <head>
    <title>WordPress MAMP Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="core/css/app.css">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  </head>

</html>

<body>
<div class="progress" style="border-radius: 0">
      <div id="progress" class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
        20%
      </div>
    </div>
  <div class="container">
    <div class="row">
    </div>
    <div class="clear"></div>
    <div class="row step1">
      <div class="clear"></div>

      <div class="error" style="display:none"></div>

      <form class="form-horizontal col-sm-12" action="/?step=verify" method="POST" name="config">
        <fieldset>
         <div class="col-sm-6 dbinfo">
               <div class="col-sm-12">
                <div class="col-sm-6">
                  <img src="core/images/mamp-logo.png" style="max-width: 245px;">
                </div>
                <div class="col-sm-6 check-req">                  
                  <a href="#req" data-toggle="modal" data-target="#checkreqs"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Check App   </a>
                </div>
                <div class="clear"></div>
                <p class="info">Welcome to the famous two-minutes WordPress installation process! Just fill in the information below and you’ll be on your way to using the most extendable and powerful personal publishing platform in the world.</p>
               </div>
               <!-- <div class="col-sm-9">
                <h4>Site Info</h4>
               </div> -->
               <div class="clear"></div>
              <hr>
              <div class="clear"></div>
              <div class="control-group">
                <!-- Username -->
                <label class="col-sm-4 control-label" for="localhostdir">Localhost Dir Path</label>
                <div class="controls col-sm-8">
                  <input type="text" id="localhostdir" name="localhostdir" placeholder="the absolute path to your localhost" value="<?php echo $localhostpath.'/';?>" class="form-control" required>
                  <p class="text-muted">by default we will try to get the path from your localhost if you path is diff corrected it now</p>
                </div>
              </div>
              <div class="clear"></div>

              <div class="control-group">
                <!-- Username -->
                <label class="control-label col-sm-4" for="sitename">Site Name</label>
                <div class="controls col-sm-8">
                  <input type="text" id="sitename" name="sitename" placeholder="mysitename" class="form-control" required>
                  <p class="text-muted">do not add .com or .dev It will be added automatically</p>
                </div>
              </div>
              <div class="clear"></div>
         </div>

         <div class="col-sm-1 or-dvivider"></div>

          <div class="col-sm-5 dbinfo">
            <div class="col-sm-3">
                <img src="core/images/wordpress-logo.svg">  
            </div>
            <div class="col-sm-9 dbtitle">
                <h4>Database Info</h4>
            </div>
            <div class="clear"></div>
            <hr>
            <div class="clear"></div>

            <div class="control-group">
                <!-- Username -->
                <label class="control-label col-sm-4" for="host">Database Host</label>
                <div class="controls col-sm-8">
                  <!-- <select id="host" name="host">
                    <option value="127.0.0.1:3306">127.0.0.1:3306</option>
                    <option value="127.0.0.1:8889">127.0.0.1:8889</option>
                    <option value="127.0.0.1">127.0.0.1</option>
                    <option value="localhost">localhost</option>
                  </select> -->
                  <input type="text" id="host" name="host" value="127.0.0.1:<?php echo $cfg['Servers'][1]['port'] ? $cfg['Servers'][1]['port'] : "3306"; ?>" class="form-control" data-toggle="tooltip" title="If these values do not match. Open MAMP > Preferences > Ports and see which port mysql is using" required>
                  <p class="text-muted">We will try to get the default values from MAMP. <strong>Usually is:</strong> 3306 or 8889</p>
                </div>
              </div>
              <div class="clear"></div>

            <div class="control-group">
                <!-- Username -->
                <label class="control-label col-sm-4" for="dbname">Database Name</label>
                <div class="controls col-sm-8">
                  <input type="text" id="dbname" name="dbname" placeholder="ex: db_mysite" class="form-control" required>
                  <p class="text-muted">name your database</p>
                </div>
              </div>
              <div class="clear"></div>

              <div class="control-group">
                <!-- Username -->
                <label class="control-label col-sm-4" for="dbuser">Database User</label>
                <div class="controls col-sm-8">
                  <input type="text" id="dbuser" name="dbuser" value="<?php echo $cfg['Servers'][1]['user']; ?>" class="form-control" data-toggle="tooltip" title="By default MAMP uses root unless you have change the user" required>
                  <p class="text-muted"><?php echo $cfg['Servers'][1]['user']; ?> is the default user.</p>
                </div>
              </div>
              <div class="clear"></div>

              <div class="control-group">
                <!-- Username -->
                <label class="control-label col-sm-4" for="dbpass">Database Password</label>
                <div class="controls col-sm-8">
                  <input type="text" id="dbpass" value="<?php echo $cfg['Servers'][1]['password']; ?>" name="dbpass" class="form-control" data-toggle="tooltip" title="By default MAMP uses root unless you have change the password" required>
                  <p class="text-muted"><?php echo $cfg['Servers'][1]['password']; ?> is the default password.</p>
                </div>
              </div>
              <div class="clear"></div>

              <div class="control-group">
                <!-- Username -->
                <label class="control-label col-sm-4" for="dbprefix">Database Prefix</label>
                <div class="controls col-sm-8">
                  <input type="text" id="dbprefix" name="dbprefix" value="Wpr_" class="form-control" required>
                </div>
              </div>
          </div>
          <div class="clear"></div>          
          
       <div class="col-sm-4"></div>
          <div class="control-group col-sm-4 top">
            <!-- Button -->
            <div class="controls">
              <button type="submit" name="config" class="btn btn-success btn-lg btn-block">Continue</button>
              <br> <center><a href="documentation.html">Help and Documentation Guide</a></center>
            </div>
          </div>
          <div class="col-sm-4"></div>
        </fieldset>
      </form>


    <div class="col-sm-12"></div>
        <?php include 'core/setup.php'; ?>
    </div>

    <?php 
      if (strpos($url,'?step=verify') !== false) {
        include 'core/verify.php';
      } 
      elseif (strpos($url,'?step=install') !== false){
        include 'core/install.php';
          
      }
    ?>

  </div> <!-- end of container -->
  <script type="text/javascript">
      $('#sitename').bind('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
           event.preventDefault();
           return false;
        }
    });
      //progress
      $(document).ready(function(){
        $( "#sitename" ).click(function() {
          $("#progress").attr('aria-valuenow', '45');
          $("#progress").css( "width", "45%" );
          $("#progress" ).html( "45%" );
      });
      $( "#dbname" ).click(function() {
          $("#progress").attr('aria-valuenow', '66');
          $("#progress").css( "width", "66%" );
          $("#progress" ).html( "66%" );
      });
      $( "#dbuser" ).click(function() {
          $("#progress").attr('aria-valuenow', '67');
          $("#progress").css( "width", "67%" );
          $("#progress" ).html( "67%" );
      });
      $( "#dbpass" ).click(function() {
          $("#progress").attr('aria-valuenow', '68');
          $("#progress").css( "width", "68%" );
          $("#progress" ).html( "68%" );
      });
      $( "#host" ).click(function() {
          $("#progress").attr('aria-valuenow', '69');
          $("#progress").css( "width", "69%" );
          $("#progress" ).html( "69%" );
      });
      $( "#dbprefix" ).click(function() {
          $("#progress").attr('aria-valuenow', '70');
          $("#progress").css( "width", "70%" );
          $("#progress" ).html( "70%" );
      });
      $( ".btn-primary" ).hover(function() {
          $("#progress").attr('aria-valuenow', '72');
          $("#progress").css( "width", "72%" );
          $("#progress" ).html( "72%" );
      });
    });
  </script>

  <?php 
    if (strpos($url,'?step=verify') !== false) {
      echo '<script> 
      $("#progress").attr("aria-valuenow", "85");
          $("#progress").css( "width", "85%" );
          $("#progress" ).html( "85%" );
      </script>';
    }
    elseif (strpos($url,'?step=install') !== false) {
      echo '<script> 
      $("#progress").attr("aria-valuenow", "96");
          $("#progress").css( "width", "96%" );
          $("#progress" ).html( "96%" );
      </script>';
    }

  ?>
  <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
  </script>

  <!-- Modal -->
  <div class="modal fade" id="checkreqs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Requirements Analyzer</h4>
        </div>
        <div class="modal-body">
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
                $app_location = '/Applications/MAMP';  
                
                if (file_exists($app_location)) {  
                    echo '<p class="bg-success"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> MAMP is installed </p>';  
                } else {  
                    // mkdir("folder/{$app_location}", 0777);  
                    echo '<p class="bg-danger"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> MAMP is not Installed</p>';  
                }  
            ?> 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer navbar-fixed-bottom">
    <div class="container">

      
      <div class="col-sm-6 author">
        <p><a href="https://github.com/michelve/wordpress-mamp-localhost-generator" target="_blank">GitHub Project</a>
          <br> Author: <a href="http://velismichel.com/" target="_blank">Michel Velis</a></p>
      </div>

        <div class="col-sm-6 donate">
          <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="WN72DLG847QRC">
            <input type="image" src="core/images/donate.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
          </form>
        </div>

    </div>
  </footer>

</body>
</html>
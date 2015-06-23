<?php 
// @Author: Michel Velis
// @Repository: https://github.com/michelve/WordPress-MAMP-Wordpress-Install-Web-Interface-
// @Version: 1.0.4
// @Author URL: https://velismichel.com

define('WPINSTALL', TRUE); 
define('DOCUMENT_ROOT', dirname(__file__).'/');
// ob_start(); 
// session_start(); 

// Report runtime errors
error_reporting(E_ERROR | E_PARSE);

// Include MAMP Files
if(file_exists('/Applications/MAMP/bin/mamp/php/functions.php')) {
  include_once '/Applications/MAMP/bin/mamp/php/functions.php';
}
if(file_exists('/Applications/MAMP/bin/phpMyAdmin/config.inc.php')) {
  include_once('/Applications/MAMP/bin/phpMyAdmin/config.inc.php');
}
  
$nullpath = '';
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
//$localhostpath = pathinfo(realpath($nullpath), PATHINFO_DIRNAME);
$result = exec('grep -r ^DocumentRoot /Applications/MAMP/conf/apache/httpd.conf');
$result = substr($result, stripos($result, 'DocumentRoot'));
$localhostpath = trim(str_replace(array('DocumentRoot', '"'), '', $result));
//echo $localhostpath;


$site_path_var = $_SERVER["DOCUMENT_ROOT"];
$file_location = $_SERVER['SCRIPT_FILENAME'];
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
    //print_r(error_get_last());
    mkdir($_REQUEST['sitename'].'.com', 0755);

    if (is_dir($_REQUEST['sitename'].'.com')) {
            rmdir($_REQUEST['sitename'].'.com');
    }


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
<?php include 'core/views/nav.php'; ?>

  <div id="sitemanager" class="showsites" style="display:none">
    <div class="body">
      <?php
        //var_dump($_SERVER);
        //echo exec('pwd');
        $row = exec('cd '.$localhostpath.'; ls ',$output,$error);

        if($error){
          echo "Error : $error<br/>\n";
        exit;
        }
        $output = preg_replace('/\b.com\b/', '.dev/', $output);
        while(list(,$row) = each($output)){
          echo '<div class="clear"></div>
                  <div class="col-sm-12">
                    <div class="col-sm-6">
                      <span class="glyphicon glyphicon-home" aria-hidden="true"></span>  
                      <a href="http://'.$row.'" target="_blank"> '.$row.'</a> 
                    </div>
                    <div class="col-sm-2 btn btn-info white">
                        <a target="_blank" href="http://'.$row.'">View Site</a>
                    </div>
                    <div class="col-sm-2 btn btn-primary white">
                        <a target="_blank" href="http://'.$row.'wp-admin/">wp-admin</a>
                    </div>
                    <div class="col-sm-2 btn btn-default dark">
                        <a target="_blank" href="http://localhost/phpMyAdmin/">phpMyAdmin</a>
                    </div>
                </div>
                <div class="clear"></div>';
        }
      ?>
    </div>
  </div>

  <div class="container main-wrapper">
    <div class="row">
    </div>
    <div class="clear"></div>


    <?php 
      include 'core/setup.php';
      if (strpos($url,'?step=verify') !== false) {
        include 'core/verify.php';
      } 
      elseif (strpos($url,'?step=install') !== false){
        include 'core/install.php';          
      }
      else {
        include 'core/init.php';
      }
    ?>

  </div> <!-- end of container -->

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
  
  <?php include 'core/box.php' ?>
  <script type="text/javascript" src="core/js/app.js"></script>

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
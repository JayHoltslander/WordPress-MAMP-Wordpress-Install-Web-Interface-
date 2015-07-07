<?php 
// @Author: Michel Velis
// @Repository: https://github.com/michelve/WordPress-MAMP-Wordpress-Install-Web-Interface-
// @Version: 1.0.6
// @Author URL: https://velismichel.com


define('WPINSTALL', TRUE); 
define('DOCUMENT_ROOT', dirname(__file__).'/');
// ob_start(); 
// session_start(); 

// Report runtime errors
error_reporting(0);

// Include MAMP Files
if(file_exists('/Applications/MAMP/bin/mamp/php/functions.php')) {
  include_once '/Applications/MAMP/bin/mamp/php/functions.php';
}
if(file_exists('/Applications/MAMP/bin/phpMyAdmin/config.inc.php')) {
  include_once('/Applications/MAMP/bin/phpMyAdmin/config.inc.php');
}

$current_version = '1.0.6';
$nullpath = '';
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$localhostpath = pathinfo(realpath($nullpath), PATHINFO_DIRNAME);


$site_path_var = $_SERVER["DOCUMENT_ROOT"];
$file_location = $_SERVER['SCRIPT_FILENAME'];
//echo $localhostpath;

if(isset($_POST['localhostdir']) && isset($_POST['sitemanager'])) {
    $wp_site = '<?php '. "\n".'$localhostdir = '.'\''.$_POST['localhostdir'].'\';' . "\n". '$site_selected  = '.'\''.$_POST['sitemanager'].'\';' . "\n".'?>';
    $wp_d = file_put_contents('core/temp/wp.php', $wp_site, LOCK_EX);
    if($wp_d === false) {
        die('There was an error writing this file');
    }
}

elseif(isset($_POST['wpcontentdir']) && isset($_POST['uplaoddir']) && isset($_POST['plugins'])) {
    $wp_rename = '<?php '. "\n"
    			.'$wpcontentdir = '.'\''.$_POST['wpcontentdir'].'\';' . "\n"
    			.'$uplaoddir  = '.'\''.$_POST['uplaoddir'].'\';'  . "\n"
    			.'$plugins  = '.'\''.$_POST['plugins'].'\';' 
    			. "\n".'?>';
    $wp_ren = file_put_contents('core/temp/config.php', $wp_rename, LOCK_EX);
    if($wp_ren === false) {
        die('There was an error writing this file');
    }
}



$wp_file_path = 'core/temp/wp.php';
$config_file_path = 'core/temp/config.php';


?>
<html>
  <head>
    <title>WP MAMP Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="core/css/animate.css">
    <link rel="stylesheet" type="text/css" href="core/css/form.css">
    <link rel="stylesheet" type="text/css" href="core/css/app.css">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="core/js/jquery.cookie.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <style type="text/css">
    .progress {display: none}
    </style>
  </head>

</html>

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


	<div class="container main-wrapper wpmanager">
		<div class="row">
			
		        
		         	<div class="col-sm-6 dbinfo">
		         		<fieldset>
			         		<form class="form-horizontal col-sm-12 wp" action="manage.php?action=setupconfig" method="POST" name="managewpd">
					            <div class="col-sm-12 wp-manage">
						                <h2>WP Manager</h2>
						    			 <!--   <div class="col-sm-6 check-req">                  
						                  <a href="#req" data-toggle="modal" data-target="#checkreqs"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Check App   </a>
						                </div> -->
						                <div class="clear"></div>
						                <p class="info">Lets make your Wordpress Install Secure and more customized</p>
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
						                <label class="control-label col-sm-4" for="sitename">Site To Configure</label>
						                <div class="controls col-sm-8">
						                  <select id="sitemanager" name="sitemanager">
						                    	<?php
										        //var_dump($_SERVER);
										        //echo exec('pwd');
										        $manage_site = exec('cd '.$localhostpath.'; ls ',$output_site_opt,$error_manage);

										        if($error_manage){
										          echo "Error : $error<br/>\n";
										        exit;
										        }
										        $output_site_opt = preg_replace('/\b.com\b/', '.com', $output_site_opt);
										        while(list(,$manage_site) = each($output_site_opt)){
										          echo '<option value="'.$manage_site.'">'.$manage_site.'</option>';
										        }
										      ?>
						                  </select>
						                </div>
					            </div>
					            <div class="clear"></div>

					            <div class="col-sm-6"></div>
					            <div class="col-sm-6 control-group">
							            <!-- Button -->
							            <div class="controls">
							              <button type="submit" name="managewp" class="btn btn-success btn-lg btn-block">Reload Site Config</button>
							            </div>
						        </div>
					        </form>
				        </fieldset>
			        </div>

			        <!-- check validation -->
			        <div class="col-sm-6 get-config">
			        	 <?php 
						     if (strpos($url,'?action=setupconfig') !== false) {
						     	include $wp_file_path;
						     	$sitemanager = $localhostdir.''.$site_selected;
						     	echo "<h5>Rename WP Folders</h5>";
								$setup_file = 'setup.php';
								if(file_exists($sitemanager.'/'.$setup_file)) {
								  echo '<p class="bg-info"><strong>Site Path:</strong> '.$sitemanager.'<br> </p>';
								  $path_toConfig = $sitemanager.'/'.$setup_file;
								  include $path_toConfig;
								  echo "<p class='bg-success'> <span class='glyphicon glyphicon-exclamation-sign'></span> Setup file found and Loaded </p>";

								}
								else {
									echo "<p class='bg-danger'> <span class='glyphicon glyphicon-exclamation-sign'></span> setup.php file was not found on that site. </p>";
								}
							echo '
								<form id="wpcontent" action="manage.php?action=verify" method="POST" class="form-horizontal" name="config_wp_content">

								  <div class="clear"></div>
								  <div class="form-group col-sm-6">
								    <label for="wpcontentdir">WP Content Dir</label>
								    <input type="text" name="wpcontentdir" class="form-control" id="wpcontentdir" placeholder="rename wp-content">
								    <p>enter the new for wp-content</p>
								  </div>

								  <div class="form-group col-sm-6">
								    <label for="uplaoddir">WP Upload Dir</label>
								    <input name="uplaoddir" type="text" class="form-control" id="uplaoddir" placeholder="rename wp-uploads">
								    <p>enter the new for wp-uploads</p>
								  </div>
								  <div class="clear"></div>
								  <hr>
								  <div class="form-group col-sm-12">
								    <label for="plugins">Rename Plugins Dir</label>
								    <input type="text" name="plugins" class="form-control" id="plugins" placeholder="rename plugins dir">
								    <p>enter the new for plugins</p>
								  </div>
								  <hr>
								  <div class="clear"></div>
								  <button name="config_wp_content" type="submit" class="btn btn-danger">Rebuild Structure</button>
								</form>
							';
							} 

							//verify info
							elseif (strpos($url,'?action=verify') !== false){
								$setup_file = 'setup.php';
								include $wp_file_path;
								$sitemanager = $localhostdir.''.$site_selected;
								include $config_file_path;


								if(file_exists($sitemanager.'/'.$setup_file)) {
								  echo '<p class="bg-info"><strong>Site Path:</strong> '.$sitemanager.'<br> </p>';
								  $path_toConfig = $sitemanager.'/'.$setup_file;
								  include $path_toConfig;
								  echo "<p class='bg-success'> <span class='glyphicon glyphicon-exclamation-sign'></span> Setup file found and Loaded </p>";

								  echo "<p class='verify-title'>Verify the below information</p>";
								  echo "<div class='confirm bg-info'>";
								  	echo '<b>Path</b>: '.$localhostdir,$site_selected.' <br>';
									echo 'wp-content -> '.$wpcontentdir.' <br>';
									echo 'wp-uploads -> '.$uplaoddir.' <br>';
									echo 'plugins -> '.$plugins.' <br>';
								  echo "</div>";

								  echo '
								         <form class="rename-step2" method="POST" action="manage.php?action=rename">
								         <a class="btn btn-default" href="javascript:history.go(-1)">Make Changes</a>

								         <button name="renamewp" type="submit" class="btn btn-danger">
											OK, Looks Good</button>
										</form>

								         </form>

								  ';
									


								}
								else {
									 echo "<p class='brand-danger'> <span class='glyphicon glyphicon-exclamation-sign'></span> Setup file not found processed at your own risk</p>";
								}
							}

							//rename wp
							elseif (strpos($url,'?action=rename') !== false){
								$setup_file = 'setup.php';
								include $wp_file_path;
								$sitemanager = $localhostdir.''.$site_selected;
								include $config_file_path;

								echo "<p class='bg-info'> <span class='glyphicon glyphicon-exclamation-sign'></span> Renaming wp folders for <strong>$sitemanager</strong></p>";

								//rename uploads dir
								if (file_exists($sitemanager.'/'.$wpcontentdir.'/'.$uplaoddir)) {
									//rename uploads folder
									echo "<p class='bg-danger'> <span class='glyphicon glyphicon-exclamation-sign'></span> $uplaoddir folder already exist </p>";
								}
								else{
									rename($sitemanager.'/wp-content/uploads', $sitemanager.'/wp-content/'.$uplaoddir);
									echo "<p class='bg-success'> <span class='glyphicon glyphicon-exclamation-sign'></span> uploads folder rename successfully </p>";									
								}


					
								if (file_exists($sitemanager.'/'.$wpcontentdir.'/'.$plugins)) {
									//rename plugins dir
									echo "<p class='bg-danger'> <span class='glyphicon glyphicon-exclamation-sign'></span> $plugins folder already exist </p>";
								}
								else{
									rename($sitemanager.'/wp-content/plugins', $sitemanager.'/wp-content/'.$plugins);
									echo "<p class='bg-success'> <span class='glyphicon glyphicon-exclamation-sign'></span> plugins folder rename successfully </p>";
								}



								if (file_exists($sitemanager.'/'.$wpcontentdir)) {
									//rename wp-content dir
									echo "<p class='bg-danger'> <span class='glyphicon glyphicon-exclamation-sign'></span> $wpcontentdir folder already exist </p>";
								}
								else{
									rename($sitemanager.'/wp-content', $sitemanager.'/'.$wpcontentdir);
									echo "<p class='bg-success'> <span class='glyphicon glyphicon-exclamation-sign'></span> wp-content folder rename successfully </p>";									
								}

								//update wp-config file

								// echo "<br> <p class='bg-info'> <span class='glyphicon glyphicon-exclamation-sign'></span> Copy the below code into your wp-config.php file</p>";

								echo '<div class="panel panel-default">
								  <div class="panel-heading">Copy & Paste into wp-config.php</div>
								  <div class="panel-body">';
								    echo ' <div class="config-output"> ';
							                  echo '$domain = $_SERVER["SERVER_NAME"];'.'<br>';
							                  echo '  define( "WP_SITEURL", "http://".$domain );'.'<br>';
							                  echo '  define( "WP_HOME", WP_SITEURL );'.'<br>'.'<br>';

							                  echo '  define( "WP_CONTENT_FOLDERNAME","'.$wpcontentdir.'");'.'<br>';
							                  echo '  define( "WP_CONTENT_DIR", ABSPATH . WP_CONTENT_FOLDERNAME);'.'<br>';
							                  echo '  define( "WP_CONTENT_URL", WP_SITEURL . "/" . WP_CONTENT_FOLDERNAME);'.'<br>';
							                  echo '  define( "WP_PLUGIN_DIR", WP_CONTENT_DIR . "/'.$plugins.'");'.'<br>';
							                  echo '  define( "WP_PLUGIN_URL", WP_CONTENT_URL . "/'.$plugins.'"");'.'<br>';
							                  echo '  define( "UPLOADS", WP_CONTENT_FOLDERNAME . "/'.$uplaoddir.'");'.'<br>';
							                echo '</div> ';
								 echo ' </div>
								</div>';


								echo '
								<div class="panel panel-default">
								  <div class="panel-heading">
								    <h3 class="panel-title">Let the app create it for you</h3>
								  </div>
								  <div class="panel-body">
								    <p class="bg-info">we will create a backup of wp-config.php called wp-config.php.old (make sure youd otn upload this file to your prodction server.</p>
								    <form class="rename-step2" method="POST" action="manage.php?action=wpconfig">
								         <a class="btn btn-default" href="manage.php">Is Fine, I got it ..</a>

								         <button name="wpconfig" type="submit" class="btn btn-danger">
											OK, Do it for me</button>
										</form>

								         </form>
								  </div>
								</div>	';						

							}

							// wp-config
							elseif (strpos($url,'?action=wpconfig') !== false){
								$setup_file = 'setup.php';
								include $wp_file_path;
								$sitemanager = $localhostdir.''.$site_selected;
								include $config_file_path;

								echo "<p class='bg-info'> <span class='glyphicon glyphicon-exclamation-sign'></span> Creating wp-config.php for $sitemanager</p>";

								if (file_exists($sitemanager.'/wp-config.php.old')){
									echo "<p class='bg-info'> <span class='glyphicon glyphicon-exclamation-sign'></span> wp-config.php.old - back-up already exist</p>";
								}
								else {
									copy($sitemanager.'/wp-config.php',$sitemanager.'/wp-config.php.old');
									echo "<p class='bg-info'> <span class='glyphicon glyphicon-exclamation-sign'></span> wp-config.php.old - back-up created</p>";
								}

								if (file_exists('core/temp/sites/'.$site_selected)) {
								    echo "<p class='bg-danger'> <span class='glyphicon glyphicon-exclamation-sign'></span> You have already rename this site. Please select another site</p>";

								} else {
								    //file_put_contents($filename, '');
								    $mystring = '
/* That\'s all, stop editing! Happy blogging. */
$domain = $_SERVER["SERVER_NAME"];
define( "WP_SITEURL", "http://".$domain );
define( "WP_HOME", WP_SITEURL );

define( "WP_CONTENT_FOLDERNAME","/'.$wpcontentdir.'");
define( "WP_CONTENT_DIR", ABSPATH . WP_CONTENT_FOLDERNAME);
define( "WP_CONTENT_URL", WP_SITEURL . "/" . WP_CONTENT_FOLDERNAME);
define( "WP_PLUGIN_DIR", WP_CONTENT_DIR . "/'.$plugins.'");
define( "WP_PLUGIN_URL", WP_CONTENT_URL . "/'.$plugins.'");
define( "UPLOADS", WP_CONTENT_FOLDERNAME . "/'.$uplaoddir.'");';
								$file = $sitemanager.'/wp-config.php';
								$data = file($file);
								foreach ($data as $k=>$v){
								    if ( strpos($v,"/* That's all, stop editing! Happy blogging. */") !==FALSE){
								        $data[$k]=$data[$k] . "$mystring\n";
								    }
								}
								file_put_contents($file,$data);
								echo "<p class='bg-info'> <span class='glyphicon glyphicon-exclamation-sign'></span> seetings added to wp-config.php </p>";
								file_put_contents('core/temp/sites/'.$site_selected, 'Site Built on: '.date('l jS \of F Y h:i:s A'));
								}
								echo " <br> <br> <a class='btn btn-warning btn-block' href='manage.php'>You are Done, Close this</a>";
							}
					    ?>
			        </div>
			    
			
		</div>
	</div>
<div class="clear"></div>
<footer class="footer" style="margin-top: 260px;">
    <div class="container">
      <div class="row">
        <div class="col-xs-7">
          <h3 class="footer-title">About WP MAMP Manager</h3>
          <p>Welcome to the famous two-minutes WordPress installation process! Just fill in the information below and you’ll be on your way to using the most extendable and powerful personal publishing platform in the world.</a>
          </p>

          <a class="footer-brand" href="http://velismichel.com" target="_blank">
            <img class="img-responsive" src="core/images/mamp-logo.png" style="max-width: 245px;">
          </a>
        </div> <!-- /col-xs-7 -->

        <div class="col-xs-5">
          <div class="footer-banner">
            <h3 class="footer-title">Help and Documentation</h3>
            <ul>
              <li><i class="fa fa-book"></i><a href="documentation.html">Documentation and Guide</a></li>
              <li><i class="glyphicon glyphicon-th-list" aria-hidden="true"></i><a href="#req" data-toggle="modal" data-target="#checkreqs">Check Requirements</a></li>
              <li><i class="fa fa-user"></i> <a href="http://velismichel.com" target="_blank">Author WebSite</a></li>
              <li><i class="fa fa-envelope-o"></i> <a href="core/feedback/send.php">Send Feedback</a></li>
              <li><i class="fa fa-github-square"></i><a href="https://github.com/michelve/WordPress-MAMP-Wordpress-Install-Web-Interface-" target="_blank">GitHub Project</a></li>
            </ul>
            <div class="donate">
              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                  <input type="hidden" name="cmd" value="_s-xclick">
                  <input type="hidden" name="hosted_button_id" value="WN72DLG847QRC">
                  <input type="image" src="core/images/donate.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script type="text/javascript" src="core/js/app.js"></script>

</body>
</html> 
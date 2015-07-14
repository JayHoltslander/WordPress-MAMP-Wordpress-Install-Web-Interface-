<?php
    // @Author: Michel Velis
    // @Repository: https://github.com/michelve/WordPress-MAMP-Wordpress-Install-Web-Interface-
    // @Version: 1.0.7
    // @Author URL: https://velismichel.com

    // disable runtime errors
    error_reporting(0);

    // Include MAMP Files
    if(file_exists('/Applications/MAMP/bin/mamp/php/functions.php')) {
        include_once '/Applications/MAMP/bin/mamp/php/functions.php';
    }
    if(file_exists('/Applications/MAMP/bin/phpMyAdmin/config.inc.php')) {
        include_once('/Applications/MAMP/bin/phpMyAdmin/config.inc.php');
    }
    // if(file_exists('core/connection.php')) {
    //   include_once('core/connection.php');
    // }

    define('WPINSTALL', TRUE);
    define('DOCUMENT_ROOT', dirname(__file__).'/');

    $current_version = '1.0.8';
    $nullpath = '';
    $action_link = 'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    $result = exec('grep -r ^DocumentRoot /Applications/MAMP/conf/apache/httpd.conf');
    $result = substr($result, stripos($result, 'DocumentRoot'));
    $localhostpath = trim(str_replace(array('DocumentRoot', '"'), '', $result));
    $site_path_var = $_SERVER["DOCUMENT_ROOT"];
    $file_location = $_SERVER['SCRIPT_FILENAME'];

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

        mkdir($_REQUEST['sitename'].'.com', 0755);

        if (is_dir($_REQUEST['sitename'].'.com')) {
            rmdir($_REQUEST['sitename'].'.com');
        }
        if (empty($_POST['localhostdir']) || empty($_POST['sitename']) || empty($_POST['dbname']) || empty($_POST['dbuser']) || empty($_POST['host']) || empty($_POST['dbpass']))  {
            print ("please enter the required values");
        }
    }
    if(isset($_COOKIE['choice'])) {
        $class = 'show';
        $hide_picker = 'hide';
    }
?>
<html>
    <head>
        <title>WP MAMP Manager</title>
        <!-- CSS Files -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="core/css/animate.css">
        <link rel="stylesheet" type="text/css" href="core/css/form.css">
        <link rel="stylesheet" type="text/css" href="core/css/app.css">
        <!-- JS Files -->
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="core/js/jquery.cookie.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </head>

<body class="<?php echo isset($_GET['step']) ? $_GET['step'] : '';?>">

    <?php include 'core/views/nav.php'; ?>

    <div id="sitemanager" class="showsites" style="display:none">
        <div class="body">
        <div class="close-sites"> X </div>
            <?php
                $row = exec('cd '.$localhostpath.'; ls ',$output,$error);
                if($error){
                    echo "Error : $error<br/>\n";
                    exit;
                }
                $output = preg_replace('/\b.com\b/', '.dev/', $output);
                while(list(,$row) = each($output)){
                    echo '
                        <div class="clear"></div>
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
    <?php include 'core/box.php' ?>
    <div class="container main-wrapper">
        <div class="clear"></div>
        <div class="the_path <?php echo $hide_picker; ?>" role="form">
            <div class="row">
                <div class="decide">
                    <fieldset>
                        <div class="row">
                            <div class="make-a-choice">
                                <h2>Welcome to WP MAMP Manager</h2>
                                <h4><?php echo exec('whoami'); ?>, what do you want to do?</h4>
                                <div class="clear"></div>
                                <noscript>
                                    <div class="alert alert-danger" role="alert"> <strong>WARNING:</strong> Please enable JavaScript</div>
                                </noscript>

                                <div class="radio radio-danger half">
                                    <input type="radio" name="choice" id="installwp-opt" value="installwp-opt">
                                    <label for="installwp-opt">
                                        Install & Manage WordPress
                                    </label>
                                </div>
                                <div class="divider"></div>
                                <div class="radio radio-danger half">
                                    <input type="radio" name="choice" id="managewp-opt" value="managewp-opt">
                                    <label for="managewp-opt">
                                        Read Documentation
                                    </label>
                                </div>
                                <div class="clear"></div>
                                <div class="copy">
                                    <p class="palette-paragraph">Author: <a href="http://velismichel.com">Michel Velis</a>
                                        <br>
                                        <i class="fa fa-github-square"></i> <a href="https://github.com/michelve/WordPress-MAMP-Wordpress-Install-Web-Interface-" target="_blank">GitHub Project</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('.site-manager').hide();
                $('.step1').hide();
                $('.progress').hide();
                $('.footer').hide();
            });
            // check for chocie
            $('input:radio[name="choice"]').change(
                function() {
                    if ($(this).val() == 'installwp-opt') {
                        $('.site-manager').show();
                        $('.step1').show();
                        $('.progress').show();
                        $('.footer').show();
                        $('.the_path').hide();
                        $.cookie('choice', 'picked', {
                            expires: 30
                        });
                    } else {
                        $(location).attr('href', 'documentation.html');
                    }
                });
        </script>

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

    <footer class="footer <?php echo $class; ?>">
        <div class="container">
            <div class="row">
                <div class="col-xs-7">
                    <h3 class="footer-title">About WP MAMP Manager</h3>
                    <p>Welcome to the famous two-minutes WordPress installation process! Just fill in the information below and you’ll be on your way to using the most extendable and powerful personal publishing platform in the world.</a>
                    </p>
                    <a class="footer-brand" href="http://velismichel.com" target="_blank">
                        <img class="img-responsive" src="core/images/mamp-logo.png" style="max-width: 245px;">
                    </a>
                </div>
                <!-- /col-xs-7 -->

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

    <!-- jQuery Validate -->
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <!-- MAIN JS APP File -->
    <script type="text/javascript" src="core/js/app.js"></script>

</body>

</html>
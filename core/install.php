<style type="text/css">
    .step1, .step2 {
        display: none;
    }
</style>

<div class="row step3">
<?php
    if (is_dir($sitename.'.com')) {
            rmdir($sitename.'.com');
    }
?>

<?php
    if (is_dir($path.'/'.$sitename.'.com/') == true) {
        echo '<div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">Error:</span>
              Folder '.$sitename.'.com exist
            </div>';
        echo ' <style type="text/css">
          .step2 {
            display: block;
          }
          .step1 {
            display: none;
          }
          </style>';

    }
    else  {
        echo '<script> 
        $("#progress").attr("aria-valuenow", "97");
            $("#progress").css( "width", "97%" );
            $("#progress" ).html( "97%" );
        </script>';

        $wordpress_zip = 'latest.zip';

        echo ' <style type="text/css"> .step2 {display: block; } .step1, .installinfo {display: none; } </style>';


        if (file_exists($wordpress_zip)) {
            echo "Wordpress zip file exist";
        } 
        else {
            $url = 'https://wordpress.org/latest.zip';
            $file = "latest.zip";
            $src = fopen($url, 'r');
            $dest = fopen($file, 'w');
            echo "<p class='bg-success'> <span class='glyphicon glyphicon-save'></span>  Downloading the latest Wordpress zip file available ... </p>";
            echo '<p class="bg-success"> <span class="glyphicon glyphicon-save-file"></span> '.stream_copy_to_stream($src, $dest) . " bytes copied.\n</p>";
            chmod('latest.zip',0644);

            $wordpresszip = 'latest.zip';

            // $path = pathinfo(realpath($wordpresszip), PATHINFO_DIRNAME);

            $path = $localhostpath;
            $zip = new ZipArchive;
            $res = $zip->open($wordpresszip);

            if ($res === TRUE) {
              $zip->extractTo($path);
              $zip->close();
              rename ($path.'/wordpress', $path.'/'.$sitename.'.com');
              unlink('latest.zip');
              sleep(1);
              echo "<p class='bg-success'> <span class='glyphicon glyphicon-compressed'></span> GREAT: $wordpresszip extracted to $path </p>";
            }
            else {
              echo "<p class='bg-danger'> <span class='glyphicon glyphicon-exclamation-sign'></span> FAILED: Couldn't open $wordpresszip or file does nto exist</p>";
            }
        }
        $wp_config_sample = $path.'/'.$sitename.'.com/'.'wp-config-sample.php';
        $wp_config = $path.'/'.$sitename.'.com/'.'wp-config.php';

        #Create wp-config file
        if (!copy($wp_config_sample, $wp_config)) {
            echo "failed to copy $wp_config_sample ...\n";
        }
        else {
            sleep(1);
            echo "<p class='bg-success'> <span class='glyphicon glyphicon-copy'></span> Notice: wp-config.file created </p>";
        }

        #edit config file

        //read the entire string
        $str=implode("",file($path.'/'.$sitename.'.com/'.'wp-config.php'));
        $fp=fopen($path.'/'.$sitename.'.com/'.'wp-config.php','w');

        //replace wp variables with the user's
        $str=str_replace('database_name_here',$dbname,$str);
        $str=str_replace('username_here',$dbuser,$str);
        $str=str_replace('password_here',$dbpass,$str);
        $str=str_replace('localhost',$host,$str);
        $str=str_replace('wp_',$dbprefix,$str);

        #get salt keys
        $get_wpsaltskey_url = file_get_contents('https://api.wordpress.org/secret-key/1.1/salt/');
        $str=str_replace('/**#@-*/',$get_wpsaltskey_url,$str);
        fwrite($fp,$str,strlen($str));

        $key = "phrase";
        $fc=file($path.'/'.$sitename.'.com/'.'wp-config.php');
        $f=fopen($path.'/'.$sitename.'.com/'.'wp-config.php',"w");

        foreach($fc as $line){
            if (!strstr($line,$key)) 
                fputs($f,$line);
        }
        fclose($f);  

        #lets craete the host files for the site
        $httpd_vhostsfile = '/Applications/MAMP/conf/apache/extra/httpd-vhosts.conf';
        $httpd_vhosts = file_get_contents('/Applications/MAMP/conf/apache/extra/httpd-vhosts.conf');
        $privatehostfile = '/private/etc/hosts';

        $VirtualHost = '<VirtualHost *:80> 
            ServerAdmin admin@'.$sitename.'.com
            DocumentRoot '.$path.'/'.$sitename.'.com'.'
            ServerName '.$sitename.'.dev'.'
            ErrorLog logs/'.$sitename.'.dev-error_log
            CustomLog logs/'.$sitename.'.dev-access_log common
        </VirtualHost>';

        // line to add to hosts
        $localhost_site = '127.0.0.1  '.$sitename.'.dev';

        $mamphost = file_put_contents($httpd_vhostsfile, $VirtualHost.PHP_EOL , FILE_APPEND);
        $hosts = file_put_contents($privatehostfile, $localhost_site.PHP_EOL , FILE_APPEND);

        fwrite($mamphost, $VirtualHost);
        fwrite($hosts, $localhost_site);
        fclose($mamphost);
        fclose($hosts);
        echo "<p class='bg-success'> <span class='glyphicon glyphicon-exclamation-sign'></span> Virtual Host Added to MAMP -> $httpd_vhostsfile </p>";

        #check localhost for permission
        if (is_writable($privatehostfile)) {

            // connect to database
            $username = $dbuser;
            $password = $dbpass;
            // $username = 'root';
            // $password = 'root';

            // Create connection
            $conn = new mysqli($host, $username, $password);
            // Check connection
            if ($conn->connect_error) {
                die("MYSQL Connection failed: " . $conn->connect_error);
            } 

            // Create database
            $sql = "CREATE DATABASE ".$dbname."";
            if ($conn->query($sql) === TRUE) {
                echo "<p class='bg-success'> <span class='glyphicon glyphicon-exclamation-sign'></span> Database created successfully </p>";
            } else {
                echo "<p class='bg-danger'> <span class='glyphicon glyphicon-exclamation-sign'></span>  Error creating database: " . $conn->error."</p>";
            }

            $conn->close();
             echo "<p class='bg-info'> <span class='glyphicon glyphicon-exclamation-sign'></span>  Database created </p>";

             echo "<p class='bg-success'> <span class='glyphicon glyphicon-exclamation-sign'></span>  The hosts file is writable at -> $privatehostfile </p>";

            echo "<p class='bg-info'> <span class='glyphicon glyphicon-exclamation-sign'></span>  Host address added</p>";

            // flush dns
            system('dscacheutil -flushcache');
            echo "<p class='bg-warning'> <span class='glyphicon glyphicon-exclamation-sign'></span>  Flushing DNS</p>";
            // close MAMP
            //system('open ./closeMAMP.app');
            // shell_exec('sh ./closeMAMP.app');

            sleep(8);
            echo "<p class='bg-warning'> <span class='glyphicon glyphicon-exclamation-sign'></span>  Closing MAMP</p>";
            // Restart MAMP
            echo '<script> 
                    function confirmDelete() { 
                     if (confirm("Please open MAMP and restart apache and mysql. Have you re-start MAMP yet?")) {
                        return true; 
                     } else {
                        return false;
                     } 
                    } 
                    confirmDelete();
                    </script> ';
            //system('open ./openMAMP.app');
            echo "<p class='bg-warning'> <span class='glyphicon glyphicon-exclamation-sign'></span>  Restarting MAMP</p>";
            sleep(6);

        }
        else {
             echo "<p class='bg-danger'> <span class='glyphicon glyphicon-exclamation-sign'></span>  The hosts file is not writable at -> $privatehostfile (fix this issue).</p>";
             echo "<p class='bg-danger'> <span class='glyphicon glyphicon-exclamation-sign'></span>  Installation cancelled.</p>";
        }
         echo ' <style type="text/css"> #getconfig {display: none; } </style>';
        // lets clean the installation
        $readmehtml = $path.'/'.$sitename.'.com/readme.html';
        $licensetxt = $path.'/'.$sitename.'.com/license.txt';

        if (file_exists($readmehtml)) {
            unlink($path.'/'.$sitename.'.com/readme.html');
        }
        elseif (file_exists($licensetxt)) {
            unlink($path.'/'.$sitename.'.com/license.txt');
        }
        elseif (is_dir($sitename.'.com')) {
            rmdir($sitename.'.com');
        }
    }
    echo '<script> 
        $("#progress").attr("aria-valuenow", "98");
            $("#progress").css( "width", "98%" );
            $("#progress" ).html( "98%" );
        </script>';

?>
<form method="POST" name="getconfig" action="<?php echo $PHP_SELF;?>/app.php?step=install">
    <div class="col-sm-3">
        <input id="edit" class="btn btn-default btn-lg" type="button" value="Edit" onclick="history.back();">
    </div>
    <div class="col-sm-9">
        <a href="http://<?php echo $sitename.'.dev/'; ?>" id="openwp" type="submit" name="openwp" class="btn btn-danger btn-lg">Open > <?php echo $sitename.'.dev'; ?></a>
    </div>
</form>
</div>

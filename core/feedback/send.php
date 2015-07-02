<?php
    define('WPINSTALL', TRUE); 
    if (isset($_POST["submit"])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $human = intval($_POST['human']);
        $from = 'Demo Contact Form'; 
        $to = 'mvelis90@gmail.com'; 
        $subject = 'Message from Contact Demo ';
        
        $body ="From: $name\n E-Mail: $email\n Message:\n $message";

        // Check if name has been entered
        if (!$_POST['name']) {
            $errName = 'Please enter your name';
        }
        
        // Check if email has been entered and is valid
        if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errEmail = 'Please enter a valid email address';
        }
        
        //Check if message has been entered
        if (!$_POST['message']) {
            $errMessage = 'Please enter your message';
        }
        //Check if simple anti-bot test is correct
        if ($human !== 5) {
            $errHuman = 'Your anti-spam is incorrect';
        }

// If there are no errors, send the email
if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
    if (mail ($to, $subject, $body, $from)) {
        $result='<div class="alert alert-success">Thank You! I will be in touch</div>';
    } else {
        $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
    }
}
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>WP MAMP Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/animate.css">
        <link rel="stylesheet" type="text/css" href="../css/form.css">
        <link rel="stylesheet" type="text/css" href="../css/app.css">
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="../js/jquery.cookie.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <style>.progress {display: none; }</style> 
    </head>
  <body>
  <div class="navbar-fixed-top site-manager <?php echo $class; ?> animated slideInDown">
      <div class="container">
        <div class="row">
          <div class="col-xs-4 home-link">
            <nav><a href="../../index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></nav>
          </div>
          <div class="col-xs-8">
              <nav>
                <a id="manager" href="#manager"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Site Manager </a> 
                <a href="../../manage.php"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> WP Manager </a>
                <!-- <a href="migrate.php" class="migrate"><i class="fa fa-server"></i></span> WP Migration </a> -->
              </nav>
          </div>
        </div>
      </div>
    </div>
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

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="page-header text-center">Send Feedback</h1>
                <form class="form-horizontal" role="form" method="post" action="send.php">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="First &amp; Last Name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
                            <?php echo "<p class='text-danger'>$errName</p>";?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
                            <?php echo "<p class='text-danger'>$errEmail</p>";?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
                            <?php echo "<p class='text-danger'>$errMessage</p>";?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
                            <?php echo "<p class='text-danger'>$errHuman</p>";?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <input id="submit" name="submit" type="submit" value="I'm Done, Send it!" class="btn btn-danger">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <?php echo $result; ?>  
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>   
    <footer class="footer <?php echo $class; ?>">
        <div class="container">
          <div class="row">
            <div class="col-xs-7">
              <h3 class="footer-title">About WP MAMP Manager</h3>
              <p>Welcome to the famous two-minutes WordPress installation process! Just fill in the information below and you’ll be on your way to using the most extendable and powerful personal publishing platform in the world.</a>
              </p>
              <a class="footer-brand" href="http://velismichel.com" target="_blank">
                <img class="img-responsive" src="../images/mamp-logo.png" style="max-width: 245px;">
              </a>
            </div> <!-- /col-xs-7 -->

            <div class="col-xs-5">
              <div class="footer-banner">
                <h3 class="footer-title">Help and Documentation</h3>
                <ul>
                  <li><i class="fa fa-book"></i><a href="../../documentation.html">Documentation and Guide</a></li>
                  <li><i class="glyphicon glyphicon-th-list" aria-hidden="true"></i><a href="#req" data-toggle="modal" data-target="#checkreqs">Check Requirements</a></li>
                  <li><i class="fa fa-user"></i> <a href="http://velismichel.com" target="_blank">Author WebSite</a></li>
                  <li><i class="fa fa-github-square"></i><a href="https://github.com/michelve/WordPress-MAMP-Wordpress-Install-Web-Interface-" target="_blank">GitHub Project</a></li>
                </ul>
                <div class="donate">
                  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                      <input type="hidden" name="cmd" value="_s-xclick">
                      <input type="hidden" name="hosted_button_id" value="WN72DLG847QRC">
                      <input type="image" src="../images/donate.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                      <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </footer>
    <?php include 'core/box.php' ?>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script type="text/javascript" src="core/js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>
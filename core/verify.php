<?php
    if(!defined('WPINSTALL')) {die('Direct access not permitted'); }
?>
 
<style type="text/css"> .step1 {display: none; } </style> 

<div class="row step2">
    <div class="downlaod">
        <div class="col-sm-7 verify-panel">
            <!-- <h2 class=""><span class="glyphicon glyphicon-wrench"></span> Lets Install Wordpress Now</h2> -->
            <h4><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
            <strong> Confirm:</strong>  Your Wordpress Install Info</h4>

            <p class="bg-info">The script will download and setup wordpress in <strong><?php echo $localhostdir; ?></strong> and the site name will be <strong><?php echo $sitename.'.com'; ?></strong></p>

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                    <tr class="active">
                        <td>Website Name</td>
                        <td>
                            <?php echo $sitename.'.com'; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Database Name</td>
                        <td>
                            <?php echo $dbname; ?>
                        </td>
                    </tr>
                    <tr class="active">
                        <td>Database User</td>
                        <td>
                            <?php echo $dbuser; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Database Password</td>
                        <td>
                            <?php echo $dbpass; ?>
                        </td>
                    </tr>
                    <tr class="active">
                        <td>Host</td>
                        <td>
                            <?php echo $host; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Database Prefix</td>
                        <td>
                            <?php echo $dbprefix; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="clear"></div>


            <div class="controls">
                <form id="getconfig" method="POST" name="getconfig" action="/index.php?step=install">
                    <div class="col-sm-3">
                        <input id="edit" class="btn btn-default btn-lg" type="button" value="Edit" onclick="history.back();">
                    </div>
                    <div class="col-sm-9">
                        <input id="getconfig" type="submit" value="Download and Install Worpress" name="getconfig" class="btn btn-danger btn-lg" />
                    </div>
                </form>
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-sm-5 wpinstall hidden-xs">
            <img src="core/images/wpinstall.png">
        </div>
    </div>
</div>
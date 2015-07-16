<?php if(!defined('WPINSTALL')) {die('Direct access not permitted'); }?>
<?php $action_step= 'verify'; ?>

<div class="row step1 <?php echo $class; ?>">
    <div class="clear"></div>
    <div class="error" style="display:none"></div>
    <form id="wpinfo" class="form-horizontal col-sm-12" action="<?php echo 'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>?step=<?php echo $action_step; ?>" method="POST" name="config">
        <div class="row">
            <fieldset>
                <div class="col-sm-6 animated slideInLeft dbinfo">
                    <div class="col-sm-12 header-app">
                        <div class="col-xs-6">
                            <img class="img-responsive" src="core/images/mamp-logo.png" style="max-width: 245px;">
                        </div>
                        <div class="col-xs-6 check-req">
                            <a href="#req" data-toggle="modal" data-target="#checkreqs"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Check App  </a>
                        </div>
                    </div>
                    <hr>
                    <div class="clear"></div>
                    <div class="control-group">
                        <!-- Username -->
                        <label class="col-sm-4 control-label" for="localhostdir">LocalHost Path</label>
                        <div class="controls col-sm-8">
                            <input type="text" id="localhostdir" name="localhostdir" placeholder="the absolute path to your localhost" value="<?php echo $localhostpath.'/';?>" class="form-control" data-toggle="tooltip" title="This is where all your local files/sites are">
                            <p class="text-muted">By default the path is determined from your localhost. If your path is different, correct it now.</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="control-group">
                        <!-- Username -->
                        <label class="control-label col-sm-4" for="sitename">Site Name</label>
                        <div class="controls col-sm-8">
                            <input type="text" id="sitename" name="sitename" placeholder="mysitename" class="form-control">
                            <p class="text-muted">Do not add .com or .dev. It will be added automatically.</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="col-sm-1 or-dvivider"></div>
                <div class="col-sm-5 animated slideInRight dbinfo panel-left">
                    <div class="col-sm-3">
                        <img src="core/images/wordpress-logo.svg">
                    </div>
                    <div class="col-sm-9 dbtitle">
                        <h4 class="title">Database Info</h4>
                    </div>
                    <div class="clear"></div>
                    <hr>
                    <div class="clear"></div>
                    <div class="control-group col-sm-6">
                        <!-- Username -->
                        <label class="control-label" for="host">Database Host</label>
                        <div class="controls">
                            <input type="text" id="host" name="host" value="127.0.0.1:<?php echo $cfg['Servers'][1]['port'] ? $cfg['Servers'][1]['port'] : "3306"; ?>" class="form-control" data-toggle="tooltip" title="If these values do not match. Open MAMP > Preferences > Ports and see which port mysql is using" required>
                            <p class="text-muted">We will try to get the default values from MAMP. &#40;Usually port 3306 or 8889&#41;</p>
                        </div>
                    </div>
                    <div class="control-group col-sm-6">
                        <!-- Username -->
                        <label class="control-label" for="dbname">Database Name</label>
                        <div class="controls">
                            <input type="text" id="dbname" name="dbname" placeholder="ex: db_mysite" class="form-control" required>
                            <p class="text-muted">Name site&#146;s database</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="control-group col-sm-6">
                        <!-- Username -->
                        <label class="control-label" for="dbuser">Database User</label>
                        <div class="controls">
                            <input type="text" id="dbuser" name="dbuser" value="<?php echo $cfg['Servers'][1]['user']; ?>" class="form-control" data-toggle="tooltip" title="By default MAMP uses root unless you have change the user" required>
                            <p class="text-muted"><?php echo $cfg['Servers'][1]['user']; ?> is the default user.</p>
                        </div>
                    </div>
                    <div class="control-group col-sm-6">
                        <!-- Username -->
                        <label class="control-label" for="dbpass">Database Password</label>
                        <div class="controls">
                            <input type="text" id="dbpass" value="<?php echo $cfg['Servers'][1]['password']; ?>" name="dbpass" class="form-control" data-toggle="tooltip" title="By default MAMP uses root unless you have change the password" required>
                            <p class="text-muted"><?php echo $cfg['Servers'][1]['password']; ?> is the default password.</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="control-group col-sm-12">
                        <!-- Username -->
                        <label class="control-label" for="dbprefix">Database Prefix</label>
                        <div class="controls">
                            <input type="text" id="dbprefix" name="dbprefix" value="PrX_" class="form-control" data-toggle="tooltip" title="It is recommended to change your default wp_ database prefix for security reasons" required>
                            <p class="text-muted">Note: It is recommended to use something other than wp_ for security reasons.</p>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="col-sm-4"></div>
                <div class="control-group col-sm-4 top">
                    <!-- Button -->
                    <div class="controls animated slideInUp">
                        <button type="submit" name="config" class="button button--moema button--text-thick button--text-upper button--size-s btn-primary"> Continue <i class="fa fa-angle-double-right"></i> </button>
                    </div>
                </div>
                <div class="col-sm-4"></div>
            </fieldset>
        </div>
    </form>
    <div class="col-sm-12"></div>
</div>
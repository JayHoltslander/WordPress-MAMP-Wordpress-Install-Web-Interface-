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
    </div> 
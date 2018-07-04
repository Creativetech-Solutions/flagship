<div class="inner-content"><a href="install.php">pre-installation check</a> &raquo; <a href="install.php?step=1">license</a> &raquo; <b>configuration</b> &raquo; completed</div>
<h2 id="install">General Configuration</h2>
<?php echo ($msg) ?  "<div class=\"error\">{$msg}</div>" : '';?>
<form action="install.php?step=2" method="post">
  <table cellpadding="0" cellspacing="0" style="margin: 0 10px 10px 10px;">
    <tr>
      <td colspan="2"><h3>MySQL database configuration</h3></td>
    </tr>
    <tr>
      <td class="item-desc"><p>Setting up Advanced Login System to run on your server involves 3 simple steps...</p>
        <p>Please enter the hostname of the server Advanced Login System is to be installed on.</p>
        <p>Enter the MySQL username, password and database name you wish to use with Advanced Login System.</p>
        <br />
        <div class="remove_install">It's strongly recommended to install sample data.</div></td>
      <td class="inner-content" style="vertical-align: top;"><table>
          <tr>
            <td><strong>MySQL Hostname:</strong></td>
            <td><input type="text" name="dbhost" size="20" value="<?php echo isset($_POST['dbhost']) ? sanitize($_POST['dbhost']) : 'localhost'; ?>" id="t1" /></td>
            <td><div class="err" id="err1">Please input correct MySQL hostname.</div></td>
          </tr>
          <tr>
            <td><strong>MySQL User Name:</strong></td>
            <td><input type="text" name="dbuser" size="20" value="<?php echo isset($_POST['dbuser']) ? sanitize($_POST['dbuser']) : ''; ?>" id="t2" /></td>
            <td><div class="err" id="err2">Please input correct MySQL username.</div></td>
          </tr>
          <tr>
            <td><strong>MySQL Password:</strong></td>
            <td><input type="password" name="dbpwd" size="20" value="" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>MySQL Database Name:</strong></td>
            <td><input type="text" name="dbname" size="20" value="<?php echo isset($_POST['dbname']) ? sanitize($_POST['dbname']) : ''; ?>" id="t3"/></td>
            <td><div class="err" id="err3">Please input correct database name.</div></td>
          </tr>
<?php /*?>          <tr>
            <td>Delete tables if exist:</td>
            <td><input type="checkbox" id="delete_tables" name="delete_tables" <?php echo isset($_POST['delete_tables']) ? 'checked="checked"' : ''; ?> /></td>
          </tr><?php */?>
          <tr>
            <td><strong>Install sample data:</strong></td>
            <td><input type="checkbox" id="install_data" name="install_data" checked="checked" /></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      <input type="hidden" name="db_action" id="db_action" value="1" /></td>
    </tr>
    <tr>
      <td colspan="2"><h3>Common configuration</h3></td>
    </tr>
    <tr>
      <td class="item-desc"><p>Configure correct paths and URLs to your Advanced Login System.</p>
        <p>Please select a template from a list of available templates uploaded to your templates directory.</p></td>
      <td class="inner-content" style="width: 480px; vertical-align: top;"><table>
          <tr>
            <td><div style="width:120px"><strong>URL:</strong></div></td>
            <td align="center"><input type="text" name="site_url" value="http://<?php echo $_SERVER['SERVER_NAME'].$script_path;?>" size="30"/></td>
          </tr>
          <tr>
            <td><div style="width:120px"><strong>Site Name:</strong></div></td>
            <td align="center"><input type="text" name="site_name" value="Your Site Name" size="30"/></td>
          </tr>
          <tr>
            <td><div style="width:120px"><strong>Site Email:</strong></div></td>
            <td align="center"><input type="text" name="site_email" value="site@mail.com" size="30"/></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="2"><h3>Administrator configuration</h3></td>
    </tr>
    <tr>
      <td class="item-desc"><p>Please set your admin username. It will be used for loggin to your admin panel.</p>
        <p>You should input admin password. Make sure your entered passwords match each other.</p>
        <p>Input your email. All the notifications will be sent from this email. It can be changed in your admin panel later.</p></td>
      <td class="inner-content"><table>
          <tr>
            <td><strong>Admin Username:</strong></td>
            <td align="center"><input type="text" name="admin_username" value="<?php echo isset($_POST['admin_username']) ? sanitize($_POST['admin_username']) : 'admin'; ?>" size="20" id="t4" /></td>
            <td><div class="err" id="err4">Please input correct admin username.</div></td>
          </tr>
          <tr>
            <td><strong>Admin Password:</strong></td>
            <td align="center"><input type="password" name="admin_password" value="<?php echo isset($_POST['admin_password']) ? sanitize($_POST['admin_password']) : ''; ?>" size="20" id="t5" /></td>
            <td><div class="err" id="err5">Please input password.</div></td>
          </tr>
          <tr>
            <td><strong>Admin Password[confirm]:</strong></td>
            <td align="center"><input type="password" name="admin_password2" value="" size="20" id="t6" /></td>
            <td><div class="err" id="err6">Entered passwords do not match.</div></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <div class="btn lgn">
    <button type="button" onclick="document.location.href='install.php?step=1';" name="back">Back</button>
    &nbsp;&nbsp;
    <button type="submit" name="next">Next</button>
  </div>
</form>

<?php

###############################################################
# Page Password Protect 2.13
###############################################################
# Visit http://www.zubrag.com/scripts/ for updates
############################################################### 
#
# Usage:
# Set usernames / passwords in volunteers database
# Open it in browser with "help" parameter to get the code
# to add to all files being protected. 
#    Example: password_protect.php?help
# Include protection string which it gave you into every file that needs to be protected
#
# Add following HTML code to your page where you want to have logout link
# <a href="http://www.saveaslave.com/password_protect.php?logout=1">Logout</a>
#
##################################################################
#  SETTINGS START
##################################################################
// request login? true - show login and password boxes, false - password box only
define('USE_USERNAME', true);

// User will be redirected to this page after logout
define('LOGOUT_URL', 'http://www.saveaslave.com/');

// time out after NN minutes of inactivity. Set to 0 to not timeout
define('TIMEOUT_MINUTES', 5);

// This parameter is only useful when TIMEOUT_MINUTES is not zero
// true - timeout time from last activity, false - timeout time from login
define('TIMEOUT_CHECK_ACTIVITY', true);

$fullserverpage = basename($_SERVER['HTTP_REFERER']);
if ($fullserverpage=='') {
  $fullserverpage = basename($_SERVER['PHP_SELF']);
}
$serverpage = substr($fullserverpage, 0, (strpos($fullserverpage, '.')+4));
//echo "FullServerpage=".$fullserverpage;
##################################################################
#  SETTINGS END
##################################################################

// show usage example
if(isset($_GET['help'])) {
  die('Include following code into every page you would like to protect, at the very beginning (first line):<br>&lt;?php include("' . str_replace('\\','\\\\',__FILE__) . '"); ?&gt;');
}

// timeout in seconds
$timeout = (TIMEOUT_MINUTES == 0 ? 0 : time() + TIMEOUT_MINUTES * 60);

// logout?
if(isset($_GET['logout'])) {
  setcookie("verify", '', $timeout, '/'); // clear password;
  header('Location: ' . LOGOUT_URL);
  exit();
}

if(!function_exists('showLoginPasswordProtect')) {

// show login form
function showLoginPasswordProtect($error_msg) {
?>
<html>
<head>
  <title>Please enter password to access this page</title>
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
  <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
</head>
<body>
  <style>
    input { border: 1px solid black; }
  </style>
  <div style="width:500px; margin-left:auto; margin-right:auto; text-align:center">
  <form method="post">
    <h3>Please enter password to access this page</h3>
    <font color="red"><?php echo $error_msg; ?></font><br />
<?php if (USE_USERNAME) echo 'Login:<br /><input type="input" name="access_login" /><br />Password:<br />'; ?>
    <input type="password" name="access_password" /><p></p><input type="submit" name="Submit" value="Submit" />
  </form>
  <br />
  <a style="font-size:9px; color: #B0B0B0; font-family: Verdana, Arial;" href="http://www.zubrag.com/scripts/password-protect.php" title="Download Password Protector">Based on Password Protect</a>
  </div>
</body>
</html>

<?php
  // stop at this point
  die();
}
}

// user provided password
if (isset($_POST['access_password'])) {
  $login = isset($_POST['access_login']) ? $_POST['access_login'] : '';
  $pass = $_POST['access_password'];
  //Connect to the database
  include("/database.php");
  $sql = "SELECT `id`, `username`, `password`, `page_permissions` FROM `volunteers` WHERE `removed`=0 AND `username`='".$login."' AND `password`=MD5('".$pass."')";
  $result = $conn->query($sql);

  if ($result->num_rows <= 0) {
    showLoginPasswordProtect("Incorrect password.");
  } else {
    // set cookie if password was validated
    $row = $result->fetch_assoc();
    $cookievalue = str_pad($row["id"],3,'0',STR_PAD_LEFT).md5($login.'%'.$pass).$row["page_permissions"];
    setcookie("verify", $cookievalue, $timeout, '/');

    // Some programs (like Form1 Bilder) check $_POST array to see if parameters passed
    // So need to clear password protector variables
    unset($_POST['access_login']);
    unset($_POST['access_password']);
    unset($_POST['Submit']);
  }
} else {
  // check if password cookie is set
  if (!isset($_COOKIE['verify'])) {
    showLoginPasswordProtect("");
  }

  // prolong timeout
  if (TIMEOUT_CHECK_ACTIVITY) {
    setcookie("verify", $_COOKIE['verify'], $timeout, '/');
  }
}

// check if user has authorization for that page
if (!(strpos($_COOKIE['verify'],$serverpage) || strpos($cookievalue,$serverpage))) {
  showLoginPasswordProtect("User does not have permissions for the ".$serverpage." page.");
}
/*
if ($serverpage == "managecountry.php") {
  //check if they have permissions for that country
  echo "Managing a Country";
}
*/

?>
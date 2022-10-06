<?php require_once('Connections/expenceconn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


?>
<?php
// *** Validate request to login to this site.
  session_start();
if(isset($_POST['btnlogin'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query="SELECT userusername,pid FROM users WHERE userusername='$username' AND userpassword='$password'"; 
   $check=mysql_query($query);
   $num_rows=mysql_num_rows($check);

  if($num_rows){
   $row=mysql_fetch_assoc($check);
  $_SESSION['username'] = $row['userusername'];
  $_SESSION['accountid'] = $row['pid'];
   
   if($_SESSION['accountid']){
   header("Refresh:1; url=dashboard.php");

  }else{
    echo '<script>alert("Invalid login details")</script>';
  }

  }else{
     $_SESSION['username'] = $username;
  $_SESSION['accountid'] = '987456';
  }


}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Auth</title>
		<link rel="stylesheet" media="all" type="text/css" href="styles/banner.css">
		<link rel="stylesheet" media="all" type="text/css" href="styles/authapp.css">
</head>
<body>
	<div class="banner">
		<table>
 			<tr>
 				<td>
 					<label  class="largeText">My Personal Expense</label>
 				</td>
 				<td>
 					<img src="assets/totalspent.png" width="75px" class="accountAvertor">
 				</td>
 				
 			</tr>
 		</table>
	</div>
	<br>

	<div class="fullscreen" id="login_form">
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      <tr valign="baseline">
        <td><input type="text" name="username" value="" class="myinputtext" placeholder="username" /></td>
      </tr>
      <tr valign="baseline">
        <td><input type="password" name="password" value="" class="myinputtext" placeholder="password" /></td>
      </tr>
      <tr valign="baseline">
        <td><center><input type="submit" name="btnlogin" value="Login Now" class="mybutton" /><cenetr></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
  </form>
  <p>&nbsp;</p>
<center>
     <a href="register.php" style="text-decoration: none;" class="mybuttontrans">Register an Account</a>
   <cenetr>
</div>


<br><br><br>
		<div class="banner" id="footer">
		<table>
 			<tr>
 				<td>
 					<label  class="largeText">My Expence</label>
 				</td>
 				<td>
 					<label  class="largeText">&copy; ALL RIGHTS RESERVED </label>
 				</td>
 				
 			</tr>
 		</table>
	</div>
  <script type="text/javascript" src="javascript/app.js"></script>
</body>
</html>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO users (userusername, userpassword, userid) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['userusername'], "text"),
                       GetSQLValueString($_POST['userpassword'], "text"),
                       GetSQLValueString($_POST['userid'], "text"));

  mysql_select_db($database_expenceconn, $expenceconn);
  $Result1 = mysql_query($insertSQL, $expenceconn);
if (mysql_errno($expenceconn) > 0) {
  // code...

    if(mysql_errno($expenceconn) == 1062){
      echo "<script>alert('duplicte');</script>";
    }else{
     echo "<script>alert('error occured');</script>"; 
    }
   
}else if($Result1){
   echo "<script>alert('sucess');</script>";
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
 					<label  class="largeText">My Expence</label>
 				</td>
 				<td>
 					<img src="assets/totalspent.png" width="75px" class="accountAvertor">
 				</td>
 				
 			</tr>
 		</table>
	</div>
	<br>

	<div class="fullscreen">
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      <tr valign="baseline">
        <td><input type="text" name="userusername" value="" size="32" class="myinputtext" placeholder="username" /></td>
      </tr>
      <tr valign="baseline">
        <td style="padding-top: 24px;"><input type="text" name="userpassword" value="" size="32" class="myinputtext" placeholder="password" /></td>
      </tr>
      <tr valign="baseline">
        <td style="padding-top: 24px;"><input type="text" name="userid" value="" size="32" class="myinputtext" placeholder="Confirm password" /></td>
      </tr>
      <tr valign="baseline">
        <td style="padding-top: 24px;"><center><input type="submit" value="Register Now" class="mybutton" /><cenetr></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
  </form>
  <p>&nbsp;</p>

  <center><input type="submit" value="Already have account Log in" class="mybuttontrans" /><cenetr>
</div>
<div>
	Guide app

</div>

		<div class="banner">
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
</body>
</html>
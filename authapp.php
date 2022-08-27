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
  $Result1 = mysql_query($insertSQL, $expenceconn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO persondetails (personID, surname, othername, phone, email, dateofbirth, gender, incomesourse) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['personID'], "int"),
                       GetSQLValueString($_POST['surname'], "text"),
                       GetSQLValueString($_POST['othername'], "text"),
                       GetSQLValueString($_POST['phone'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['dateofbirth'], "date"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['incomesourse'], "text"));

  mysql_select_db($database_expenceconn, $expenceconn);
  $Result1 = mysql_query($insertSQL, $expenceconn) or die(mysql_error());
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

	<div class="fullscreen" id="login_form">
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      <tr valign="baseline">
        <td><input type="text" name="username" value="" class="myinputtext" placeholder="username" /></td>
      </tr>
      <tr valign="baseline">
        <td><input type="text" name="password" value="" class="myinputtext" placeholder="password" /></td>
      </tr>
      <tr valign="baseline">
        <td><center><input type="submit" value="Login Now" class="mybutton" /><cenetr></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
  </form>
  <p>&nbsp;</p>

 <!--  <center><input type="button" value="Do not have account" class="mybuttontrans" id="btn_call_register" /><cenetr> -->
</div>
<center><button class="mybuttontrans" id="btn_call_register" >Do not have account</button><cenetr>

<div id="registration_form">
   <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
    <table align="center">
      <tr valign="baseline">
        <td><input type="text" name="personID" value="" class="myinputtext" placeholder="ID Number" /></td>
      </tr>
      <tr valign="baseline">
        <td><input type="text" name="surname" value="" class="myinputtext" placeholder="First Name" /></td>
      </tr>
      <tr valign="baseline">
        <td><input type="text" name="othername" value="" class="myinputtext" placeholder="Other Name" /></td>
      </tr>
      <tr valign="baseline">
        <td><input type="text" name="phone" value="" class="myinputtext" placeholder="Phone number" /></td>
      </tr>
      <tr valign="baseline">
        <td><input type="text" name="email" value="" class="myinputtext" placeholder="Email adrress"/></td>
      </tr>
      <tr valign="baseline">
        <td><input type="date" name="dateofbirth" value="" class="myinputtext" placeholder="username"/></td>
      </tr>
      <tr valign="baseline">
        <td><select name="gender" class="myoption">
          <option>Select Gender</option>
          <option>MALE</option>
          <option>FEMALE</option>
        </select></td>
      </tr>
      <tr valign="baseline">
        <td><input type="text" name="incomesourse" value="" class="myinputtext" placeholder="Income source" /></td>
      </tr>
      <tr valign="baseline">
        <td><input type="submit" value="Register now" class="mybutton" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form2" />
  </form>
  <p>&nbsp;</p>
  <center><input type="button" value="Already have an account" class="mybuttontrans" id="btn_call_login" /><cenetr>
</div>
<center>
  <button class="mybuttontrans" id="btn_call_login" >Already have an account</button>
</center>

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
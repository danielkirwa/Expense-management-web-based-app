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

$maxRows_fulluserdetaisl = 10;
$pageNum_fulluserdetaisl = 0;
if (isset($_GET['pageNum_fulluserdetaisl'])) {
  $pageNum_fulluserdetaisl = $_GET['pageNum_fulluserdetaisl'];
}
$startRow_fulluserdetaisl = $pageNum_fulluserdetaisl * $maxRows_fulluserdetaisl;

mysql_select_db($database_expenceconn, $expenceconn);
$query_fulluserdetaisl = "SELECT persondetails.personID, persondetails.surname, persondetails.othername, persondetails.phone, persondetails.email, persondetails.dateofbirth, persondetails.gender, persondetails.incomesourse FROM persondetails WHERE persondetails.personID = 987456";
$query_limit_fulluserdetaisl = sprintf("%s LIMIT %d, %d", $query_fulluserdetaisl, $startRow_fulluserdetaisl, $maxRows_fulluserdetaisl);
$fulluserdetaisl = mysql_query($query_limit_fulluserdetaisl, $expenceconn) or die(mysql_error());
$row_fulluserdetaisl = mysql_fetch_assoc($fulluserdetaisl);

if (isset($_GET['totalRows_fulluserdetaisl'])) {
  $totalRows_fulluserdetaisl = $_GET['totalRows_fulluserdetaisl'];
} else {
  $all_fulluserdetaisl = mysql_query($query_fulluserdetaisl);
  $totalRows_fulluserdetaisl = mysql_num_rows($all_fulluserdetaisl);
}
$totalPages_fulluserdetaisl = ceil($totalRows_fulluserdetaisl/$maxRows_fulluserdetaisl)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="styles/profile.css">
<title>Profile</title>
</head>
<body>
<table border="1">
  <tr>
    <td>personID</td>
    <td>surname</td>
    <td>othername</td>
    <td>phone</td>
    <td>email</td>
    <td>dateofbirth</td>
    <td>gender</td>
    <td>incomesourse</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_fulluserdetaisl['personID']; ?></td>
      <td><?php echo $row_fulluserdetaisl['surname']; ?></td>
      <td><?php echo $row_fulluserdetaisl['othername']; ?></td>
      <td><?php echo $row_fulluserdetaisl['phone']; ?></td>
      <td><?php echo $row_fulluserdetaisl['email']; ?></td>
      <td><?php echo $row_fulluserdetaisl['dateofbirth']; ?></td>
      <td><?php echo $row_fulluserdetaisl['gender']; ?></td>
      <td><?php echo $row_fulluserdetaisl['incomesourse']; ?></td>
    </tr>
    <?php } while ($row_fulluserdetaisl = mysql_fetch_assoc($fulluserdetaisl)); ?>
</table>


<div class="profile-holder">
  <div class="pro-image">
    Image
  </div>
  <div class="pro-details">
    details
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($fulluserdetaisl);
?>

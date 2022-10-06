<?php require_once('Connections/expenceconn.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

if ($_SESSION['accountid']) {
  // code...
 $currentUser =   $_SESSION['accountid'];
}else{
    header("Location:authapp.php");
}

?>
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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO emergency (purpose, dateadded, emergencydescription, pid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['purpose'], "text"),
                       GetSQLValueString($_POST['dateadded'], "date"),
                       GetSQLValueString($_POST['emergencydescription'], "text"),
                       GetSQLValueString($_POST['userid'], "text"));

  mysql_select_db($database_expenceconn, $expenceconn);
  $Result1 = mysql_query($insertSQL, $expenceconn) or die(mysql_error());
}

$maxRows_RecordsetEmergency = 10;
$pageNum_RecordsetEmergency = 0;
if (isset($_GET['pageNum_RecordsetEmergency'])) {
  $pageNum_RecordsetEmergency = $_GET['pageNum_RecordsetEmergency'];
}
$startRow_RecordsetEmergency = $pageNum_RecordsetEmergency * $maxRows_RecordsetEmergency;

mysql_select_db($database_expenceconn, $expenceconn);
$query_RecordsetEmergency = "SELECT emergencyID, purpose, dateadded, emergencydescription FROM emergency WHERE pid = '{$currentUser}' ORDER BY dateadded DESC";
$query_limit_RecordsetEmergency = sprintf("%s LIMIT %d, %d", $query_RecordsetEmergency, $startRow_RecordsetEmergency, $maxRows_RecordsetEmergency);
$RecordsetEmergency = mysql_query($query_limit_RecordsetEmergency, $expenceconn) or die(mysql_error());
$row_RecordsetEmergency = mysql_fetch_assoc($RecordsetEmergency);

if (isset($_GET['totalRows_RecordsetEmergency'])) {
  $totalRows_RecordsetEmergency = $_GET['totalRows_RecordsetEmergency'];
} else {
  $all_RecordsetEmergency = mysql_query($query_RecordsetEmergency);
  $totalRows_RecordsetEmergency = mysql_num_rows($all_RecordsetEmergency);
}
$totalPages_RecordsetEmergency = ceil($totalRows_RecordsetEmergency/$maxRows_RecordsetEmergency)-1;

$queryString_RecordsetEmergency = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordsetEmergency") == false && 
        stristr($param, "totalRows_RecordsetEmergency") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordsetEmergency = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordsetEmergency = sprintf("&totalRows_RecordsetEmergency=%d%s", $totalRows_RecordsetEmergency, $queryString_RecordsetEmergency);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="utf-8">
	<title>add emergency</title>
	<link rel="stylesheet" type="text/css" href="styles/banner.css">
	<link rel="stylesheet" type="text/css" href="styles/shopping.css">
</head>
<body>
	<div class="banner">
		<table>
 			<tr>
 				<td>
 					<label class="largeText">My Personal Expense</label>
 				</td>
 				<td>
 					<img src="assets/potrait.png" width="75px" class="accountAvertor">
 				</td>
 				
 			</tr>
 		</table>
	</div>
	<br>
	<center>
		<h2 class="dodgerblueText">Your emergency manager</h2>
	</center>

		

 	<div class="main-bill"> 
 		
 		
 			
 				<div class="smallmargintop">
 					<center><img src="assets/emergency.png" width="75px"></center>
 				</div>
 				<div class="smallmargintop">
 					<center>
 					<label class="largeText dodgerblueText">All Emergency : <span><?php echo $totalRows_RecordsetEmergency ?></span></label> &nbsp;</center>
 					</div>
<hr style="color: dodgerblue;">	
 	</div>
 	<div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="purpose" value="" size="32" class="myinputtext" placeholder="Purpose" /></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="date" name="dateadded" value="" size="32" class="myinputtext" /></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="emergencydescription" value="" size="32" class="myinputtext" placeholder="Description" /></td>
    </tr>
    <tr valign="baseline">
      <td  style="padding-top: 24px;"><input type="text" name="userid" value="<?php echo $_SESSION['accountid'] ?>" size="32" class="myinputtext" /></td>
    </tr>
    <tr valign="baseline">
      <td  style="padding-top: 24px;"><center><input type="submit" value="Add Emergency" class="mybutton" /></center></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>

 	</div>


 	<div class="scroll-table">
 	<div class="table-holder">
 		<div class="table-caption">
 			<label class="largeText brownText">Active active Emergency   : <span>null</span></label>
 		</div>
 		<table>
 			<thead>
 				<tr>
            <th>Emergency ID</th>
            <th>Savings name</th>
            <th>Savings Description</th>
 			<th>Date added</th>
 			<th>Action</th>
 				</tr>
 			</thead>
 			<tbody>
 </tr>
    <?php do { ?>
      <tr>
        <td><a href="viewemergency.php?recordID=<?php echo $row_RecordsetEmergency['emergencyID']; ?>"> <?php echo $row_RecordsetEmergency['emergencyID']; ?>&nbsp; </a></td>
        <td><?php echo $row_RecordsetEmergency['purpose']; ?>&nbsp; </td>
        <td><?php echo $row_RecordsetEmergency['dateadded']; ?>&nbsp; </td>
        <td><?php echo $row_RecordsetEmergency['emergencydescription']; ?>&nbsp; </td>
      </tr>
      <?php } while ($row_RecordsetEmergency = mysql_fetch_assoc($RecordsetEmergency)); ?>
  
    </tbody>
 		</table>
 		</div>

  </div>
</div>
       

</body>
</html>
<?php
mysql_free_result($RecordsetEmergency);
?>
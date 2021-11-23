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
$currentUser = 123;
$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO savings (savingID, savingpurpose, savingtarget, savingdateoppened, savingdateclosed, savingname, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['savingID'], "int"),
                       GetSQLValueString($_POST['savingpurpose'], "text"),
                       GetSQLValueString($_POST['savingtarget'], "text"),
                       GetSQLValueString($_POST['savingdateoppened'], "date"),
                       GetSQLValueString($_POST['savingdateclosed'], "date"),
                       GetSQLValueString($_POST['savingname'], "text"),
                       GetSQLValueString($_POST['userid'], "text"));

  mysql_select_db($database_expenceconn, $expenceconn);
  $Result1 = mysql_query($insertSQL, $expenceconn) or die(mysql_error());
}

$maxRows_RecordSetSaving = 10;
$pageNum_RecordSetSaving = 0;
if (isset($_GET['pageNum_RecordSetSaving'])) {
  $pageNum_RecordSetSaving = $_GET['pageNum_RecordSetSaving'];
}
$startRow_RecordSetSaving = $pageNum_RecordSetSaving * $maxRows_RecordSetSaving;

$colname_RecordSetSaving = "-1";
if (isset($_GET['userid'])) {
  $colname_RecordSetSaving = $_GET['userid'];
}
mysql_select_db($database_expenceconn, $expenceconn);
$query_RecordSetSaving = sprintf("SELECT savingID, savingpurpose, savingtarget, savingdateclosed, savingname FROM savings WHERE userid = %s ORDER BY savingdateclosed ASC", GetSQLValueString($currentUser, "int"));
$query_limit_RecordSetSaving = sprintf("%s LIMIT %d, %d", $query_RecordSetSaving, $startRow_RecordSetSaving, $maxRows_RecordSetSaving);
$RecordSetSaving = mysql_query($query_limit_RecordSetSaving, $expenceconn) or die(mysql_error());
$row_RecordSetSaving = mysql_fetch_assoc($RecordSetSaving);

if (isset($_GET['totalRows_RecordSetSaving'])) {
  $totalRows_RecordSetSaving = $_GET['totalRows_RecordSetSaving'];
} else {
  $all_RecordSetSaving = mysql_query($query_RecordSetSaving);
  $totalRows_RecordSetSaving = mysql_num_rows($all_RecordSetSaving);
}
$totalPages_RecordSetSaving = ceil($totalRows_RecordSetSaving/$maxRows_RecordSetSaving)-1;

$queryString_RecordSetSaving = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordSetSaving") == false && 
        stristr($param, "totalRows_RecordSetSaving") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordSetSaving = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordSetSaving = sprintf("&totalRows_RecordSetSaving=%d%s", $totalRows_RecordSetSaving, $queryString_RecordSetSaving);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="utf-8">
	<title>add savings</title>
	<link rel="stylesheet" type="text/css" href="styles/banner.css">
	<link rel="stylesheet" type="text/css" href="styles/shopping.css">
</head>
<body>
	<div class="banner">
		<table>
 			<tr>
 				<td>
 					<label class="largeText">My Expense</label>
 				</td>
 				<td>
 					<img src="assets/potrait.png" width="75px" class="accountAvertor">
 				</td>
 				
 			</tr>
 		</table>
	</div>
	<br>
	<center>
		<h2 class="dodgerblueText">Your savings manager</h2>
	</center>

		

 	<div class="main-bill"> 
 		
 		
 			
 				<div class="smallmargintop">
 					<center><img src="assets/shopping.png" width="75px"></center>
 				</div>
 				<div class="smallmargintop">
 					<center>
 					<label class="largeText dodgerblueText">Add your saving : <span>null</span></label> &nbsp;</center>
 					</div>
<hr style="color: dodgerblue;">	
 	</div>
 	<div>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="savingID" value="" size="32" class="myinputtext" /></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="savingpurpose" value="" size="32"  class="myinputtext" placeholder="Description" /></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="savingtarget" value="" size="32"  class="myinputtext" placeholder="Target" /></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="date" name="savingdateoppened" value="" size="32"  class="myinputtext"/> <span class="largeText dodgerblueText">Open Date  </span></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="date" name="savingdateclosed" value="" size="32"  class="myinputtext"/>  <span class="largeText dodgerblueText">Close Date </span></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="savingname" value="" size="32"  class="myinputtext" placeholder="name" /></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="userid" value="" size="32"  class="myinputtext" placeholder="userid" /></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><center><input type="submit" value="Add Saving" class="mybutton" /></center></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
 	</div>


 	<div class="scroll-table">
 	<div class="table-holder">
 		<div class="table-caption">
 			<label class="largeText brownText">Active active saving   : <span>null</span></label>
 		</div>
 		<table>
 			<thead>
 				<tr>
          <th>Savings ID</th>
          <th>Savings name</th>
          <th>Savings Description</th>
 					<th>Closing On</th>
 					<th>Target</th>
 					<th>Action</th>
 				</tr>
 			</thead>
 			<tbody>

 </tr>
    <?php do { ?>
      <tr>
        <td><a href="savingviews.php?recordID=<?php echo $row_RecordSetSaving['savingID']; ?>"> <?php echo $row_RecordSetSaving['savingID']; ?>&nbsp; </a></td>
        <td><?php echo $row_RecordSetSaving['savingname']; ?>&nbsp; </td>
        <td><?php echo $row_RecordSetSaving['savingpurpose']; ?>&nbsp; </td>
        <td><?php echo $row_RecordSetSaving['savingdateclosed']; ?>&nbsp; </td>
        <td><?php echo $row_RecordSetSaving['savingtarget']; ?>&nbsp; </td>
      </tr>
      <?php } while ($row_RecordSetSaving = mysql_fetch_assoc($RecordSetSaving)); ?>
    </tbody>
 		</table>
 		<table border="0">
    <tr>
      <td><?php if ($pageNum_RecordSetSaving > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RecordSetSaving=%d%s", $currentPage, 0, $queryString_RecordSetSaving); ?>">First</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_RecordSetSaving > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RecordSetSaving=%d%s", $currentPage, max(0, $pageNum_RecordSetSaving - 1), $queryString_RecordSetSaving); ?>">Previous</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_RecordSetSaving < $totalPages_RecordSetSaving) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RecordSetSaving=%d%s", $currentPage, min($totalPages_RecordSetSaving, $pageNum_RecordSetSaving + 1), $queryString_RecordSetSaving); ?>">Next</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_RecordSetSaving < $totalPages_RecordSetSaving) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RecordSetSaving=%d%s", $currentPage, $totalPages_RecordSetSaving, $queryString_RecordSetSaving); ?>">Last</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
Records <?php echo ($startRow_RecordSetSaving + 1) ?> to <?php echo min($startRow_RecordSetSaving + $maxRows_RecordSetSaving, $totalRows_RecordSetSaving) ?> of <?php echo $totalRows_RecordSetSaving ?>
      <br />
  </div>
</div>
       

</body>
</html>
<?php
mysql_free_result($RecordSetSaving);
?>
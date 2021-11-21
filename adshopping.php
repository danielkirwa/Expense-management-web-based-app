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
$currentUser = "123";
$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO shopping (shoppingID, shoppingname, shoppingdescription, shoopingdateadded, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['shoppingID'], "int"),
                       GetSQLValueString($_POST['shoppingname'], "text"),
                       GetSQLValueString($_POST['shoppingdescription'], "text"),
                       GetSQLValueString($_POST['shoopingdateadded'], "date"),
                       GetSQLValueString($_POST['userid'], "text"));

  mysql_select_db($database_expenceconn, $expenceconn);
  $Result1 = mysql_query($insertSQL, $expenceconn) or die(mysql_error());
}

$maxRows_RecordSetShopping = 10;
$pageNum_RecordSetShopping = 0;
if (isset($_GET['pageNum_RecordSetShopping'])) {
  $pageNum_RecordSetShopping = $_GET['pageNum_RecordSetShopping'];
}
$startRow_RecordSetShopping = $pageNum_RecordSetShopping * $maxRows_RecordSetShopping;

$colname_RecordSetShopping = "-1";
if (isset($_GET['userid'])) {
  $colname_RecordSetShopping = $_GET['userid'];
}
mysql_select_db($database_expenceconn, $expenceconn);
$query_RecordSetShopping = sprintf("SELECT shoppingID, shoppingname, shoppingdescription, shoopingdateadded FROM shopping WHERE userid = %s ORDER BY shoopingdateadded DESC",GetSQLValueString($currentUser, "int"));
  
$query_limit_RecordSetShopping = sprintf("%s LIMIT %d, %d", $query_RecordSetShopping, $startRow_RecordSetShopping, $maxRows_RecordSetShopping);
$RecordSetShopping = mysql_query($query_limit_RecordSetShopping, $expenceconn) or die(mysql_error());
$row_RecordSetShopping = mysql_fetch_assoc($RecordSetShopping);

if (isset($_GET['totalRows_RecordSetShopping'])) {
  $totalRows_RecordSetShopping = $_GET['totalRows_RecordSetShopping'];
} else {
  $all_RecordSetShopping = mysql_query($query_RecordSetShopping);
  $totalRows_RecordSetShopping = mysql_num_rows($all_RecordSetShopping);
}
$totalPages_RecordSetShopping = ceil($totalRows_RecordSetShopping/$maxRows_RecordSetShopping)-1;

$queryString_RecordSetShopping = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordSetShopping") == false && 
        stristr($param, "totalRows_RecordSetShopping") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordSetShopping = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordSetShopping = sprintf("&totalRows_RecordSetShopping=%d%s", $totalRows_RecordSetShopping, $queryString_RecordSetShopping);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="utf-8">
	<title>add shopping</title>
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
		<h2 class="dodgerblueText">Your shopping manager</h2>
	</center>

		

 	<div class="main-bill"> 
 		
 		
 			
 				<div class="smallmargintop">
 					<center><img src="assets/shopping.png" width="75px"></center>
 				</div>
 				<div class="smallmargintop">
 					<center>
 					<label class="largeText dodgerblueText">Add your shopping : <span>null</span></label> &nbsp;</center>
 					</div>
<hr style="color: dodgerblue;">
 					



 			
 	</div>
 	<div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="shoppingID" value="" size="32" placeholder="Shopping ID" class="myinputtext"/></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="shoppingname" value="" size="32" placeholder="Shopping name" class="myinputtext"/></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="shoppingdescription" value="" size="32" placeholder="Shopping description" class="myinputtext"/></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="date" name="shoopingdateadded" value="" size="32" class="myinputtext"/></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="userid" value="" size="32" placeholder="User id" class="myinputtext"/></td>
    </tr>
    <tr valign="baseline">
      
      <td style="padding-top: 24px;"><center><input type="submit" value="Add Shopping" class="mybutton" /> </center></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
 	</div>


 	<div class="scroll-table">
 	<div class="table-holder">
 		<div class="table-caption">
 			<label class="largeText brownText">Active Shopping   : <span>null</span></label>
 		</div>
 		<table>
 			<thead>
 				<tr>
          <th>Shopping ID</th>
          <th>Shopping name</th>
          <th>Shopping Description</th>
 					<th>Date/Time</th>
 					<th>Action</th>
 				</tr>
 			</thead>
 			<tbody>
       </tr>
    <?php do { ?>
      <tr>
        <td><a href="shoppingview.php?recordID=<?php echo $row_RecordSetShopping['shoppingID']; ?>"> <?php echo $row_RecordSetShopping['shoppingID']; ?>&nbsp; </a></td>
        <td><?php echo $row_RecordSetShopping['shoppingname']; ?>&nbsp; </td>
        <td><?php echo $row_RecordSetShopping['shoppingdescription']; ?>&nbsp; </td>
        <td><?php echo $row_RecordSetShopping['shoopingdateadded']; ?>&nbsp; </td>
      </tr>
      <?php } while ($row_RecordSetShopping = mysql_fetch_assoc($RecordSetShopping)); ?>
       
    
 		</table>
      <br />
  <table border="0">
    <tr>
      <td><?php if ($pageNum_RecordSetShopping > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RecordSetShopping=%d%s", $currentPage, 0, $queryString_RecordSetShopping); ?>">First</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_RecordSetShopping > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RecordSetShopping=%d%s", $currentPage, max(0, $pageNum_RecordSetShopping - 1), $queryString_RecordSetShopping); ?>">Previous</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_RecordSetShopping < $totalPages_RecordSetShopping) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RecordSetShopping=%d%s", $currentPage, min($totalPages_RecordSetShopping, $pageNum_RecordSetShopping + 1), $queryString_RecordSetShopping); ?>">Next</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_RecordSetShopping < $totalPages_RecordSetShopping) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RecordSetShopping=%d%s", $currentPage, $totalPages_RecordSetShopping, $queryString_RecordSetShopping); ?>">Last</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
Records <?php echo ($startRow_RecordSetShopping + 1) ?> to <?php echo min($startRow_RecordSetShopping + $maxRows_RecordSetShopping, $totalRows_RecordSetShopping) ?> of <?php echo $totalRows_RecordSetShopping ?></div>
</div>
       

 	</div>
 	</div>
</body>
</html>
<?php
mysql_free_result($RecordSetShopping);
?>
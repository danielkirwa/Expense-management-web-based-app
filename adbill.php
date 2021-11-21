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
$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO bills (billID, billname, billdescription, dateofadd, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['billID'], "int"),
                       GetSQLValueString($_POST['billname'], "text"),
                       GetSQLValueString($_POST['billdescription'], "text"),
                       GetSQLValueString($_POST['dateofadd'], "date"),
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
/// select all bills to display


$maxRows_RecordSetBill = 10;
$pageNum_RecordSetBill = 0;
if (isset($_GET['pageNum_RecordSetBill'])) {
  $pageNum_RecordSetBill = $_GET['pageNum_RecordSetBill'];
}
$startRow_RecordSetBill = $pageNum_RecordSetBill * $maxRows_RecordSetBill;

mysql_select_db($database_expenceconn, $expenceconn);
$query_RecordSetBill = "SELECT billID, billname, billdescription, dateofadd FROM bills ORDER BY dateofadd DESC";
$query_limit_RecordSetBill = sprintf("%s LIMIT %d, %d", $query_RecordSetBill, $startRow_RecordSetBill, $maxRows_RecordSetBill);
$RecordSetBill = mysql_query($query_limit_RecordSetBill, $expenceconn) or die(mysql_error());
$row_RecordSetBill = mysql_fetch_assoc($RecordSetBill);

if (isset($_GET['totalRows_RecordSetBill'])) {
  $totalRows_RecordSetBill = $_GET['totalRows_RecordSetBill'];
} else {
  $all_RecordSetBill = mysql_query($query_RecordSetBill);
  $totalRows_RecordSetBill = mysql_num_rows($all_RecordSetBill);
}
$totalPages_RecordSetBill = ceil($totalRows_RecordSetBill/$maxRows_RecordSetBill)-1;

$queryString_RecordSetBill = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordSetBill") == false && 
        stristr($param, "totalRows_RecordSetBill") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordSetBill = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordSetBill = sprintf("&totalRows_RecordSetBill=%d%s", $totalRows_RecordSetBill, $queryString_RecordSetBill);



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="utf-8">
	<title>add bills</title>
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
		<h2 class="dodgerblueText">Your bills manager</h2>
	</center>

		

 	<div class="main-bill"> 
 		
 		
 			
 				<div class="smallmargintop">
 					<center><img src="assets/expence.png" width="75px"></center>
 				</div>
 				<div class="smallmargintop">
 					<center>
 					<label class="largeText dodgerblueText">Add your bills : <span>null</span></label> &nbsp;</center>
 					</div>
<hr style="color: dodgerblue;">
 					



 			
 	</div>
 	<div>
 		
 		<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">

      <td><input type="text" name="billID" value="" size="32" class="myinputtext" placeholder="Bill id" /></td>
    </tr>
    <tr valign="baseline">

      <td style="padding-top: 24px;"><input type="text" name="billname" value="" size="32" class="myinputtext" placeholder="Bill Name" /></td>
    </tr>
    <tr valign="baseline">
    
      <td style="padding-top: 24px;"><input type="text" name="billdescription" value="" size="32" class="myinputtext" placeholder="Bill Description" /></td>
    </tr>
    <tr valign="baseline">
      
      <td style="padding-top: 24px;"><input type="date" name="dateofadd" value="" size="32" class="myinputtext"  /></td>
    </tr>
    <tr valign="baseline">
      
      <td style="padding-top: 24px;"><input type="text" name="userid" value="" size="32" class="myinputtext" placeholder="User id" /></td>
    </tr>
    <tr valign="baseline">
     
      <td style="padding-top: 24px;"><center><input type="submit" value="Add new bill" class="mybutton" /></center></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
 	</div>


 	<div class="scroll-table">
 	<div class="table-holder">
 		<div class="table-caption">
 			<label class="largeText brownText">Active Bills   : <span>null</span></label>
 		</div>
 		<table>
 			<thead>
 				<tr>
          <th>Bill ID</th>
          <th>Bill name</th>
          <th>Bill Description</th>
 					<th>Date/Time</th>
 					<th>Action</th>
 				</tr>
 			</thead>
 			<tbody>
     <tr>
       
           <?php do { ?>
      <tr>
        <td><a href="billsview.php?recordID=<?php echo $row_RecordSetBill['billID']; ?>"> <?php echo $row_RecordSetBill['billID']; ?>&nbsp; </a></td>
        <td><?php echo $row_RecordSetBill['billname']; ?>&nbsp; </td>
        <td><?php echo $row_RecordSetBill['billdescription']; ?>&nbsp; </td>
        <td><?php echo $row_RecordSetBill['dateofadd']; ?>&nbsp; </td>
      </tr>
      <?php } while ($row_RecordSetBill = mysql_fetch_assoc($RecordSetBill)); ?>
     </tr>
 			</tbody>
 		</table>
 <table border="0">
    <tr>
      <td><?php if ($pageNum_RecordSetBill > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RecordSetBill=%d%s", $currentPage, 0, $queryString_RecordSetBill); ?>">First</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_RecordSetBill > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RecordSetBill=%d%s", $currentPage, max(0, $pageNum_RecordSetBill - 1), $queryString_RecordSetBill); ?>">Previous</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_RecordSetBill < $totalPages_RecordSetBill) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RecordSetBill=%d%s", $currentPage, min($totalPages_RecordSetBill, $pageNum_RecordSetBill + 1), $queryString_RecordSetBill); ?>">Next</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_RecordSetBill < $totalPages_RecordSetBill) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RecordSetBill=%d%s", $currentPage, $totalPages_RecordSetBill, $queryString_RecordSetBill); ?>">Last</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
Records <?php echo ($startRow_RecordSetBill + 1) ?> to <?php echo min($startRow_RecordSetBill + $maxRows_RecordSetBill, $totalRows_RecordSetBill) ?> of <?php echo $totalRows_RecordSetBill ?></div>
       

 	</div>
 	</div>
</body>
</html>
<?php
mysql_free_result($RecordSetBill);
?>
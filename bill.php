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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO billstransaction (billtransactiondate, billtrasactionamount, billtrasactionstatus, billID) VALUES ( %s, %s, %s, %s)",
                       GetSQLValueString($_POST['billtransactiondate'], "date"),
                       GetSQLValueString($_POST['billtrasactionamount'], "int"),
                       GetSQLValueString($_POST['billtrasactionstatus'], "text"),
                       GetSQLValueString($_POST['billID'], "int"));

  mysql_select_db($database_expenceconn, $expenceconn);
  $Result1 = mysql_query($insertSQL, $expenceconn) or die(mysql_error());
}

$maxRows_RecordSetBillTransaction = 5;
$pageNum_RecordSetBillTransaction = 0;
if (isset($_GET['pageNum_RecordSetBillTransaction'])) {
  $pageNum_RecordSetBillTransaction = $_GET['pageNum_RecordSetBillTransaction'];
}
$startRow_RecordSetBillTransaction = $pageNum_RecordSetBillTransaction * $maxRows_RecordSetBillTransaction;

mysql_select_db($database_expenceconn, $expenceconn);
$query_RecordSetBillTransaction = "SELECT bills.billname, billstransaction.billtransactionID, billstransaction.billtransactiondate, billstransaction.billtrasactionamount, billstransaction.billtrasactionstatus, billstransaction.billID FROM billstransaction, bills WHERE bills.billID  =  billstransaction.billID  ORDER BY  billstransaction.billtransactiondate DESC";
$query_limit_RecordSetBillTransaction = sprintf("%s LIMIT %d, %d", $query_RecordSetBillTransaction, $startRow_RecordSetBillTransaction, $maxRows_RecordSetBillTransaction);
$RecordSetBillTransaction = mysql_query($query_limit_RecordSetBillTransaction, $expenceconn) or die(mysql_error());
$row_RecordSetBillTransaction = mysql_fetch_assoc($RecordSetBillTransaction);

if (isset($_GET['totalRows_RecordSetBillTransaction'])) {
  $totalRows_RecordSetBillTransaction = $_GET['totalRows_RecordSetBillTransaction'];
} else {
  $all_RecordSetBillTransaction = mysql_query($query_RecordSetBillTransaction);
  $totalRows_RecordSetBillTransaction = mysql_num_rows($all_RecordSetBillTransaction);
}
$totalPages_RecordSetBillTransaction = ceil($totalRows_RecordSetBillTransaction/$maxRows_RecordSetBillTransaction)-1;


// TOTAL AMOUNT 
mysql_select_db($database_expenceconn, $expenceconn);
$query_RecordsetTransAmount = "SELECT SUM(billstransaction.billtrasactionamount) AS AMOUNT FROM billstransaction";
$RecordsetTransAmount = mysql_query($query_RecordsetTransAmount, $expenceconn) or die(mysql_error());
$row_RecordsetTransAmount = mysql_fetch_assoc($RecordsetTransAmount);
$totalRows_RecordsetTransAmount = mysql_num_rows($RecordsetTransAmount);



mysql_select_db($database_expenceconn, $expenceconn);
$query_cmbBills = "SELECT bills.billID, bills.billname FROM bills WHERE bills.pid = '{$currentUser}' ";
$cmbBills = mysql_query($query_cmbBills, $expenceconn) or die(mysql_error());
$row_cmbBills = mysql_fetch_assoc($cmbBills);
$totalRows_cmbBills = mysql_num_rows($cmbBills);


//END OF TOTAL AMOUNT

$queryString_RecordSetBillTransaction = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordSetBillTransaction") == false && 
        stristr($param, "totalRows_RecordSetBillTransaction") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordSetBillTransaction = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordSetBillTransaction = sprintf("&totalRows_RecordSetBillTransaction=%d%s", $totalRows_RecordSetBillTransaction, $queryString_RecordSetBillTransaction);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>bills</title>
	<link rel="stylesheet" type="text/css" href="styles/banner.css">
	<link rel="stylesheet" type="text/css" href="styles/bill.css">
	<link rel="stylesheet" type="text/css" href="styles/popuptransaction.css">
</head>
<body>
		<div class="mybody">
	<div class="banner">
		<table>
 			<tr>
 				<td>
          <a href="dashboard.php">
            
            <label class="largeText">My Expense</label>
          </a>
 					
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
 					<label class="largeText dodgerblueText">Manage your bills  <span>
 							
 					</span></label> &nbsp;</center>
 					</div>
<hr style="color: dodgerblue;">
 					<div>
 						<center>
 						<input type="submit" name="" value="Add bills/View bills" class="mybutton" id="calladdbills"><br><br>
 					</center>
 				</div>



 			
 	</div>


 	<div class="scroll-table mybody">
 	<div class="table-holder">
 		<div class="table-caption">
 			<label class="largeText brownText">Recent Bills  Transactions : <span class="dodgerblueText">
 			<?php echo $row_RecordsetTransAmount['AMOUNT']; ?>
 			</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 			<input type="button" name="" class="editbutton" value="Add new transaction" id="callbilltransaction">
 			
 		</div>
 		<table>
 			<thead>
 				<tr>
 					<th>Transaction ID</th>
 					<th>Bill Name</th>
 					<th>Date/Time</th>
 					<th>Amount</th>
 					<th>Status</th>
 					<th>Action</th>
 				</tr>
 			</thead>
 			<tbody>
 			  <?php do { ?>
      <tr>
      	<td><?php echo $row_RecordSetBillTransaction['billtransactionID']; ?>&nbsp; </td>
        <td><?php echo $row_RecordSetBillTransaction['billname']; ?></td>
        <td><?php echo $row_RecordSetBillTransaction['billtransactiondate']; ?>&nbsp; </td>
        <td><?php echo $row_RecordSetBillTransaction['billtrasactionamount']; ?>&nbsp; </td>
        <td><?php echo $row_RecordSetBillTransaction['billtrasactionstatus']; ?>&nbsp; </td>
      </tr>
      <?php } while ($row_RecordSetBillTransaction = mysql_fetch_assoc($RecordSetBillTransaction)); ?>
    
 			</tbody>
 		</table>
 	</div>
 	</div>
</div>
 	<!-- popup form for transaction -->
 		<div class="scroll-analysis">
 
 		<div class="analysis-holder">
	
	<label class="analytic-titel">null</label>
	<label class="myfloatbutton" id="btnclosetransaction" ><span>X</span></label>
	<br>
	<hr>
	<div >
 		<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td><input type="date" name="billtransactiondate" value="" size="32" class="myinputtext" /></td>
    </tr>
    <tr valign="baseline">
      <td><input type="text" name="billtrasactionamount" value="" size="32" class="myinputtext" placeholder="amount" /></td>
    </tr>
    <tr valign="baseline">
      <td><input type="text" name="billtrasactionstatus" value="" size="32" class="myinputtext" placeholder="status" /></td>
    </tr>
    <tr valign="baseline">
      <td><select  name="billID" class="myoption">
         <?php
do {  
?>
         <option value="<?php echo $row_cmbBills['billID']?>"<?php if (!(strcmp($row_cmbBills['billID'], $row_cmbBills['billID']))) {echo "selected=\"selected\"";} ?>><?php echo $row_cmbBills['billname']?></option>
         <?php
} while ($row_cmbBills = mysql_fetch_assoc($cmbBills));
  $rows = mysql_num_rows($cmbBills);
  if($rows > 0) {
      mysql_data_seek($cmbBills, 0);
    $row_cmbBills = mysql_fetch_assoc($cmbBills);
  }
?>
       </select>
     </td>
    </tr>
    <tr valign="baseline">
      <td><center><input type="submit" value="Add new Transaction" class="mybutton" /></center></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
	</div>
	
	</div>
</div>

 		<script type="text/javascript">
let popuptransaction = document.querySelector('.scroll-analysis');
let closeanalysis = document.getElementById('btnclosetransaction');
let blurbody = document.querySelector('.mybody');
let analyticTitel = document.querySelector('.analytic-titel');


 		let calladdbills = document.getElementById('calladdbills');
 		calladdbills.addEventListener('click' , () =>{
 			location.href = "adbill.php";

 		})


 		let calltransaction = document.getElementById('callbilltransaction');
 		calltransaction.addEventListener('click' , () =>{
 			openTransaction("Bills Transaction");

 		});

 			function openTransaction(unit) {
  // body...
  popuptransaction.style.display = "block";
  blurbody.style.opacity = "0.2";
  analyticTitel.innerHTML = unit ;
}
function closeanalytic() {
  // body...
  popuptransaction.style.display = "none";
  blurbody.style.opacity = "1";
}

closeanalysis.addEventListener('click' , () =>{
 closeanalytic();
})
 	</script>
</body>
</html>
<?php
mysql_free_result($RecordSetBillTransaction);
mysql_free_result($RecordsetTransAmount);
mysql_free_result($cmbBills);
?>

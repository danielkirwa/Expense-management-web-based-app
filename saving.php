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
  $insertSQL = sprintf("INSERT INTO savingtransaction (savingtransactionid, savingtransactiondat, savingtransactionamount, savingtransactionsatus, savingID) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['savingtransactionid'], "int"),
                       GetSQLValueString($_POST['savingtransactiondat'], "date"),
                       GetSQLValueString($_POST['savingtransactionamount'], "text"),
                       GetSQLValueString($_POST['savingtransactionsatus'], "text"),
                       GetSQLValueString($_POST['savingID'], "int"));

  mysql_select_db($database_expenceconn, $expenceconn);
  $Result1 = mysql_query($insertSQL, $expenceconn) or die(mysql_error());
}

$maxRows_RecordsetSavingTransaction = 5;
$pageNum_RecordsetSavingTransaction = 0;
if (isset($_GET['pageNum_RecordsetSavingTransaction'])) {
  $pageNum_RecordsetSavingTransaction = $_GET['pageNum_RecordsetSavingTransaction'];
}
$startRow_RecordsetSavingTransaction = $pageNum_RecordsetSavingTransaction * $maxRows_RecordsetSavingTransaction;

mysql_select_db($database_expenceconn, $expenceconn);
$query_RecordsetSavingTransaction = "SELECT savings.savingname, savingtransaction.savingtransactiondat, savingtransaction.savingtransactionamount, savingtransaction.savingtransactionsatus, savingtransaction.savingID FROM savings, savingtransaction WHERE savingtransaction.savingID = savings.savingID ";
$query_limit_RecordsetSavingTransaction = sprintf("%s LIMIT %d, %d", $query_RecordsetSavingTransaction, $startRow_RecordsetSavingTransaction, $maxRows_RecordsetSavingTransaction);
$RecordsetSavingTransaction = mysql_query($query_limit_RecordsetSavingTransaction, $expenceconn) or die(mysql_error());
$row_RecordsetSavingTransaction = mysql_fetch_assoc($RecordsetSavingTransaction);

if (isset($_GET['totalRows_RecordsetSavingTransaction'])) {
  $totalRows_RecordsetSavingTransaction = $_GET['totalRows_RecordsetSavingTransaction'];
} else {
  $all_RecordsetSavingTransaction = mysql_query($query_RecordsetSavingTransaction);
  $totalRows_RecordsetSavingTransaction = mysql_num_rows($all_RecordsetSavingTransaction);
}
$totalPages_RecordsetSavingTransaction = ceil($totalRows_RecordsetSavingTransaction/$maxRows_RecordsetSavingTransaction)-1;

mysql_select_db($database_expenceconn, $expenceconn);
$query_RecordsetSumSaving = "SELECT SUM(savingtransaction.savingtransactionamount) AS TOTALSAVING FROM savingtransaction";
$RecordsetSumSaving = mysql_query($query_RecordsetSumSaving, $expenceconn) or die(mysql_error());
$row_RecordsetSumSaving = mysql_fetch_assoc($RecordsetSumSaving);
$totalRows_RecordsetSumSaving = mysql_num_rows($RecordsetSumSaving);
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>saving</title>
	<link rel="stylesheet" type="text/css" href="styles/banner.css">
	<link rel="stylesheet" type="text/css" href="styles/shopping.css">
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
 					<img src="assets/totalspent.png" width="75px" class="accountAvertor">
 				</td>
 				
 			</tr>
 		</table>
	</div>
	<br>
	<center>
		<h2 class="dodgerblueText">Your saving manager</h2>
	</center>

		

 	<div class="main-saving"> 
 		
 		
 			
 				<div class="smallmargintop">
 					<center><img src="assets/savings.png" width="75px"></center>
 				</div>
 				<div class="smallmargintop">
 					<center>
 					<label class="largeText dodgerblueText">Manage your savings  <span></span></label> &nbsp;</center>
 					</div>
<hr style="color: dodgerblue;">
 					<div>
 						<center>
 						<input type="submit" name="" value="Add savings/View savings" class="mybutton" id="calladdsaving"><br><br>
 				</center>
 				</div>



 			
 	</div>


 	<div class="scroll-table">
 	<div class="table-holder">
 		<div class="table-caption">
 			<label class="largeText brownText">Recent Saving  Transactions : <span><?php echo $row_RecordsetSumSaving['TOTALSAVING']; ?></span></label>
 			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 			<input type="submit" name="" class="editbutton" value="Add new transaction" id="callsavingtransaction">
 		</div>
 		<table>
 			<thead>
 				<tr>
 					<th>Date/Time</th>
 					<th>Transaction</th>
 					<th>Anount</th>
 					<th>Satus</th>
 					<th>Action</th>
 				</tr>
 			</thead>
 			<tbody>
 				<?php do { ?>
      <tr>
      	<td><?php echo $row_RecordsetSavingTransaction['savingtransactiondat']; ?></td>
        <td><?php echo $row_RecordsetSavingTransaction['savingname']; ?></td>
        <td><?php echo $row_RecordsetSavingTransaction['savingtransactionamount']; ?></td>
        <td><?php echo $row_RecordsetSavingTransaction['savingtransactionsatus']; ?></td>
        
      </tr>
      <?php } while ($row_RecordsetSavingTransaction = mysql_fetch_assoc($RecordsetSavingTransaction)); ?>
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
<!-- transaction form -->
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td><input type="text" name="savingtransactionid" value="" size="32" class="myinputtext" placeholder="Transaction ID" /></td>
    </tr>
    <tr valign="baseline">
      <td><input type="date" name="savingtransactiondat" value="" size="32" class="myinputtext"  /></td>
    </tr>
    <tr valign="baseline">
      <td><input type="text" name="savingtransactionamount" value="" size="32" class="myinputtext" placeholder="amount" /></td>
    </tr>
    <tr valign="baseline">
      <td><input type="text" name="savingtransactionsatus" value="" size="32" class="myinputtext" placeholder="Status" /></td>
    </tr>
    <tr valign="baseline">
      <td><input type="text" name="savingID" value="" size="32" class="myinputtext" placeholder="Saving ID" /></td>
    </tr>
    <tr valign="baseline">
      <td><input type="submit" value="Add new Transaction" class="mybutton" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
	
	</div>
</div>


 		<script type="text/javascript">
let popuptransaction = document.querySelector('.scroll-analysis');
let closeanalysis = document.getElementById('btnclosetransaction');
let blurbody = document.querySelector('.mybody');
let analyticTitel = document.querySelector('.analytic-titel');


 		let callsaving = document.getElementById('calladdsaving');
 		callsaving.addEventListener('click' , () =>{
 			location.href = "adsaving.php";
 		})

 		let calltransaction = document.getElementById('callsavingtransaction');
 		calltransaction.addEventListener('click' , () =>{
 			openTransaction("Saving Transaction");

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
mysql_free_result($RecordsetSavingTransaction);
mysql_free_result($RecordsetSumSaving);
?>
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
  $insertSQL = sprintf("INSERT INTO shoppingtransaction (shoppingtransactionamount, shoppingtransactiondate, status, shoppingID) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['shoppingtransactionamount'], "int"),
                       GetSQLValueString($_POST['shoppingtransactiondate'], "date"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['shoppingID'], "int"));

  mysql_select_db($database_expenceconn, $expenceconn);
  $Result1 = mysql_query($insertSQL, $expenceconn) or die(mysql_error());
}

$maxRows_RecordSetShoppingTransaction = 5;
$pageNum_RecordSetShoppingTransaction = 0;
if (isset($_GET['pageNum_RecordSetShoppingTransaction'])) {
  $pageNum_RecordSetShoppingTransaction = $_GET['pageNum_RecordSetShoppingTransaction'];
}
$startRow_RecordSetShoppingTransaction = $pageNum_RecordSetShoppingTransaction * $maxRows_RecordSetShoppingTransaction;

mysql_select_db($database_expenceconn, $expenceconn);
$query_RecordSetShoppingTransaction = "SELECT shopping.shoppingname, shoppingtransaction.shoppingtransactionID, shoppingtransaction.shoppingtransactionamount, shoppingtransaction.shoppingtransactiondate, shoppingtransaction.status, shoppingtransaction.shoppingID FROM shopping, shoppingtransaction WHERE shopping.shoppingID = shoppingtransaction.shoppingID";
$query_limit_RecordSetShoppingTransaction = sprintf("%s LIMIT %d, %d", $query_RecordSetShoppingTransaction, $startRow_RecordSetShoppingTransaction, $maxRows_RecordSetShoppingTransaction);
$RecordSetShoppingTransaction = mysql_query($query_limit_RecordSetShoppingTransaction, $expenceconn) or die(mysql_error());
$row_RecordSetShoppingTransaction = mysql_fetch_assoc($RecordSetShoppingTransaction);

if (isset($_GET['totalRows_RecordSetShoppingTransaction'])) {
  $totalRows_RecordSetShoppingTransaction = $_GET['totalRows_RecordSetShoppingTransaction'];
} else {
  $all_RecordSetShoppingTransaction = mysql_query($query_RecordSetShoppingTransaction);
  $totalRows_RecordSetShoppingTransaction = mysql_num_rows($all_RecordSetShoppingTransaction);
}
$totalPages_RecordSetShoppingTransaction = ceil($totalRows_RecordSetShoppingTransaction/$maxRows_RecordSetShoppingTransaction)-1;

mysql_select_db($database_expenceconn, $expenceconn);
$query_RecordsetSumShoppingTrans = "SELECT SUM( shoppingtransaction.shoppingtransactionamount) AS TOTALAMOUNT FROM shoppingtransaction";
$RecordsetSumShoppingTrans = mysql_query($query_RecordsetSumShoppingTrans, $expenceconn) or die(mysql_error());
$row_RecordsetSumShoppingTrans = mysql_fetch_assoc($RecordsetSumShoppingTrans);
$totalRows_RecordsetSumShoppingTrans = mysql_num_rows($RecordsetSumShoppingTrans);


mysql_select_db($database_expenceconn, $expenceconn);
$query_cmbShopping = "SELECT shopping.shoppingID, shopping.shoppingname FROM shopping WHERE shopping.pid = 987456";
$cmbShopping = mysql_query($query_cmbShopping, $expenceconn) or die(mysql_error());
$row_cmbShopping = mysql_fetch_assoc($cmbShopping);
$totalRows_cmbShopping = mysql_num_rows($cmbShopping);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Shopping</title>
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
		<h2 class="dodgerblueText">Your shopping manager</h2>
	</center>

		

 	<div class="main-shopping"> 
 		
 		
 			
 				<div class="smallmargintop">
 					<center><img src="assets/shopping.png" width="75px"></center>
 				</div>
 				<div class="smallmargintop">
 					<center>
 					<label class="largeText dodgerblueText">Manage your shopping <span></span></label> &nbsp;</center>
 					</div>
<hr style="color: dodgerblue;">
 					<div>
 						<center>
 						<input type="submit" name="" value="Add shopping/View shopping" class="mybutton" id="calladdshopping"><br><br>
 					</center>
 				</div>



 			
 	</div>


 	<div class="scroll-table">
 	<div class="table-holder">
 		<div class="table-caption">
 			<label class="largeText brownText">Recent Shopping  Transactions : <span class="dodgerblueText">
 				<?php echo $row_RecordsetSumShoppingTrans['TOTALAMOUNT']; ?>
 			</span></label>
 			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 			<input type="submit" name="" class="editbutton" value="Add new transaction" id="callshoppingtransaction">
 			
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
 				</tr>
    <?php do { ?>
      <tr>
      	 <td><?php echo $row_RecordSetShoppingTransaction['shoppingtransactiondate']; ?></td>
        <td><?php echo $row_RecordSetShoppingTransaction['shoppingname']; ?></td>
        <td><?php echo $row_RecordSetShoppingTransaction['shoppingtransactionamount']; ?></td>
        <td><?php echo $row_RecordSetShoppingTransaction['status']; ?></td>
      </tr>
      <?php } while ($row_RecordSetShoppingTransaction = mysql_fetch_assoc($RecordSetShoppingTransaction)); ?>
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
	<!-- popup form for transaction form-->
	<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
     
      <tr valign="baseline">
        <td><input type="text" name="shoppingtransactionamount" value="" size="32" class="myinputtext" placeholder="Amount" /></td>
      </tr>
      <tr valign="baseline">
        <td><input type="date" name="shoppingtransactiondate" value="" size="32" class="myinputtext"  /></td>
      </tr>
      <tr valign="baseline">
        <td><input type="text" name="status" value="" size="32" class="myinputtext" placeholder="status" /></td>
      </tr>
      <tr valign="baseline">
        <td>
           <select name="shoppingID" class="myoption">
            <?php
do {  
?>
            <option value="<?php echo $row_cmbShopping['shoppingID']?>"<?php if (!(strcmp($row_cmbShopping['shoppingID'], $row_cmbShopping['shoppingID']))) {echo "selected=\"selected\"";} ?>><?php echo $row_cmbShopping['shoppingname']?></option>
            <?php
} while ($row_cmbShopping = mysql_fetch_assoc($cmbShopping));
  $rows = mysql_num_rows($cmbShopping);
  if($rows > 0) {
      mysql_data_seek($cmbShopping, 0);
    $row_cmbShopping = mysql_fetch_assoc($cmbShopping);
  }
?>
          </select>
        </td>
      </tr>
      <tr valign="baseline">
        <td><center><input type="submit" value="Add new transaction" class="mybutton" /></center></td>
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


 		let calladdshopping = document.getElementById('calladdshopping');
 		calladdshopping.addEventListener('click' , () =>{
 			location.href = "adshopping.php";
 		})
let calltransaction = document.getElementById('callshoppingtransaction');
 		calltransaction.addEventListener('click' , () =>{
 			openTransaction("Shopping Transaction");

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
mysql_free_result($RecordSetShoppingTransaction);
mysql_free_result($RecordsetSumShoppingTrans);
mysql_free_result($cmbShopping);
?>
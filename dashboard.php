<?php require_once('Connections/expenceconn.php'); ?>
<?php



// TOTAL AMOUNT BILL
mysql_select_db($database_expenceconn, $expenceconn);
$query_RecordsetTransAmount = "SELECT SUM(billstransaction.billtrasactionamount) AS AMOUNT FROM billstransaction";
$RecordsetTransAmount = mysql_query($query_RecordsetTransAmount, $expenceconn) or die(mysql_error());
$row_RecordsetTransAmount = mysql_fetch_assoc($RecordsetTransAmount);
$totalRows_RecordsetTransAmount = mysql_num_rows($RecordsetTransAmount);

//END OF TOTAL AMOUNT

// TOTAL AMOUNT SHOPPING
mysql_select_db($database_expenceconn, $expenceconn);
$query_RecordsetSumShoppingTrans = "SELECT SUM( shoppingtransaction.shoppingtransactionamount) AS TOTALAMOUNT FROM shoppingtransaction";
$RecordsetSumShoppingTrans = mysql_query($query_RecordsetSumShoppingTrans, $expenceconn) or die(mysql_error());
$row_RecordsetSumShoppingTrans = mysql_fetch_assoc($RecordsetSumShoppingTrans);
$totalRows_RecordsetSumShoppingTrans = mysql_num_rows($RecordsetSumShoppingTrans);
// END OF SHOPPING

// TOTAL AMOUNT SAVINGS
mysql_select_db($database_expenceconn, $expenceconn);
$query_RecordsetSumSaving = "SELECT SUM(savingtransaction.savingtransactionamount) AS TOTALSAVING FROM savingtransaction";
$RecordsetSumSaving = mysql_query($query_RecordsetSumSaving, $expenceconn) or die(mysql_error());
$row_RecordsetSumSaving = mysql_fetch_assoc($RecordsetSumSaving);
$totalRows_RecordsetSumSaving = mysql_num_rows($RecordsetSumSaving);

// END OF SAVING
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My account</title>
	<link rel="stylesheet" type="text/css" href="styles/dashboard.css">
	<link rel="stylesheet" type="text/css" href="styles/banner.css">
	
</head>
<body>
	<div class="banner">
		<table>
 			<tr>
 				<td>
 					<label class="largeText">My Expence</label>
 				</td>
 				<td>
 					<img src="assets/totalspent.png" width="75px" class="accountAvertor">
 				</td>
 				
 			</tr>
 		</table>
	</div>
	<br>
<section class="main-dashboard">
 	<div class="main-totalusers"> 
 		
 		<table id="totalusers">
 			<tr>
 				<td>
 					<img src="assets/totalspent.png" width="75px">
 				</td>
 				<td>
 					<label class="largeText dodgerblueText">Your Total Expense : <span>
 <?php echo 0.0 +$row_RecordsetTransAmount['AMOUNT'] + $row_RecordsetSumShoppingTrans['TOTALAMOUNT'] + $row_RecordsetSumSaving['TOTALSAVING']; ?>
 					</span></label>
 				</td>
 			</tr>
 		</table>
 	</div>
 	<div class="enrolls-holder">
 		<div class="enroll-card  hoverme" id="billsbtn">
 			
 		<table>
 			<tr>
 				<td>
 					<img src="assets/expence.png" width="75px">
 				</td>
 				<td>
 					<label class="smallText dodgerblueText">Bills : <span>
 						<?php echo 0.0 + $row_RecordsetTransAmount['AMOUNT']; ?>
 					</span></label>
 				</td>
 			</tr>
 		</table>
 		</div>
 		<div class="enroll-card hoverme" id="shoppingbtn">
 			<table>
 			<tr>
 				<td>
 					<img src="assets/shopping.png" width="75px">
 				</td>
 				<td>
 					<label class="smallText dodgerblueText">Shopping : <span>
 						<?php echo 0.0 + $row_RecordsetSumShoppingTrans['TOTALAMOUNT']; ?>
 					</span></label>
 				</td>
 			</tr>
 		</table>
 		</div>
 		<div class="enroll-card hoverme" id="savingbtn">
 			<table>
 			<tr>
 				<td>
 					<img src="assets/savings.png" width="75px">
 				</td>
 				<td>
 					<label class="smallText dodgerblueText">Savings : <span>
 						<?php echo 0.0 + $row_RecordsetSumSaving['TOTALSAVING']; ?>
 					</span></label>
 				</td>
 			</tr>
 		</table>
 		</div>
 		<div class="enroll-card hoverme" id="emergencybtn">
 			<table>
 			<tr>
 				<td>
 					<img src="assets/emergency.png" width="75px">
 				</td>
 				<td>
 					<label class="smallText dodgerblueText">Emergency : <span>0.0</span></label>
 				</td>
 			</tr>
 		</table>
 		</div>
 	</div>
 	<div class="scroll-table">
 	<div class="table-holder">
 		<div class="table-caption">
 			<label class="largeText brownText">Recent Transactions  <span></span></label>
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
 				<tr>
 					<td>12/12/2020</td>
 					<td>Shopping</td>
 					<td>4500</td>
 					<td>Complete</td>
 					<td>Action</td>
 				</tr>
 				<tr>
 					<td>10/10/2020</td>
 					<td>Electric Bill</td>
 					<td>2500</td>
 					<td>Complete</td>
 					<td>Action</td>
 				</tr>
 			</tbody>
 		</table>
 	</div>
 	</div>
 	
 </section>


</body>
<script type="text/javascript" src="javascript/mainformpopup.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</html>
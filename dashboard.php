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
	<link rel="stylesheet" type="text/css" href="styles/popupanalysis.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
 <meta name="totalExpense" content="<?php echo 0.0 +$row_RecordsetTransAmount['AMOUNT'] + $row_RecordsetSumShoppingTrans['TOTALAMOUNT'] + $row_RecordsetSumSaving['TOTALSAVING']; ?>">
<meta name="billExpense" content="<?php echo 0.0 + $row_RecordsetTransAmount['AMOUNT']; ?>">
<meta name="shoppingExpense" content="<?php echo 0.0 + $row_RecordsetSumShoppingTrans['TOTALAMOUNT']; ?>">
<meta name="savingExpense" content="<?php echo 0.0 + $row_RecordsetSumSaving['TOTALSAVING']; ?>">

</head>
<body>
	<div class="banner">
		<table>
 			<tr>
 				<td>
 					<label class="largeText">My Expense</label>
 				</td>
 				<td>
 					<img src="assets/totalspent.png" width="75px" class="accountAvertor">
 				</td>
 				
 			</tr>
 		</table>
	</div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <!-- <a class="navbar-brand" href="#">Username</a> -->

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['username'] ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="userprofile.php">Profile</a></li>
            <li><a class="dropdown-item" href="usermanual.php">User manual</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </li>

        
      </ul>
 
    </div>
  </div>
</nav>
<br><br>


<section class="main-dashboard">
 	<div class="main-totalusers"> 
 		
 		<table id="totalusers">
 			<tr>
 				<td>
 					<img src="assets/totalspent.png" width="75px">
 				</td>
 				<td>
 					<label class="largeText dodgerblueText">Your Total Expense : <span id="totalExpense">
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
 					<label class="smallText dodgerblueText">Bills : <span id="billExpense">
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
 					<label class="smallText dodgerblueText">Shopping : <span id="shoppingExpense">
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
 					<label class="smallText dodgerblueText">Savings : <span id="savingExpense">
 						<?php echo 0.0 + $row_RecordsetSumSaving['TOTALSAVING']; ?>
 					</span></label>
 				</td>
 			</tr>
 		</table>
 		</div>
 	</div>

 	
 </section>
 <hr>
 <center><label class="largeText dodgerblueText">Expense Analysis</label></center>
 <hr>
 <div class="analysis-div">
 	<!-- POP UP UNIT ANALYSIS -->
  <div class="scroll-analysis">
 
    <div class="analysis-holder">
  <label class="analytic-titel">Visual report expense manager</label>
  <hr>
  <div class="report-holder">
    <div class="report-card">
      
   <label>BILLS: <span>null</span></label><br>
   <canvas id="graphallcases" width="50%"></canvas>
    </div>
    <div class="report-card-long">
      
   <label>SHOPPING <span>null</span></label><br>
   <canvas id="barGraphResults" width="50%"></canvas>
    </div>
    <div class="report-card-long">
      
   <label>SAVINGS <span>null</span></label><br>
   <canvas id="barGraphResults" width="50%"></canvas>
    </div>
    <div class="report-card-longer">
      
   <label>GENERAL INFORMATION </label><br>
    <canvas id="barGraphUnitReport" width="50%"></canvas>
   
    </div>
  </div>
  
  </div>
</div>

<!-- end of grahp -->
 	
 </div>


</body>
<script type="text/javascript" src="javascript/mainformpopup.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript" src="javascript/analysis.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>
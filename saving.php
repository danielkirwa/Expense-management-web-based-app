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
 					<label class="largeText">My Expense saving</label>
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
 					<label class="largeText dodgerblueText">Manage your savings : <span>null</span></label> &nbsp;</center>
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
 			<label class="largeText brownText">Recent Shopping  Transactions : <span>null</span></label>
 			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 			<input type="submit" name="" class="editbutton" value="Add new transaction" id="callbilltransaction">
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
</div>
 	<!-- popup form for transaction -->
 		<div class="scroll-analysis">
 
 		<div class="analysis-holder">
	
	<label class="analytic-titel">null</label>
	<label class="myfloatbutton" id="btnclosetransaction" ><span>X</span></label>
	<br>
	<hr>
	<div class="report-holder">
 		<div class="report-card">
 			
 	 <label>TOTAL ENROLLS : <span>null</span></label><br>
 	 <canvas id="pieChartEnrolls" width="50%"></canvas>
 		</div>
 		<div class="report-card-long">
 			
 	 <label>RESULTS </label><br>
 	 <canvas id="barGraphResults" width="50%"></canvas>
 		</div>
 		<div class="report-card-longer">
 			
 	 <label>GENERAL INFORMATION </label><br>
 	 <canvas id="barGraphUnitReport" width="50%"></canvas>
 		</div>
	</div>
	
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

 		let calltransaction = document.getElementById('callbilltransaction');
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
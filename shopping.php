<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Shopping</title>
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
 					<label class="largeText dodgerblueText">Manage your shopping : <span>null</span></label> &nbsp;</center>
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
 			<label class="largeText brownText">Recent Shopping  Transactions : <span>null</span></label>
 			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 			<input type="submit" name="" class="editbutton" value="Add new transaction">
 			
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

 	<script type="text/javascript">
 		let calladdshopping = document.getElementById('calladdshopping');
 		calladdshopping.addEventListener('click' , () =>{
 			location.href = "adshopping.php";
 		})


 	</script>
</body>
</html>
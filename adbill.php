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

?>

<!DOCTYPE html>
<html>
<head>
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
 					<th>Date/Time</th>
 					<th>Bill name</th>
 					<th>Bill Description</th>
 					<th>Action</th>
 				</tr>
 			</thead>
 			<tbody>
 				<tr>
 					<td>12/12/2020</td>
 					<td>Water bill</td>
 					<td>4500</td>
 				     <td><select class="myoption dodgerblueText">
                     	<option class="dodgerblueText">Edit bill</option>
                     	<option class="redText">Delete bill</option>
                     </select></td>
 				</tr>
 				<tr>
 					<td>10/10/2020</td>
 					<td>Electric Bill</td>
 					<td>2500</td>
                     <td><select class="myoption dodgerblueText">
                     	<option class="dodgerblueText">Edit bill</option>
                     	<option class="redText">Delete bill</option>
                     </select></td>
 				</tr>
 			</tbody>
 		</table>
 	</div>
 	</div>
</body>
</html>
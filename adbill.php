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
$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO bills (billname, billdescription, dateofadd, pid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['billname'], "text"),
                       GetSQLValueString($_POST['billdescription'], "text"),
                       GetSQLValueString($_POST['dateofadd'], "date"),
                       GetSQLValueString($_POST['pid'], "text"));

  mysql_select_db($database_expenceconn, $expenceconn);
 $Result1 = mysql_query($insertSQL, $expenceconn);
 if (mysql_errno($expenceconn) > 0) {
  // code...

    if(mysql_errno($expenceconn) == 1062){
      echo "<script>alert('duplicte');</script>";
    }else{
    print(mysql_errno($expenceconn) );

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
$query_RecordSetBill = "SELECT billID, billname, billdescription, dateofadd FROM bills WHERE pid = '{$currentUser}' ORDER BY dateofadd DESC";
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
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="banner">
		<table>
 			<tr>
 				<td>
 					 <a href="dashboard.php">
            
            <label class="largeText">My Personal Expense</label>
          </a>
 				</td>
 				<td>
 					<img src="assets/potrait.png" width="75px" class="accountAvertor">
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
	<center>
		<h2 class="dodgerblueText">Your bills manager</h2>
	</center>

		

 	<div class="main-bill"> 
 		
 		
 			
 				<div class="smallmargintop">
 					<center><img src="assets/expence.png" width="75px"></center>
 				</div>
 				<div class="smallmargintop">
 					<center>
 					<label class="largeText dodgerblueText">Total available bills : <span>
            <?php echo $totalRows_RecordSetBill ?>
          </span></label> &nbsp;</center>
 					</div>
<hr style="color: dodgerblue;">
 					



 			
 	</div>
 	<div>
 		
 		<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    
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
      
      <td style="padding-top: 24px;"><input type="text" name="pid" value="<?php echo $_SESSION['accountid'] ?>" size="32" class="myinputtext" placeholder="User id" /></td>
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
 			<label class="largeText brownText">Active Bills   </label>
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
</div>
       

 	</div>
 	</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php
mysql_free_result($RecordSetBill);
?>
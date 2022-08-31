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
$currentUser = $_SESSION['accountid'];
$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO savings (savingpurpose, savingtarget, savingdateoppened, savingdateclosed, savingname, pid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['savingpurpose'], "text"),
                       GetSQLValueString($_POST['savingtarget'], "text"),
                       GetSQLValueString($_POST['savingdateoppened'], "date"),
                       GetSQLValueString($_POST['savingdateclosed'], "date"),
                       GetSQLValueString($_POST['savingname'], "text"),
                       GetSQLValueString($_POST['pid'], "text"));

  mysql_select_db($database_expenceconn, $expenceconn);
  $Result1 = mysql_query($insertSQL, $expenceconn) or die(mysql_error());
}

$maxRows_RecordSetSaving = 10;
$pageNum_RecordSetSaving = 0;
if (isset($_GET['pageNum_RecordSetSaving'])) {
  $pageNum_RecordSetSaving = $_GET['pageNum_RecordSetSaving'];
}
$startRow_RecordSetSaving = $pageNum_RecordSetSaving * $maxRows_RecordSetSaving;

$colname_RecordSetSaving = "-1";
if (isset($_GET['pid'])) {
  $colname_RecordSetSaving = $_GET['pid'];
}
mysql_select_db($database_expenceconn, $expenceconn);
$query_RecordSetSaving = sprintf("SELECT savingID, savingpurpose, savingtarget, savingdateclosed, savingname FROM savings WHERE pid = '{$currentUser}' ORDER BY savingdateclosed ASC", GetSQLValueString($currentUser, "int"));
$query_limit_RecordSetSaving = sprintf("%s LIMIT %d, %d", $query_RecordSetSaving, $startRow_RecordSetSaving, $maxRows_RecordSetSaving);
$RecordSetSaving = mysql_query($query_limit_RecordSetSaving, $expenceconn) or die(mysql_error());
$row_RecordSetSaving = mysql_fetch_assoc($RecordSetSaving);

if (isset($_GET['totalRows_RecordSetSaving'])) {
  $totalRows_RecordSetSaving = $_GET['totalRows_RecordSetSaving'];
} else {
  $all_RecordSetSaving = mysql_query($query_RecordSetSaving);
  $totalRows_RecordSetSaving = mysql_num_rows($all_RecordSetSaving);
}
$totalPages_RecordSetSaving = ceil($totalRows_RecordSetSaving/$maxRows_RecordSetSaving)-1;

$queryString_RecordSetSaving = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordSetSaving") == false && 
        stristr($param, "totalRows_RecordSetSaving") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordSetSaving = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordSetSaving = sprintf("&totalRows_RecordSetSaving=%d%s", $totalRows_RecordSetSaving, $queryString_RecordSetSaving);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="utf-8">
	<title>add savings</title>
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
            
            <label class="largeText">My Expense</label>
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
		<h2 class="dodgerblueText">Your savings manager</h2>
	</center>

		

 	<div class="main-bill"> 
 		
 		
 			
 				<div class="smallmargintop">
 					<center><img src="assets/shopping.png" width="75px"></center>
 				</div>
 				<div class="smallmargintop">
 					<center>
 					<label class="largeText dodgerblueText">ALl saving : <span><?php echo $totalRows_RecordSetSaving ?></span></label> &nbsp;</center>
 					</div>
<hr style="color: dodgerblue;">	
 	</div>
 	<div>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="savingpurpose" value="" size="32"  class="myinputtext" placeholder="Description" /></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="savingtarget" value="" size="32"  class="myinputtext" placeholder="Target" /></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="date" name="savingdateoppened" value="" size="32"  class="myinputtext"/> <span class="largeText dodgerblueText">Open Date  </span></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="date" name="savingdateclosed" value="" size="32"  class="myinputtext"/>  <span class="largeText dodgerblueText">Close Date </span></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="savingname" value="" size="32"  class="myinputtext" placeholder="name" /></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><input type="text" name="pid" value="<?php echo $_SESSION['accountid'] ?>" size="32"  class="myinputtext" placeholder="pid" /></td>
    </tr>
    <tr valign="baseline">
      <td style="padding-top: 24px;"><center><input type="submit" value="Add Saving" class="mybutton" /></center></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
 	</div>


 	<div class="scroll-table">
 	<div class="table-holder">
 		<div class="table-caption">
 			<label class="largeText brownText">Active active saving   </label>
 		</div>
 		<table>
 			<thead>
 				<tr>
          <th>Savings ID</th>
          <th>Savings name</th>
          <th>Savings Description</th>
 					<th>Closing On</th>
 					<th>Target</th>
 					<th>Action</th>
 				</tr>
 			</thead>
 			<tbody>

 </tr>
    <?php do { ?>
      <tr>
        <td> <?php echo $row_RecordSetSaving['savingID']; ?>&nbsp;</td>
        <td><?php echo $row_RecordSetSaving['savingname']; ?>&nbsp; </td>
        <td><?php echo $row_RecordSetSaving['savingpurpose']; ?>&nbsp; </td>
        <td><?php echo $row_RecordSetSaving['savingdateclosed']; ?>&nbsp; </td>
        <td><?php echo $row_RecordSetSaving['savingtarget']; ?>&nbsp; </td>
      </tr>
      <?php } while ($row_RecordSetSaving = mysql_fetch_assoc($RecordSetSaving)); ?>
    </tbody>
 		</table>
 		
      <br />
  </div>
</div>
       
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php
mysql_free_result($RecordSetSaving);
?>
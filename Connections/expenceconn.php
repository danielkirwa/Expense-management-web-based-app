<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_expenceconn = "localhost";
$database_expenceconn = "expense_management";
$username_expenceconn = "root";
$password_expenceconn = "";
$expenceconn = mysql_pconnect($hostname_expenceconn, $username_expenceconn, $password_expenceconn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
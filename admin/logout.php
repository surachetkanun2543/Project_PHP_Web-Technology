<?php
session_start() ;
$_SESSION['logStatus'] = '' ;
header("location:login.php") ;
session_destroy();
exit ;

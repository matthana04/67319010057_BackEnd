<?php
include_once "inc/config.php";
session_destroy();
header("Location: index.php");
exit;
?>

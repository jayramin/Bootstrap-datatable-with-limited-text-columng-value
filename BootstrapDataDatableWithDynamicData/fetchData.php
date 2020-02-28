<?php
include_once('mymodel.php');
$Ob = new mymodel;
$UsersData = $Ob->SelectData('users');
echo json_encode($UsersData['Data']);
?>
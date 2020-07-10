<?php

include '../helper/include.php';

// csrf

if(!isset($_POST['csrf_token'])||$_SESSION['csrf_token']!=$_POST['csrf_token']){
    header("location: ".url('register'));
    return;
}

session_destroy();

header("location: ../login.php");
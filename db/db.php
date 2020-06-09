<?php
$HOST="localhost";
$USERNAME="root";
$PASSWORD="";
$DB_NAME="zunderzhat";
$PORT=3306;

$conn=new mysqli($HOST,$USERNAME,$PASSWORD,$DB_NAME,$PORT);

if($conn->connect_error){
    die("Connection Failed");
}

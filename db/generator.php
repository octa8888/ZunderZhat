<?php
include 'db.php';

$sql="create table user(
    id int primary key auto_increment,
    username varchar(100) unique,
    password varchar(100)
)";
$conn->query($sql);

$sql="create table global_message(
    id int primary key auto_increment,
    user_id int,
    message varchar(255),
    foreign_key (user_id) references user(id)
)";
$conn->query($sql);


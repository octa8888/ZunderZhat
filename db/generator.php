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
    foreign key (user_id) references user(id)
)";
$conn->query($sql);

$sql="create table private_message(
    id int primary key auto_increment,
    user_1 int,
    user_2 int,
    iv_key varchar(50),
    foreign key (user_1) references user(id)
    foreign key (user_2) references user(id)
)";
$conn->query($sql);


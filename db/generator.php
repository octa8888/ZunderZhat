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
    foreign key (user_1) references user(id),
    foreign key (user_2) references user(id)
)";
$conn->query($sql);

$sql="create table private_message_detail(
    id int primary key auto_increment,
    msg_id int,
    user_id int,
    message varchar(255),
    type varchar(10),
    foreign key (msg_id) references private_message(id),
    foreign key (user_id) references user(id)
)";
$conn->query($sql);

$sql="create table friend_request(
    id int primary key auto_increment,
    from_id int,
    to_id int,
    foreign key (from_id) references user(id),
    foreign key (to_id) references user(id)
)";
$conn->query($sql);

header("location: index");
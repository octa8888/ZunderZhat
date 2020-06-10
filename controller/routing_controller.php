<?php

class RoutingController{
    public function index(){
        include 'index.php';
    }
    public function generator(){
        include 'db/generator.php';
    }

    public function login(){
        include 'auth/login.php';
    }

    public function register(){
        include 'auth/register.php';
    }
    public function private(){
        include 'private.php';
    }
    public function friend(){
        include 'friend.php';
    }
    public function private_chat(){
        include 'private_chat.php';
    }
}
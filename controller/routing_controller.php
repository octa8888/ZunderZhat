<?php

class RoutingController{
    public function index(){
        include 'index.php';
    }

    public function login(){
        include 'auth/login.php';
    }

    public function register(){
        include 'auth/register.php';
    }
}
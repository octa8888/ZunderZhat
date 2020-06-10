<?php

$url_arr=explode('/',$_SERVER['REQUEST_URI']);

include('controller/routing_controller.php');

$controller=new RoutingController();

$url=$url_arr[sizeof($url_arr)-1];
$url=explode('?',$url);
$url=$url[0];

if($url==''){
    $controller->index();
}
else if(method_exists($controller, $url)){
    $controller->$url();
}
else{
    $controller->index();
}
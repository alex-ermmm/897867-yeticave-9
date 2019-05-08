<?php 
$link = mysqli_connect("localhost", "root", "", "alexandr_yermakovich_yeticave");
mysqli_set_charset($link, "utf8");

$is_auth = rand(0, 1);
$user_name = 'Александр';  
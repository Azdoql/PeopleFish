<?php
session_start();
$this->assign('userName', $_SESSION['user_name']);
$this->display();
?>
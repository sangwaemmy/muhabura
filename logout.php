<?php
session_start();
unset($_SESSION['login_token']);
session_destroy();
header('location:index.php');



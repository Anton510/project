<?php

session_start();
session_destroy();
setcookie("remember", $email, time() - 3600, '/');
header('Location: /index.php');
exit;
?>
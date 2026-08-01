<?php
include_once __DIR__ . '/../files/connection.php';
session_unset();
session_destroy();
header('Location: login.php');
exit;

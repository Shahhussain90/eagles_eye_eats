<?php
// Change this depending on environment
define('BASE_URL', 'http://localhost/eagles_eye_eats/');
// Example live:
// define('BASE_URL', 'https://yourdomain.com/');


// Database connection settingsmysql
$con = mysqli_connect('localhost', 'root', '', 'eagles_eye_eats_db');

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}   








?>
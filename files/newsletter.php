<?php

include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($con, $_POST['email']);

    // safer fallback
    $return_url = $_POST['return_url'] ?? $_SERVER['HTTP_REFERER'] ?? '/';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: " . $return_url . "?error=invalid_email");
        exit;
    }

    // check duplicate
    $check = mysqli_query($con, "SELECT id FROM newsletter_subscribers WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        header("Location: " . $return_url . "?status=already_subscribed");
        exit;
    }

    // insert
    $query = "INSERT INTO newsletter_subscribers (email) VALUES ('$email')";
    mysqli_query($con, $query);

    // redirect back
    header("Location: " . $return_url . "?status=subscribed");
    exit;
}
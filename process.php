<?php
session_start();

$username = $_POST['username'];
$role = $_POST['role'];



$_SESSION['role'] = $role;

if ($role == 'guest') {
    header("Location: wizytowka.html");
} else if ($role == 'user') {
    header("Location: logownie.html");
}
exit();
?>
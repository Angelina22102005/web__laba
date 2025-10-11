<?php
session_start();

$username = htmlspecialchars($_POST['username'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');

$_SESSION['username'] = $username;
$_SESSION['email'] = $email;

$line = $username . "|" . $email . "\n";
file_put_contents("data.txt", $line, FILE_APPEND);

header("Location: index.php");
exit();
?>
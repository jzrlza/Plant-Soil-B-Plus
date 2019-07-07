<?php
require "conn.php";
$user_name = $_POST["username"];
$user_pass = $_POST["password"];
//echo $user_name;
//echo $user_pass;
$stmt = $conn->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
$stmt->bind_param('ss', $user_name, $user_pass); // 's' specifies the variable type => 'string'

$stmt->execute();

$result = $stmt->get_result();

if (mysqli_num_rows($result) > 0) {
	echo "Logged in";
} else {
	echo "Login failed";
}

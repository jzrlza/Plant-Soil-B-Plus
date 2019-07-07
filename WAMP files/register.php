<?php
require "conn.php";
$user_name = $_POST["username"];
$user_pass = $_POST["password"];
$user_pass_confirm = $_POST["passwordconfirm"];

$ok = true;
$msg = "Unknown Error";

//echo $user_name;
//echo $user_pass;

if ($user_pass != $user_pass_confirm) {
	$ok = false;
    $msg = "Password Mismatch";
}

if ($ok){
	$stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
	$stmt->bind_param('s', $user_name); // 's' specifies the variable type => 'string'

	$stmt->execute();

	$result = $stmt->get_result();
	while ($row = $result->fetch_array(MYSQLI_NUM)) {
	     if ($user_name == $row[1]) {
	     	$ok = false;
	     	$msg = "Username already exists";
	     }
	}
}



if ($ok){
	$stmt = $conn->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->bind_param('ss', $user_name, $user_pass); // 's' specifies the variable type => 'string'

    $stmt->execute();
}

$stmt = $conn->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
$stmt->bind_param('ss', $user_name, $user_pass); // 's' specifies the variable type => 'string'

$stmt->execute();

$result = $stmt->get_result();

if (mysqli_num_rows($result) == 1 && $ok) {
	echo "Register successful";
} else {
	echo "Register failed: ".$msg;
}

<?php
// this code is from lecture 16 PHP&SQL part
function connect(){
	$host = '';
	$dbname = '';
	$user = '';
	$pwd = '';
	try {
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	} catch (PDOException $e) {
		echo "PDOException: ".$e->getMessage();
	}
} 
?>
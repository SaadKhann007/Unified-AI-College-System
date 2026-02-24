<?php
$host = "localhost";
$dbname = "college_portal";
$user = "root";
$pass = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo json_encode(["status"=>"error","message"=>"DB Connection failed"]);
    exit;
}
?>

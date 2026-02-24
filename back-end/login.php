<?php
session_start();
include "db.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id=? AND role=?");
    $stmt->execute([$user_id, $role]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role;
        echo json_encode(["status"=> "success"]);
    } else {
        echo json_encode(["status"=> "error","message"=>"Invalid credentials"]);
    }
}
?>

<?php
session_start();
include "db.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $message = $_POST['message'];
    $stmt = $conn->prepare("INSERT INTO announcements(message) VALUES(?)");
    $stmt->execute([$message]);
    echo json_encode(["status"=>"success"]);
} else {
    
    $stmt = $conn->query("SELECT * FROM announcements ORDER BY date_created DESC");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}
?>

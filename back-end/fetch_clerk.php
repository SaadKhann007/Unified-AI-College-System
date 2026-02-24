<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "clerk"){
    echo json_encode(["status"=>"error","message"=>"Unauthorized"]);
    exit;
}


$announcements = $conn->query("SELECT * FROM announcements ORDER BY date_created DESC")->fetchAll(PDO::FETCH_ASSOC);
$complaints = $conn->query("SELECT * FROM complaints ORDER BY date_created DESC")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "announcements"=>$announcements,
    "complaints"=>$complaints
]);
?>

<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "principal"){
    echo json_encode(["status"=>"error","message"=>"Unauthorized"]);
    exit;
}


$students = $conn->query("SELECT COUNT(*) as total_students FROM students")->fetch(PDO::FETCH_ASSOC);
$teachers = $conn->query("SELECT COUNT(*) as total_teachers FROM teachers")->fetch(PDO::FETCH_ASSOC);
$complaints = $conn->query("SELECT * FROM complaints ORDER BY date_created DESC")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "students"=>$students,
    "teachers"=>$teachers,
    "complaints"=>$complaints
]);
?>

<?php
session_start();
include "db.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $from_user = $_POST['from_user'];
    $type = $_POST['type'];
    $message = $_POST['message'];
    $stmt = $conn->prepare("INSERT INTO complaints(from_user,type,message) VALUES(?,?,?)");
    $stmt->execute([$from_user,$type,$message]);
    echo json_encode(["status"=>"success"]);
} elseif($_SERVER["REQUEST_METHOD"] == "PUT"){
    
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['id'];
    $status = $data['status'];
    $stmt = $conn->prepare("UPDATE complaints SET status=? WHERE id=?");
    $stmt->execute([$status,$id]);
    echo json_encode(["status"=>"success"]);
} else {
    
    $stmt = $conn->query("SELECT * FROM complaints ORDER BY date_created DESC");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}
?>

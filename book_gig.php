<?php
session_start();
include 'db.php';
if (!isset($_SESSION['userid'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gig_id = $_POST['gig_id'];
    $buyer_id = $_SESSION['userid'];
    $conn->query("INSERT INTO bookings (gig_id, buyer_id) VALUES ('$gig_id', '$buyer_id')");
    echo "<script>alert('Gig booked successfully!'); window.location.href='dashboard.php';</script>";
}
?>

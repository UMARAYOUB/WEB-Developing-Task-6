<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM jobs WHERE recruiter_id='$user_id'";
$result = $conn->query($sql);

$sql_all_jobs = "SELECT * FROM jobs";
$result_all_jobs = $conn->query($sql_all_jobs);
?>
<!DOCTYPE html>
<html lang="en">
<head

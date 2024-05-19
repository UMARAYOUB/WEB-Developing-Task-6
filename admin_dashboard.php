<?php
include('db.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET['approve'])) {
    $user_id = $_GET['approve'];
    $sql = "UPDATE users SET approved=1 WHERE id='$user_id'";
    $conn->query($sql);
    header("Location: admin_dashboard.php");
}

$sql = "SELECT * FROM users WHERE role='recruiter' AND approved=0";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>
    <nav>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </nav>
    <main>
        <h2>Pending Approvals</h2>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <?php echo $row['username']; ?> - <?php echo $row['email']; ?>
                    <a href="admin_dashboard.php?approve=<?php echo $row['id']; ?>">Approve</a>
                </li>
            <?php endwhile; ?>
        </ul>
    </main>
</body>
</html>

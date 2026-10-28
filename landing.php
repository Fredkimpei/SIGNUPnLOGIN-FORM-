<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landing Page</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .dashboard { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); text-align: center; width: 400px; }
        h1 { color: #333; }
        p { color: #666; }
        .logout-btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #dc3545; color: white; text-decoration: none; border-radius: 4px; }
        .logout-btn:hover { background: #c82333; }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['firstname'] . ' ' . $_SESSION['lastname']); ?>! 🎉</h1>
        <p>You have successfully logged into your portal</p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
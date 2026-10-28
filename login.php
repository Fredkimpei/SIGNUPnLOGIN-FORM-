<?php
include 'db.php';
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phonenumber = trim($_POST['phonenumber']);
    $password = $_POST['password'];

    if (!empty($phonenumber) && !empty($password)) {
        $stmt = $conn->prepare("SELECT ID, firstname, lastname, password FROM customers WHERE phonenumber = ?");
        $stmt->bind_param("i", $phonenumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $row['ID'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                
                header("Location: landing.php");
                exit();
            } else {
                $error = "Invalid phone number or password.";
            }
        } else {
            $error = "Invalid phone number or password.";
        }
        $stmt->close();
    } else {
        $error = "Please fill in all fields.";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 320px; }
        h2 { text-align: center; color: #333; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #28a745; border: none; color: white; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background: #218838; }
        .msg { text-align: center; font-size: 14px; margin-top: 10px; color: red; }
        p { text-align: center; font-size: 14px; }
        a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Login</h2>
        <?php if(!empty($error)) echo "<p class='msg'>$error</p>"; ?>
        <form method="POST" action="">
            <input type="number" name="phonenumber" placeholder="Phone Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
    </div>
</body>
</html>
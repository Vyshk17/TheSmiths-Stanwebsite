<?php
session_start(); 
$con = mysqli_connect("wp.kongu.edu", "24csef17", "24csef17", "24csef17");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); 
    $sql = "SELECT name, pass FROM band WHERE email = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['pass']; 
        if ($password === $stored_password) {
            $_SESSION['username'] = $row['name'];

            echo "Login successful! Redirecting...";
            header("refresh:1; url=index.html"); 
            exit();
        } else {
            echo " Incorrect password!";
        }
    } else {
        echo " User not found!";
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($con);
?>




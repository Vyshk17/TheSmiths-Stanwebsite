
<?php
session_start(); 
$con = mysqli_connect("wp.kongu.edu", "24csef17", "24csef17", "24csef17");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['nam']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); 
    $sql = "SELECT * FROM band WHERE email = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "User already exists!";
    } else {
        $sql = "INSERT INTO band (name, pass, email) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $name, $password, $email);
        $success = mysqli_stmt_execute($stmt);
        if ($success) {
            echo "Signed up successfully!";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($con);
?>


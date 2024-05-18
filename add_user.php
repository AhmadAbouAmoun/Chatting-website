<?php
include "config.php";
echo "<script>alert(\"HI TEST. Please choose a different username or use a different email.\");</script>";
	
echo "hello<br>";

if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['number'];
    $trust = 100;

    // Check if the username or email already exist
    $checkExistQuery = "SELECT * FROM `register` WHERE `name` = '$name' OR `email` = '$email'";
    $checkExistResult = mysqli_query($conn, $checkExistQuery);
    echo "Before test1 <br>";

    if (mysqli_num_rows($checkExistResult) > 0) {
        // Username or email already exists
        echo "<script>alert(\"Username or email already exists. Please choose a different username or use a different email.\");</script>";
        header('Location: register.php');
        exit;  // Stop further execution
    } else {
        // Insert the new user if username and email are unique
        $sql = "INSERT INTO `register`(`name`, `email`, `password`, `number`,`trust`) VALUES ('$name','$email','$password','$number','$trust')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            session_start();
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header('Location: home.php');
            exit;  // Stop further execution
        } else {
            echo "Something went wrong";
        }
    }
}
?>

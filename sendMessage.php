<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "config.php";
session_start();

if ($_POST) {
    $NSFW_words = array("dumb", "donkey", "nigga", "nigger", "حمار", "غبي","shit",);
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $msg = $_POST['msg'];
    $decreaseAmount = 10;
    $columnName = "trust";
    $column= "counter";
    $increment=1;
    $increase=5;

    $containsBadWord = false;
    foreach ($NSFW_words as $word) {
        if (stripos($msg, $word) !== false) {
            $containsBadWord = true;
            break;
        }
    }

    if ($containsBadWord) {
        $sql = "UPDATE register SET $columnName = $columnName - $decreaseAmount WHERE name = '$name'";
        $query = mysqli_query($conn, $sql);
        $date = date("Y-m-d H:i:s");
        $logSql = "INSERT INTO nsfw_messages (name, message, nsfw_word, date_sent) VALUES ('$name', '$msg', '$word', '$date')";
        $logQuery = mysqli_query($conn, $logSql);

        if ($query) {
            // Check if the updated value is under 30
            $updatedValueQuery = mysqli_query($conn, "SELECT trust FROM register WHERE name = '$name'");
            if ($updatedValueQuery) {
                $result = mysqli_fetch_assoc($updatedValueQuery);
                $updatedValue = $result['trust'];

                // Check if the trust is below 30
                if ($updatedValue <= 30) {
                    // Update the 'ban' column to 1 in the 'register' table
                    $banSql = "UPDATE `register` SET `banned` = 1 WHERE `name` = '$name'";
                    $banQuery = mysqli_query($conn, $banSql);

                    if ($banQuery) {
                        echo "<script>alert('Your account has been banned due to low trust. Please contact support for further assistance.');</script>";
                        echo "<script>window.location.href='login.php';</script>";
                        echo "<script>window.close();</script>";
                        exit;  // Ensure that no further PHP code is executed after closing the window
                    } else {
                        echo "Error in banning query: " . mysqli_error($conn);
                    }
                
                }
                else{
                    header("Location:chatpage.php");
                }
            }
        }
    } else {
        $sql = "INSERT INTO `chat`(`name`, `message`) VALUES ('$name', '$msg')";
        $query = mysqli_query($conn, $sql);
        $sql2 = "UPDATE register SET $column = $column + $increment WHERE name = '$name'";
        $query2 = mysqli_query($conn, $sql2);
        if ($query2) {
            // Check if the updated value is under 30
            $updatedValueQuery = mysqli_query($conn, "SELECT trust FROM register WHERE name = '$name'");
            if ($updatedValueQuery) {
                $result = mysqli_fetch_assoc($updatedValueQuery);
            }

        }

        if ($query) {
            echo '<script type="text/javascript">window.location.href="chatpage.php";</script>';
            exit;  // Ensure that no further PHP code is executed after the redirect
        } else {
            echo "Something went wrong";
            }
        }
    }


?>

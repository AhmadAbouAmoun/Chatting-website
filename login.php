<?php include "layouts/header.php"; ?>
<style>
  h2{
color:white;
  }
  label{
color:white;
  }
  .container {
    margin-top: 5%;
    width: 50%;
    background-color: #26262b9e;
    padding-top:5%;
    padding-bottom:5%;
    padding-right:10%;
    padding-left:10%;
  }
  .btn-primary {
    background-color: #673AB7;
}
  </style>
<?php
  include "config.php";
  
  if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Check if the account is banned
    $bannedSql = "SELECT * FROM `register` WHERE email = '".$email."' AND banned = 1";
    $bannedQuery = mysqli_query($conn, $bannedSql);

    if (mysqli_num_rows($bannedQuery) > 0) {
      echo "<script> alert('Your account is banned. Please contact support for further assistance.'); </script>";
    } else {
      // Proceed with the login if the account is not banned
      $loginSql = "SELECT * FROM `register` WHERE email = '".$email."' AND password = '".$password."'";
      $loginQuery =  mysqli_query($conn, $loginSql);

      if (mysqli_num_rows($loginQuery) > 0) {
        $row = mysqli_fetch_assoc($loginQuery);
        session_start();
        $_SESSION['name'] = $row['name'];
        header('Location: home.php');
      } else {
        echo "<script> alert('Invalid Email or Password.'); </script>";
      }
    }
  }
?>


<div class="container">
  <center><h2>Login form</h2></center></br>
  <form class="form-horizontal" method="post" action="">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
	  
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>

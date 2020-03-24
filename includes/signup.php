<?php
include "../src/register.php";
$username=$email=$phone="";

if ($_SERVER['REQUEST_METHOD']== "POST") {
  $username= $_POST['username'];
  $email= $_POST['email'];
  $phone= $_POST['phone'];
  
  register_user($username,$email,$phone);
}

echo $username.$email.$phone;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../public/css/signup.css">
    <title>Leaderboard  - Sign Up</title>
</head>
<body>
    <div class="contact-us">
        <form id="login" action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method='POST'>
          <input placeholder="Name" required="" type="text" name="username"/>
          <input name="email" placeholder="Email" type="email" />
          <input name="phone" placeholder="Phone" type="tel" />
          <button type="submit">SIGN UP</button><br><br>
          <p>Already a user ? <a href="login.php"> Login here </a></p>
        </form>
      </div>
      <script src="../public/js/jquery-2.2.3.min.js"></script>
</body>
</html>
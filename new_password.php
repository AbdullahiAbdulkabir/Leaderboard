<?php include('./config/connect.php'); 
 session_start();
 //echo  $_SESSION['password_session'];
if (!isset($_SESSION['password_session']) || empty($_SESSION['password_session'])) {
    header('location:index.php');
}
if (isset($_POST['submit'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_SESSION['password_session'];
    $sql = "UPDATE `users` SET `password` = '$password' WHERE `email`='$email'";
    $result = mysqli_query($conn,$sql);
    if ($result) {
       header('location:sign_in.php?message=success');
    }else{
        echo "error updating password. Try again later";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Set new password - JSMinna Internship</title>
 <link rel="stylesheet" href="./assets/css/form.css">
 <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/x-icon">
</head>
<body>
 <main class="body-content flex col">
  <h1 id="home">JSMinna Internship</h1>
  <img src="./assets/img/lbs.png" alt="learnBuildShare"/>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
   <fieldset>
    <legend>Set new passowrd</legend>
    <p style="margin-bottom: 25px;">Reset password for: <span id="reset-user" style="font-weight: 600;"><?php echo $_SESSION['password_session']?></span></p>    
    <div class="field flex col">
     <label for="npassword">New password</label>
     <input type="password" name="password" id="password" required>     
    </div>
    <div class="field flex col">
     <label for="cnpassword">Confirm password</label>
     <input type="password" name="cnpassword" id="cnpassword" required>     
    </div>
   </fieldset>   
   <button class="flex col" type="submit" name="submit">RESET</button> 
  </form>
 </main>
 <script>
  document.getElementById("home").addEventListener("click", function(){
   window.location.href = "./index.html"
  })
 </script>
 <script src="check.js"></script>
</body>
</html>
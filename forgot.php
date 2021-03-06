<?php include('./config/connect.php'); 
$error_msg ='';
if (isset($_POST['submit'])) {
  $nickname = $_POST['nickname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $sql = "SELECT * FROM  users WHERE `nickname`='$nickname' AND `email`='$email' AND `phone`='$phone'";
  $result = mysqli_query($conn,$sql);
  if ($result) {
      while($row = mysqli_fetch_assoc($result)) {
          session_start();
          $_SESSION['password_session'] = $row['email'];
          header('location: new_password.php');
      }
  }else{
      $error_msg = "Error : no match found";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Reset password - JSMinna Internship</title>
    <link rel="stylesheet" href="./assets/css/form.css" />
     <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/x-icon">
  </head>
  <body>
    <main class="body-content flex col">
      <h1 id="home">JSMinna Internship</h1>
      <img src="./assets/img/lbs.png" alt="learnBuildShare" />
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"  method="POST">
        <fieldset>
          <legend>Reset password</legend>
          <?php echo "$error_msg";?>
          <div class="field flex col">
            <label for="user">Email</label>
            <input type="email" name="email" id="user" required />
          </div>
          <div class="field flex col">
            <label for="nick">Nickname</label>
            <input type="text" name="nickname" id="nick" required />
          </div>
          <div class="field flex col">
            <label for="phone">Phone</label>
            <input type="tel" name="phone" id="phone" required />
          </div>
        </fieldset>
        <button class="flex col" type="submit" name="submit">REQUEST RESET</button>
        <div class="links">
          <p>Existing user? <a href="./sign_in.php">Sign in</a></p>
          <p>Don't have an account? <a href="./sign_up.php">Sign up</a></p>
        </div>
      </form>
    </main>
    <script>
      document.getElementById("home").addEventListener("click", function () {
        window.location.href = "./index.html";
      });
    </script>
  </body>
</html>

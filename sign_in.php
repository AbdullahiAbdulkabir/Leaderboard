<?php include('./config/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Sign in - JSMinna Internship</title>
 <link rel="stylesheet" href="./assets/css/form.css">
 <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/x-icon">
 <meta name="description" content="sign up for JSMINNA">
 <meta property="og:type" content="website">
 <meta name="keywords" content="JSMINNA INTERNSHIP, sign up, create account, Jsminna">
 <meta property="og:url" content="https://javascriptminna.com/internship.html">
 <meta property="og:site_name" content="JSMINNA INTERNSHIP">
 <meta property="og:image" content="./assets/img/favicon.png">
</head>
<body>
    <?php
    $error = "";
    session_start();
    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($conn, $_POST['email']);
        $myPassword = mysqli_real_escape_string($conn, $_POST['password']);
        $sql = "SELECT * FROM users WHERE `email` = '$username'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        //$active = $row['active'];
        $count = mysqli_num_rows($result);
        $error = "";
        // If result matched $myusername and $mypassword, table row must be 1 row
        if($count == 1 && password_verify($myPassword, $row['password'])) {
            if ($row['isAdmin'] == 2) {
                //superAdmin priviledges
                $_SESSION['isAdmin'] = true;
                $_SESSION['isSuperAdmin'] = true;
                $_SESSION['login_user'] = $username;
                header("location: admin/index.php?superadmin=true");
            }elseif ($row['isAdmin'] == 1) {
                //basic admin priviledges
                $_SESSION['isAdmin'] = true;
                $_SESSION['login_user'] = $username;
                header("location: admin/index.php");

            }elseif ($row['isAdmin'] == 0) {
                //basic usee priviledges
                $_SESSION['login_user'] = $username;
                $_SESSION['login_user'] = $username;
                header("location: user/index.php");
            }
else {
                header("location: user/index.php");
            }
           
        }else {
             $error = "Your Login Name or Password is invalid";
        }
    }

?>

 <main class="body-content flex col">
  <h1 id="home"> <span style="color: #febf10;">JSMINNA </span> INTERNSHIP</h1>
  <img src="./assets/img/lbs.png" alt="learnBuildShare"/>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
   <fieldset>
    <legend>Sign in</legend>
      <?php
    $ref = substr(@$_SERVER['HTTP_REFERER'],strlen(@$_SERVER['HTTP_REFERER']) - 11, 11);
    $resetPassword = substr(@$_SERVER['HTTP_REFERER'],strlen(@$_SERVER['HTTP_REFERER']) - 16, 16);
    $upd = substr(@$_SERVER['HTTP_REFERER'],strlen(@$_SERVER['HTTP_REFERER']) - 9, 9);
    if (@$_GET['message'] == 'success' && $ref == 'sign_up.php') {
        echo "<div class='notify'><p>Registration Successful</p></div>";
    }
    if (@$_GET['message'] == 'update' && $upd == 'update.php') {
        echo "<div class='notify'><p>Successful</p></div>";
    }
    if (@$_GET['message'] == 'success' && $resetPassword == 'new_password.php') {
        echo "<div class='notify'><p>Password reset successful. Kindly log into your account.</p></div>";
    }
    ?>
    <?php if($error !== ''){ ?>
    <div class="notify">
     <p>
        <?= $error?>
     </p>
    </div>
    <?php }?>
    <div class="field flex col">
     <label for="user">Email</label>
     <input type="email" name="email" id="user" required>     
    </div>
    <div class="field flex col">
     <label for="password">Password</label>
     <input type="password" name="password" id="password" required>     
    </div>
   </fieldset>   
   <button type="submit" name="submit" class="flex col">SIGN IN</button>
   <div class="links">
    <p>Forgot <a href="./forgot.php">Password</a>?</p>
   <p>Don't have an account? <a href="./sign_up.php">Sign up</a></p>
   </div>
  </form>
 </main>
 <script>
  document.getElementById("home").addEventListener("click", function(){
   window.location.href = "./index.html"
  })
 </script>
</body>
</html>

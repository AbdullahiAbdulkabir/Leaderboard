<?php
require('../../config/connect.php');
require('../../config/session.php');
if(isset( $_SESSION['login_user']) && $_SESSION['isAdmin'] == true){
    if (isset($_POST['submit'])) {
        $track = $_POST['track'];
        $_SESSION['track'] = $track;
        header("location: task.php?track=$track");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="../../assets/css/style.css">
 <!-- <link rel="stylesheet" href="../../assets/css/submissions.css"> -->
 <link rel="stylesheet" href="../../assets/css/responsive.css">
 <link rel="shortcut icon" href="../../assets/img/favicon.png" type="image/x-icon">
 <title>Dashboard - JSMinna Internship</title>
</head>
<body class="flx col">
 <header class="flx row">
  <span>JSMinna Internship</span>
  <div class="profile flx col">
    <img src="../../assets/img/profile.png">
    <ul class="options">
      <li id="logout"><a href="../../logout.php">Logout</a></li>
    </ul>
  </div>
 </header>
 <div class="pageWrapper flx row">
  <nav class="flx col" id="navPane">
  <div id="hamburger" class="flx col">
      <div class="a"></div>
      <div class="b"></div>
      <div class="c"></div>
 </div>
     <div class="flx col content">
       <ul class="linksContainer">
        <li class="flx row active">
         <img src="../../assets/img/profileWT.png">
         <a href="../../admin">Admin Dashboard</a>
        </li>
        <!-- <li class="flx row">
         <img src="../../assets/img/add.png">
         <a href='addnewtask.php'>Add New Tasks</a>
        </li> -->
        <li class="flx row">
         <img src="../../assets/img/task.png">
         <a href="super.php">All Tasks</a>
        </li>
        <li class="flx row">
         <img src="../../assets/img/lock.png">
         <a href="../superadmin.php">Super Admin</a>
        </li>
        <li class="flx row">
         <img src="../../assets/img/podium.png">
         <a href="../../leaderboard">Leaderboard</a>
        </li>
        <!-- <li class="flx row">
         <img src="../../assets/img/twitter.png">
         <a href=" #">Tweet</a>
        </li> -->
        <li class="flx row">
         <img src="../../assets/img/whatsapp.png">
         <a href="https://javascriptminna.com/whatsapp">Support group</a>
        </li>
       </ul>
       <span id="email"><?=$_SESSION['login_user'];?></span>
     </div>   
   </nav>
   <div class="mainWrapper flx col" id="mainWrp">
    <main class="flx col">
      <form method="POST" class="flex col">
        <legend>Tasks</legend>
        <div class="fields-container flx col">
          <div class="field flx col">
            <label for="track">Track</label>
            <select name="track" value="">
            <option value="backend">Backend</option>
            <option value="frontend">Frontend</option>
      
            </select>
          </div>
          <button id="submitTask" type="submit" name="submit">Submit</button>
        </div>
        </form> 
     
   
     </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; JSMinna Internship 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms &amp; Conditions</a></div></footer>
   </div>
 </div>
 <script src="../../assets/js/app.js"></script>
<script>
setTimeout(() => {
    $('#success').hide(1000);
}, 2000);
</script>
</body>
</html>
<?php
}else{
    header("location:../../sign_in.php"); 
}
?>
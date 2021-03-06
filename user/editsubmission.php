<?php
require('../config/connect.php');
session_start();
if (!isset($_SESSION['login_user']) || empty($_SESSION['login_user'])) {
  
?>
 <script>
    document.write('You must be logged in first, redirecting to login page ...');
    setTimeout(() => {
        window.location.href = "../../sign_in.php"
    }, 3000);
 </script>
<?php
}else{
  $id = $_GET['id'];
  $sql = "SELECT * FROM submissions WHERE id = '$id'";
  $res = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($res);
  $rw = mysqli_fetch_assoc($res);

  $day = strtotime("2020-09-07");
  $currdates = date("Y-m-d");
  $currdate = strtotime($currdates);
  $diff = abs($currdate - $day);
  $years = floor($diff / (365*60*60*24));
  $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
  $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
  $days +=1;

    if (isset($_POST['submit'])) {
        global $conn;
        $url = mysqli_real_escape_string($conn, $_POST['url']);
        $level = $_POST['level'];
        $track = $_POST['track'];
        $comment =  mysqli_real_escape_string($conn, $_POST['comment']);
        $edit_sql = "UPDATE submissions SET `track` = '$track', `url`='$url', `comments` = '$comment', `level` = '$level' WHERE id = '$id'";
        // var_dump($edit_sql); die;
        $result = mysqli_query($conn,$edit_sql);
        if ($result) {
            header('location: index.php?editSubmissionReport=success');
        }else {
            header('location: index.php?editSubmissionReport=failed');;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="../assets/css/style.css">
 <link rel="stylesheet" href="../assets/css/submit.css">
 <link rel="stylesheet" href="../assets/css/responsive.css">
 <link rel="shortcut icon" href="./../assets/img/favicon.png" type="image/x-icon">
 <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0"/>
 <title>Edit Submission - JSMinna Internship</title>
</head>
<body class="flx col">
 <header class="flx row">
  <span>JSMinna Internship</span>
  <div class="techSymb flx row">
   <img src="../assets/img/htm.png">
   <img src="../assets/img/crly.png">
   <img src="../assets/img/prts.png">
   <img src="../assets/img/dsg.png">
  </div>
  <div class="profile flx col">
    <img src="../assets/img/profile.png">
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
      <?php
      global $conn;
      $user_nickname = '';
      $user_track = '';
      $email = $_SESSION['login_user'];
      $sql = "SELECT * FROM leaderboard WHERE email='$email' ORDER BY `score` DESC LIMIT 1";
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_assoc($result)) {
          $user_nickname = $row['nickname'];
          echo '<img src=\'https://robohash.org/'.$user_nickname.$user_track.'\'/ alt="robot avatar" class="avatar flx col"/>';
          echo '<p class="username">'.$user_nickname.'</p>';
      }
      ?>
      <ul class="linksContainer">
        <li class="flx row">
          <img src="../assets/img/profileWT.png" />
          <a href="index.php">Profile</a>
        </li>
        <li class="flx row">
          <img src="../assets/img/task.png" />
          <a href="task.php">View task</a>
        </li>
        <li class="flx row active">
          <img src="../assets/img/add.png" />
          <a href="submit.php">Submit task</a>
        </li>
        <li class="flx row">
          <img src="../assets/img/submissions.png" />
          <a href="submissions.php">Submissions</a>
        </li>
        <li class="flx row">
          <img src="../assets/img/podium.png" />
          <a href="../leaderboard">Leaderboard</a>
        </li>
        <li class="flx row">
          <img src="../assets/img/twitter.png" />
          <!-- <a href="https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcodes.xyz&via=codon&text=Hello%2C%20I%20just%20finished%20my%20task%20for%20....&hashtags=30DaysOfCode%2C%20ECX">Tweet</a> -->
        </li>
        <li class="flx row">
          <img src="../assets/img/whatsapp.png" />
          <a href="https://javascriptminna.com/whatsapp">Support group</a>
        </li>
        <li class="flx row">
          <img src="../assets/img/feedback.png" />
          <a href="feedback.php">Feedback</a>
        </li>
      </ul>
      <span class="email">
        <?=$_SESSION['login_user'];?>
      </span>
    </div>
  </nav>
<div class="mainWrapper flx col" id="mainWrp">
    <main class="flx col">
        <form method="POST">
        <legend>Edit submission</legend>
         <div class="fields-container">
         <div class="field flx col">
            <label for="url">URL</label>
            <input type="url" name="url" placeholder="Enter URL" required value="<?=$rw['url'];?>">
            <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;">Python - Repl.it Url, Backend - Github repo Url, Frontend - Github repo Url(put link to your Github Pages in the readme), UI/UX - Figma/Adobe XD Url</p>
          </div>
          
          <div class="field flx col">
            <label for="track">Track</label>
            <select class="form-control" name="track">
              <option value="backend" <?php echo ($rw['track'] == 'Backend')? 'selected' : ''; ?>>Backend</option>
              <option value="frontend" <?php echo ($rw['track'] == 'Frontend')? 'selected' : ''; ?>>Frontend</option>
           
          </select>
          </div>
          <div class="field flx col">
            <label for="comment">Comments?</label>
            <textarea name="comment" type="text" placeholder="Any comments?" rows="5"><?=$rw['comments']; ?></textarea>
          </div>
          <button id="submitTask" type="submit" name="submit">Submit task</button>
         </div>
        </form>      
     </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; 30DaysOfCode 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms &amp; Conditions</a></div></footer> 
   </div>
 </div>
 <script src="../assets/js/app.js"></script>
</body>
</html>
<?php
}
?>

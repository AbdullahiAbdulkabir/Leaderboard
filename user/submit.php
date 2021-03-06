 
<?php
require('../config/connect.php');
require('../config/session.php');
include ('taskday.php');
if(isset( $_SESSION['login_user'])){
    $tt = $_SESSION['login_user'];
    $sql = "SELECT track FROM users WHERE email = '$tt'";
    $result = mysqli_query($conn, $sql);
    $row =mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="../assets/css/style.css">
 <link rel="stylesheet" href="../assets/css/submit.css">
 <link rel="stylesheet" href="../assets/css/responsive.css">
 <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
 <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0"/>
 <title>Submit task - JSMinna Internship</title>
</head>
<body class="flx col">
 <header class="flx row">
  <span>JSMinna Internship</span>
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
        <form class="flx col main" enctype="multipart/form-data" onsubmit="handleSubmission(event)">
          <legend>
            Submit task <span class="day" style="float: none;">- Day <?= $days; ?></span> <div class="generic"></div><a class="py" href="#">#</a>
          </legend>
          <div class="notice flx col notice2" style="display: none;"></div> 
            <div class="notice flx col notice3"></div>
          <div class="fields-container">            
      		 <div class="field flx col">
      	    	<label for="track">Track</label>
		          <select id="track" class="trackS" name="track" value="">
                <option value="backend">Backend</option>
                <option value="frontend">Frontend</option>
             
              </select>
            </div>
            <div class="field flx col">
              <label for="url">URL</label>
              <input id="url" type="url" name="url" placeholder="Enter URL" required>
              <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;"><a href="#">Submission Guidelines</a></p>
            </div>
            <div class="field flx col">
              <label for="comment">Comments?</label>
              <textarea id="comment" name="comment" type="text" placeholder="Any comments?" rows="5"></textarea>
            </div>
            <div class="field flx col">
            </div>
            <input type="hidden" id="task_day" name="task_day" value="<?= $days; ?>">
            <input type="hidden" id="name" name="name" value="<?= $_SESSION['login_user']; ?>">
            <input type="hidden" name="cohort" value="1">
            <button style="display: none;" class="submit" id="upload" type="submit" name="psubmit">Submit task</button>
            <button id="submitTask" type="submit" name="submit">SUBMIT TASK</button>
            <div class="prev_link"><a href="newsubmit.php"><--&nbsp; Previous days</a></div>
          </div>
        </form>
     </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; JSMinna Internship 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms &amp; Conditions</a></div></footer> 
   </div>
 </div>
 <script src="../assets/js/app.js"></script>
 <script src="../assets/js/jquery-3.4.1.js"></script>
<script type="text/javascript">
  var points;
  function handleSubmission(event) {
    event.preventDefault()
    var urls = document.getElementById('url').value;
    var level = '';
    var comment = document.getElementById('comment').value;
    var name = document.getElementById('name').value;
    var cohort = 1;
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var points;
	  var n = 1;
    var track = document.getElementById('track').value;
    console.log(track)
    var task_day = document.getElementById('task_day').value;
    var form_data = new FormData($('.main')[0]);

    $.ajax({
        url: 'py_submit.php',
        data: 'user='+name+'&track='+track+'&task_day='+task_day+'&points='+points+'&sub_date='+date+'&cohort='+cohort+'&level='+level+'&url='+urls+'&comment='+comment+'&n='+n,
        type: 'POST',
        success: function(data) {
          $('.notice2').toggle();
          $('.notice2').html(data);
          $('.notice3').html('<p>Share on <a style="font-size: 16px;" href="https://twitter.com/intent/tweet?url=https%3A%2F%2Fjavascriptminna.com%2F&via=JavascriptMinna&text=Day <?= $days;?>%20of%2030%3A%20Check%20out%20my%20solution%20at%3A%20'+urls+'&hashtags=jsminnainternship%2C%202monthsoflearning%2C%20jsminna">Twitter </a></p>')

        },
        error: function() {}
    });
  }
</script>
</body>
</html>
<?php
}else{
  header("location:../sign_in.php");
}
?>

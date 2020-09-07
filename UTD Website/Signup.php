<html>
<title>Signup</title>
<head>
<link rel="stylesheet" type="text/css" href="CSS/studentStyle.css">
<link rel="icon" href="sitePictures/utdLogo.png">
<script type="text/javascript" src= "infoTab.js"></script>
</head>
<body onload="startDate()">

<section class="infoTab">
  <div class="info">
    <p>Current Date/Time: <span id="Date/Time"></span></p>
  </div>
</section>

<section class="headerSection">
  <div class="header">
    <h1>UTD Computer Science</h1>
    <h6>Erik Jonsson School of Engineering and Computer Science</h6>
  </div>
</section>

<div class="navigation">
  <ul>

  <li><a href="home.html">Home</a></li>
  <li><a href="faculty.html">Faculty</a></li>
  <li><a href="Student.html">Students</a></li>
  <li><a href="research.html">Research</a></li>
  <li><a href="admission.html">Admission</a></li>
  <li><a href="contact.html">Contact Us</a></li>
  <li><a href="Signup.php">Sign Up</a></li>
  <li><a href="login.php">Login</a></li>

  </ul>
</div>

<section class="contentSection">
  <div class="content">

    <div class="column side">
      <div class="tab">
      </div>
    </div>

    <div class="column middle">

      <div class="tab">
        <h1>Signup</h1>
        <?php
        if (isset($_GET['error'])) {
          if ($_GET['error'] == "passwordmismatch") {
            echo '<p style="color:red">Your retyped password differs from your original password</p>';
          }
        }
        else if($_GET['signup'] == "success"){
          echo '<p style="color:green">Signup complete! Please login.</p>';
        }
        ?>
        <form class="form-signup" action="actions/signupAction.php" method="post">
          <label for="FirstName">First Name:</label>
          <input type="text" id="FirstName" name="FirstName" value="" pattern="[A-Z]+[A-Za-z]{1,}" title="First name must be capitalized and alphabetic only" required><br><br>
          <label for="LastName">Last Name:</label>
          <input type="text" id="Last" name="LastName" value="" pattern="[A-Z]+[A-Za-z]{1,}" title="Last name must be capitalized and alphabetic only" required><br><br>
          <label for="Password">Password:</label>
          <input type="password" id="Password" name="Password" value="" pattern=".{8,}" title="Password needs to be atleast 8 characters long"><br><br>
          <label for="RetypePassword">Retype Password:</label>
          <input type="password" id="RetypePassword" name="RetypePassword" value=""><br><br>
          <label for="Email">Email:</label>
          <input type="text" id="Email" name="Email" value="" pattern="[A-Za-z0-9._%+-]+@[A-Za-z]+\.edu" title="All emails need to be .edu" placeholder="NETID@[university].edu" required><br><br>


          <input type="submit" name ="signup" value="Signup">

          </form>
      </div>

    </div>

    <div class="column side">
      <div class ="tab">
      </div>

    </div>


  </div>
</section>

<div class="footer">

  <p>Can't See? Double the Text Size! <button onclick="doubleTextSize()">Try it</button> </p>
  <p>Want a different Color? Click this! <button onclick="changeTabBackground()">Try it</button> </p>

  <p><em>Cade Cottrell</em>
  <br>
  NetID: <strong>cac160030</strong>
  <br>
  Assignment 1</p>
  <img src="sitePictures/utdLogo.png">
</div>

<script>



</script>


</body>
</html>

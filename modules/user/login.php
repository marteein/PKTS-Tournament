<?php include '../head/headLogin.php' ?>
<script src="../../js/login.js"></script>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <br>
      <h1>PKTS LOGIN</h1>
    </div>

    <!-- Login Form -->
    <form method="POST">
      <input type="text" id="emaillogin" class="fadeIn second" name="login" placeholder="Enter email">
      <input type="password" id="passwordlogin" class="fadeIn third" name="login" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In" id="login">
    </form>

    <!-- Remind Passowrd -->
    <!-- <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a><br>
      <a class="underlineHover" href="#">Not yet Registered? Sign-Up Here</a>
    </div> -->

  </div>
</div>
</body>
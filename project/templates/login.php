<h3>Login</h3>
<form action="" method="post">
  <label for="login">Login</label>
  <input type="text" id="login" name="login">
  <label for="password">Password</label>
  <input type="password" id="password" name="password">
  <input type="submit" value="Log in">
</form>
  <br>
<form action="registration.php" method="post">
  <input type="submit" value="registration" name="reg">
</form>
<div><?= $message ?></div>

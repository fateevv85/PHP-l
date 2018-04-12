<h3>Login</h3>
<form action="" method="post">
  <label for="login">Login</label>
  <input type="text" id="login" name="login">
  <label for="password">Password</label>
  <input type="password" id="password" name="password">
  <br>
  <input type="submit" value="Log in">
</form>
<?php if ($message == 'incorrect_login') : ?>
  <div>Incorrect login and/or password</div>
<?php elseif ($message): ?>
  <div><?= $message ?>, please login again!</div>
<?php else: ?>
  <div>Input your login and password</div>
<?php endif; ?>
<br>
<a href="/project/public/cart/registration">Registration</a>

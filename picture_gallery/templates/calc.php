<h5>GET</h5>
<form action="">
  <label for="digit1">Digit 1</label>
  <input type="text" id="digit1" name="digit1">
  <select name="action">
    <option value="+">summation +</option>
    <option value="-">subtraction -</option>
    <option value="x">multiplication *</option>
    <option value="/">division /</option>
  </select>
  <label for="digit2">Digit 2</label>
  <input type="text" id="digit2" name="digit2">
    <input type="submit" value="Calculate!">
    <br>
</form>
<h5>POST</h5>
<form action="" method="post">
    <label for="digit1_1">Digit 1</label>
    <input type="text" id="digit1_1" name="digit1">
    <input type="submit" name="action" value="+">
    <input type="submit" name="action" value="-">
    <input type="submit" name="action" value="x">
    <input type="submit" name="action" value="/">
    <label for="digit2_2">Digit 2</label>
    <input type="text" id="digit2_2" name="digit2">
</form>
<br>
<h3>Result:</h3>
<p><?= $result ?></p>

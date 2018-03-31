<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/hw5/config/main.php";
require_once ENGINE_DIR . '/db.php';
?>

<div class="request_form_wrapper">
  <div class="request_form">
    <h5>Input picture ID to view</h5>
    <form action="">
      <label for="textId">Picture ID: </label>
      <input type="text" name="textId" id="textId">
      <input type="submit">
    </form>
  </div>
</div>
<h3>Hello Admin!</h3>
<p>Here you can add more items to catalog, and modify users accounts!</p>
<form action="" method="post">
  <input type="submit" name="logout" value="logout">
</form>
<div class="container">
    <div class="tabs_showcase">
        <div class="tab active">
            <div class="tab_desc">Add new item to catalog</div>
        </div>
        <div class="content">
            <form action="" method="post" name="query[addItem]">
                <label>
                    Title
                    <input type="text" name="query[title]">
                </label>
                <label>
                    Publisher
                    <input type="text" name="query[publisher]">
                </label>
                <label>
                    Category
                    <input type="text" name="query[category]">
                </label>
                <label>
                    Price
                    <input type="text" name="query[price]">
                </label>
                <label>
                    Author
                    <input type="text" name="query[author]">
                </label>
                <label>
                    Description
                    <textarea name="query[description]"></textarea>
                </label>
                <label>
                    Picture
                    <input type="file" name="image">
                </label>
              <br>
              <input type="submit" name="insert"><input type="reset">
            </form>
        </div>
        <div class="tab">
            <div class="tab_desc">Change items in catalog</div>
        </div>
        <div class="content hide">
            <form action="" method="post">
              <label for="">
                Search for item
                <input type="text">
              </label>
              <input type="submit" name="change">
            </form>
        </div>
        <div class="tab">
            <div class="tab_desc">Modify user accounts</div>
        </div>
        <div class="content hide">
            <form action="" method="post">

            </form>
        </div>
    </div>
</div>
<?php

var_dump($_POST);
var_dump($arr);
var_dump($HTTP_POST_VARS);
var_dump($_SERVER);

?>

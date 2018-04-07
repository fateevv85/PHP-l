<div class="comment-view_wrapper">
    <?php foreach ($comments as $single) : ?>
      <div class="comment_item">
        <div class="comment_item-name">
            <?= $single['name'] ?>
        </div>
        <div class="comment_item-date">
            <?= $single['Date'] ?>
        </div>
        <div class="comment_item-content">
            <?= $single['content'] ?>
        </div>
      </div>
    <?php endforeach; ?>
</div>

<div class="comment_wrapper">
  <form action="" method="post">
    <div class="comment_name">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>
    </div>
    <div class="comment_text-field">
      <label for="comment">Comment:</label>
      <textarea name="comment" id="comment" cols="30" rows="5"></textarea>
    </div>
    <input type="submit">
  </form>
</div>

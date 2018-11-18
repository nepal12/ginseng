<?php require APPROOT.'/views/inc/header.php';?>


<div class="container">
  <!--Here starts the new shareboard -->
  
  <button class="btn btn-success btn-review" type="button" data-toggle="collapse" data-target="#addReview" aria-expanded="false" aria-controls="addReview">
          Add your review 
  </button>

  <div class="card collapse" id="addReview">
    <div class="card-header">
      Please fill in the details to add your review
    </div>
    <div class="card-body">
    <form method="post" action="<?php echo ROOT_URL."shares" ?>">
      <div class="form-group">
        <label for="name">Your Name</label>
        <input type="text" class="form-control" id="name" placeholder="Your name">
      </div>

      <div class="form-group">
        <label for="email_address">Email address</label>
        <input type="email" class="form-control" id="email_address" aria-describedby="emailHelp" placeholder="example@example.com">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>

      <div class="form-group">
        <label for="title">Review title</label>
        <input type="text" class="form-control" id="title" placeholder="Add a title">
      </div>

      <div class="form-group">
        <label for="review_text">Write some review </label> <span id="textarea_feedback"></span>
        <textarea class="form-control" name="review_text" id="review_text" rows="3" maxlength="500"></textarea>
      </div>

      <input class="btn btn-primary" name="submit" type="submit" value="Submit">
    </form>
    </div>
  </div>
  <!-- Here Starts the display of all the comments-->
  <?php foreach($data['posts'] as $item):?>
  <div class="card">
    <div class="card-header">
      <?php echo $item->post_title;?>
    </div>
    <div class="card-body">
      <blockquote class="mb-0">
        <p> <?php echo $item->post_message;?></p>
        <footer class="blockquote-footer">says <?php echo $item->user_id;?> on <small><?php echo $item->created_at;?></small></footer>
      </blockquote>
    </div>
  </div>


  <?php endforeach; ?>


</div>

<?php require APPROOT.'/views/inc/footer.php';?>

<!DOCTYPE html>

<head>
  <link rel="icon" type="image/x-icon" href="/favicon.ico" />
  <link rel="stylesheet" href="/src/css/board_style.css" />

  <?php
  $user = 'root';
  $password = '';
  $database = 'my_db';

  $servername = 'localhost';
  $mysqli = new mysqli(
    $servername,
    $user,
    $password,
    $database
  );

  // Checking for connections
  if ($mysqli->connect_error) {
    die('Connect Error (' .
      $mysqli->connect_errno . ') ' .
      $mysqli->connect_error);
  }

  $type = $_POST['type'];
  if ($type == "new_post") {


    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $username = $_POST['username'];
    $title = $_POST['title'];
    $comment = $_POST['comment'];



    // SQL query to select data from database
    $sql = "insert into posts (image, username, title, comment) values ('$image', '$username', '$title', '$comment' )";
    if ($mysqli->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $sql = "select * from posts order by id desc";
    $result = $mysqli->query($sql);
    $rows = $result->fetch_assoc();
    $id = $rows['id'];
  } else if ($type == "new_comment") {
    $id = $_POST['id'];
    $sql = "select * from posts where id = " . $id . ";";
    $result = $mysqli->query($sql);
    $rows = $result->fetch_assoc();
  }

  $mysqli->close();
  ?>

</head>

<body>
  <nav class="center boards">
    <a class="board home" href="/">home</a>
    <a class="board test" href="/src/pages/test/">test</a>
  </nav>
  <div class="center info">
    <img src="/src/images/akira_motorcycle_test.png" />
    <div class="board-name">/T/ - Test Page</div>
    <div class="board-about">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae eveniet,
      molestiae dolor, sint voluptatibus, quasi saepe expedita natus hic
      veritatis veniam atque tenetur! Ducimus molestias eum incidunt,
      temporibus fugiat quam.
    </div>
  </div>

  <form id="form-add-post" class="form-add-post" enctype="multipart/form-data" method="POST" action="/src/pages/php/comment.php">
    <input type="hidden" name="post_id" value="<?php echo $id ?>" />
    <input type="hidden" name="type" value="new_comment" />
    <div class="form-box required">
      <div class="add-post-title">Add a Reply</div>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required />
    </div>

    <div class="form-box required">
      <label for="comment">Comment:</label>
      <input type="text" id="comment" name="comment" required />
    </div>

    <div class="form-box">
      <label for="image">Image:</label>
      <input type="file" id="image" name="image" />
    </div>

    <div class="form-box">
      <button type="button" id="submit-post">Submit</button>
      <button type="button" id="submit-reset">Reset</button>
    </div>
  </form>

  <div class="post">


    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['image']); ?>" />
    </td>

    <td><?php echo $rows['username']; ?></td>
    <td><?php echo $rows['title']; ?></td>
    <td><?php echo $rows['comment']; ?></td>
  </div>
</body>

<style>
  .post div {
    display: inline-block;
  }
</style>
<script type="text/javascript" src="/src/js/post_interactions.js"></script>
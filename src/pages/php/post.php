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

  // $type = $_POST['type'];
  // if ($type == "new_post") {

  //   $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
  //   $username = $_POST['username'];
  //   $title = $_POST['title'];
  //   $comment = $_POST['comment'];

  //   // SQL query to select data from database
  //   $sql = "insert into posts (image, username, title, comment) values ('$image', '$username', '$title', '$comment' )";
  //   if ($mysqli->query($sql) === TRUE) {
  //   } else {
  //     echo "Error: " . $sql . "<br>" . $mysqli->error;
  //   }

  //   //dont think we can get id before uploading, so making sure we get the right one by specifying extensively
  //   //worst case scenario - wrong post displayed upon uploading
  //   $sql = "select * from posts where username = '" . $username . "' and title = '" . $title . "' and comment = '" . $comment . "' order by id desc limit 10";
  //   $result = $mysqli->query($sql);
  //   $rows = $result->fetch_assoc();
  //   $id = $rows['id'];
  // } else if ($type == "comment") {

  //   $id = $_POST['id'];
  //   $sql = "select * from posts where id = " . $id . ";";
  //   $result = $mysqli->query($sql);
  //   $rows = $result->fetch_assoc();
  // } else if ($type == "new_comment") {

  //   //need to delete one of these -- ont know which
  //   //also need to alter js file to let not upload file
  //   if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
  //     echo 'No upload';
  //   } else {

  //     $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
  //     $username = $_POST['username'];
  //     $comment = $_POST['comment'];
  //     $id = $_POST['id'];

  //     // SQL query to select data from database
  //     $sql = "insert into comments (id, image, username, comment) values ('$id', '$image', '$username', '$comment' )";
  //     if ($mysqli->query($sql) === TRUE) {
  //     } else {
  //       echo "Error: " . $sql . "<br>" . $mysqli->error;
  //     }
  //     $sql = "select * from posts where id = " . $id . ";";
  //     $result = $mysqli->query($sql);
  //     $rows = $result->fetch_assoc();
  //   }
  // }

  //fetch Post - use only first line
  $id = $_POST['id'];
  $sql = "select * from posts where id = " . $id . ";";
  $resultPost = $mysqli->query($sql);
  $rows = $resultPost->fetch_assoc();

  //fetch comments - multiple lines
  $sql = " SELECT * FROM comments where id = " . $id;
  $resultComments = $mysqli->query($sql);

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

  <form id="form-add-comment" class="form-add-comment" enctype="multipart/form-data" method="POST" action="./addNewComment.php">
    <input type="hidden" name="id" value="<?php echo $id ?>" />
    <div class="form-box required">
      <div class="add-comment-title">Add a Reply</div>
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
      <button type="button" id="submit-comment">Submit</button>
      <button type="button" id="submit-reset">Reset</button>
    </div>
  </form>

  <table>
    <tr>

      <td>
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['image']); ?>" />
      </td>

      <td><?php echo $rows['username']; ?></td>
      <td><?php echo $rows['title']; ?></td>
      <td><?php echo $rows['comment']; ?></td>
    </tr>
    <?php
    while ($rowsComments = $resultComments->fetch_assoc()) {
    ?>
      <tr>
        <td>&nbsp;</td>
        <?php
        if (!empty($rowsComments['image'])) {
          echo '<td><img src="data:image/jpg;charset=utf8;base64,' . base64_encode($rowsComments['image']) . '" /></td>';
        }
        ?>

        <td><?php echo $rowsComments['username']; ?></td>
        <td><?php echo $rowsComments['comment']; ?></td>


      </tr>
    <?php
    }
    ?>
  </table>
</body>

<script type="text/javascript" src="/src/js/comment_interactions.js"></script>
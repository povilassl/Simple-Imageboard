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

  // SQL query to select data from database
  $sql = " SELECT * FROM posts ";
  $result = $mysqli->query($sql);
  $mysqli->close();
  ?>

</head>

<body>
  <nav class="center boards">
    <a class="board home" href="/">home</a>
    <a class="board test" href="src/pages/">test</a>
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
  <form id="form-add-post" class="form-add-post" enctype="multipart/form-data" method="POST" action="/src/pages/php/post.php">

    <input type="hidden" name="type" value="new_post" />
    <div class="form-box required">
      <div class="add-post-title">Add a Post</div>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required />
    </div>

    <div class="form-box required">
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" required />
    </div>

    <div class="form-box required">
      <label for="comment">Comment:</label>
      <input type="text" id="comment" name="comment" required />
    </div>

    <div class="form-box required">
      <label for="image">Image:</label>
      <input type="file" id="image" name="image" required />
    </div>

    <div class="form-box">
      <button type="button" id="submit-post">Submit</button>
      <button type="button" id="submit-reset">Reset</button>
    </div>
  </form>


  <table>
    <?php
    // LOOP TILL END OF DATA
    while ($rows = $result->fetch_assoc()) {
    ?>
      <tr>
        <!-- FETCHING DATA FROM EACH
                      ROW OF EVERY COLUMN -->
        <td>
          <form action="/src/pages/php/post.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $rows['id'] ?>" />
            <input type="hidden" name="type" value="new_comment" />
            <input type="submit" value="[reply]">
          </form>

          <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['image']); ?>" />
        </td>

        <td><?php echo $rows['username']; ?></td>
        <td><?php echo $rows['title']; ?></td>
        <td><?php echo $rows['comment']; ?></td>
      </tr>
    <?php
    }
    ?>
  </table>
</body>
<script type="text/javascript" src="/src/js/post_interactions.js"></script>
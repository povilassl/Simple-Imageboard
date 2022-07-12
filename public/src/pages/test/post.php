<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="./src/images/favicon.ico" />
  <style>
    body {
      background: black;
      color: white;
    }

    .board {
      color: white;
    }

    .info {
      padding: 0 0 40px 0;
    }

    .board-name {
      padding: 20px 0 20px 0;
      font-size: 50px;
    }

    .board-about {
      width: 20%;
      right: 0;
      left: 0;
      margin-right: auto;
      margin-left: auto;
    }

    .center {
      text-align: center;
    }

    .form-add-post {
      margin-left: auto;
      margin-right: auto;
      left: 0;
      right: 0;
      width: 20%;
      background-color: grey;
    }

    .add-post-title {
      text-align: center;
      font-size: 40px;
    }

    img {
      width: 15%;
      padding-top: 20px;
    }

    .required:after {
      content: " *";
      color: red;
    }

    table,
    th,
    td {
      border: 1px solid white;

    }
  </style>
  <?php

  if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
  } else {
    echo 'Phew we have it!';
  }

  // Username is root
  $user = 'root';
  $password = '';

  // Database name is geeksforgeeks
  $database = 'my_db';

  // Server is localhost with
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
    <a class="board home" href="/index.php">home</a>
    <a class="board test" href="/public/src/pages/post.php">test</a>
  </nav>
  <div class="center info">
    <img src="/public/src/images/akira_motorcycle_test.png" />
    <div class="board-name">/T/ - Test Page</div>
    <div class="board-about">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae eveniet,
      molestiae dolor, sint voluptatibus, quasi saepe expedita natus hic
      veritatis veniam atque tenetur! Ducimus molestias eum incidunt,
      temporibus fugiat quam.
    </div>
  </div>
  <form id="form-add-post" class="form-add-post">
    <!-- method="post" action="#" -->
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

    <div class="form-box">
      <button type="button" id="submit-post" onclick="uploadToDB()">
        Submit
      </button>
      <button type="button" id="submit-reset">Reset</button>
    </div>
  </form>

  <img id="myImage" src="" />

  <table>

    <!-- PHP CODE TO FETCH DATA FROM ROWS -->
    <?php
    // LOOP TILL END OF DATA
    while ($rows = $result->fetch_assoc()) {
    ?>
      <tr>
        <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
        <td><?php echo $rows['username']; ?></td>
        <td><?php echo $rows['title']; ?></td>
        <td><?php echo $rows['comment']; ?></td>
      </tr>
    <?php
    }
    ?>
  </table>
</body>

</html>

<script>
  /*function submitPostx() {
    let post = new Object();
    post.username = document.getElementById("username").textContent;
    post.title = document.getElementById("title").innerHTML;
    post.comment = document.getElementById("comment").innerHTML;
    alert(post.username + post.title + post.comment);
  }*/

  const init = function() {
    console.log("log: DOM Content successfully loaded");
    document
      .getElementById("submit-post")
      .addEventListener("click", submitPost);

    document
      .getElementById("submit-reset")
      .addEventListener("click", submitReset);
  };

  const submitPost = function(ev) {
    ev.preventDefault();
    ev.stopPropagation();

    let validCheck = validate();

    if (validCheck) {
      document.getElementById("form-add-post").submit();
    } else {
      //set red * - interactive
    }
  };

  const submitReset = function(ev) {
    ev.preventDefault();
    document.getElementById("form-add-post").reset();
  };

  const validate = function(ev) {
    let valid = true;
    let username = document.getElementById("username");
    let title = document.getElementById("title");
    let comment = document.getElementById("comment");

    if (
      !(
        username.value.length > 0 &&
        username.value.length <= 50 &&
        title.value.length > 0 &&
        title.value.length <= 100 &&
        comment.value.length > 0 &&
        comment.value.length <= 500
      )
    ) {
      valid = false;
    }

    return valid;
  };

  function uploadToDB() {
    uploadPostToDB("asd", "asd", "asddd");
  }

  document.addEventListener("DOMContentLoaded", init);
</script>
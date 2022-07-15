<!DOCTYPE html>

<head>
  <link rel="icon" type="image/x-icon" href="/favicon.ico" />
  <link rel="stylesheet" href="/src/css/board_style.css" />

  <?php
  $user = 'root';
  $password = '';
  $database = 'my_db';

  $servername = 'localhost';
  $conn = new mysqli(
    $servername,
    $user,
    $password,
    $database
  );

  // Checking for connections
  if ($conn->connect_error) {
    die('Connect Error (' .
      $mysqli->connect_errno . ') ' .
      $mysqli->connect_error);
  }

  $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
  $username = $_POST['username'];
  $title = $_POST['title'];
  $comment = $_POST['comment'];



  // SQL query to select data from database
  $sql = "insert into posts (image, username, title, comment) values ('$image', '$username', '$title', '$comment' )";
  if ($conn->query($sql) === TRUE) {
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
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

  <div class="post">

    <?php
    if (isset($_FILES['image'])) {
      $aExtraInfo = getimagesize($_FILES['image']['tmp_name']);
      $sImage = "data:" . $aExtraInfo["mime"] . ";base64," . base64_encode(file_get_contents($_FILES['image']['tmp_name']));
      echo '<img src="' . $sImage . '" alt="Uploaded image" />';
    }
    ?>

    <div> <?php echo $_POST["username"]; ?></div>
    <div> <?php echo $_POST["title"]; ?></div>
    <div> <?php echo $_POST["comment"]; ?></div>
  </div>
</body>

<style>
  .post div {
    display: inline-block;
  }
</style>
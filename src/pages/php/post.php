<!DOCTYPE html>

<head>
  <link rel="icon" type="image/x-icon" href="/favicon.ico">
  <link rel="stylesheet" href="/src/css/board_style.css">

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

  //fetch post - only first line, maybe there is a better way?
  $id = $_GET['id'];

  //not an integer - not viable for id
  if (!is_int((int) $id)) {
    header('Location: ./404.php');
  }

  $sql = "select * from posts where id = " . $id . ";";
  $resultPost = $mysqli->query($sql);

  //if post doesnt exist - redirect to 404
  if ($resultPost->num_rows === 0) {
    header('Location: ./404.php');
  }
  $rows = $resultPost->fetch_assoc();

  //fetch comments - multiple lines
  $sql = " SELECT * FROM comments where id = " . $id . ' order by date asc';
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
    <img id="header-image" src="/src/images/akira_motorcycle_test.png">
    <div class="board-name">/T/ - Test Page</div>
    <div class="board-about">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae eveniet,
      molestiae dolor, sint voluptatibus, quasi saepe expedita natus hic
      veritatis veniam atque tenetur! Ducimus molestias eum incidunt,
      temporibus fugiat quam.
    </div>
  </div>

  <form id="form-add-comment" class="form-add-comment" enctype="multipart/form-data" method="POST" action="./addNewComment.php" autocomplete="off">
    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
    <div class="form-box required">
      <div class="add-comment-title">Add a Reply</div>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
    </div>

    <div class="form-box required">
      <label for="comment">Comment:</label>
      <textarea rows="3" cols="17" type="text" id="comment" name="comment" required></textarea>
    </div>

    <div class="form-box">
      <label for="image">Image:</label>
      <input type="file" id="image" name="image">
    </div>

    <div class="form-box">
      <button type="button" id="submit-comment">Submit</button>
      <button type="button" id="submit-reset">Reset</button>
    </div>
  </form>

  <table>
    <tr>

      <td>
        <img id="file" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['image']); ?>">
      </td>

      <td><?php echo $rows['date']; ?></td>
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
          echo '<td><img id="file" src="data:image/jpg;charset=utf8;base64,' . base64_encode($rowsComments['image']) . '" /></td>';
        }
        ?>

        <td><?php echo $rowsComments['date']; ?></td>
        <td><?php echo $rowsComments['username']; ?></td>
        <td><?php echo $rowsComments['comment']; ?></td>


      </tr>
    <?php
    }
    ?>
  </table>

  <form id="form-delete" class="form-delete" autocomplete="off" method="POST" action="./deletePost.php">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="text" name="inputPassword" id="password">
    <!-- <i id="togglePassword">Toggle</i> -->
    <button id="deletePost">Delete</button>
  </form>
</body>

<script type="text/javascript" src="/src/js/commentInteractions.js"></script>
<script type="text/javascript" src="/src/js/passwordManagement.js"></script>
<script type="text/javascript" src="/src/js/fileInteractions.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  window.onpageshow = function(evt) {
    // If persisted then it is in the page cache, force a reload of the page.
    if (evt.persisted) {
      document.body.style.display = "none";
      location.reload();
    }
  };


  // $(document).ready(function() {
  //   $('#form-delete').submit(function(e) {
  //     e.preventDefault();
  //     $.ajax({
  //       type: "POST",
  //       url: "./deletePost.php",
  //       data: $(this).serialize(),
  //       success: function(response) {
  //         alert(response.success);
  //         alert("askjd");
  //       },
  //       error: function() {

  //         alert("err");
  //       }
  //     });
  //     alert("aksjdhkajshdkjahsd");
  //   });
  // });
</script>
<!DOCTYPE html>

<head>

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


    if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
        //no upload file
        $image = NULL;
    } else {
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    }

    $username = $_POST['username'];
    $comment = $_POST['comment'];
    $id = $_POST['id'];

    // SQL query to select data from database
    $sql = "insert into comments (id, date, image, username, comment) values ('$id', now(), '$image', '$username', '$comment' )";
    if ($mysqli->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    //update post date
    $sql = "update posts set date = now() where id = " . $id;
    if ($mysqli->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
    ?>

    <!-- redirect to inserted post -->
    <form id="postForm" action="./post.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?>">
    </form>

    <script type="text/javascript">
        document.getElementById("postForm").submit();
    </script>

</head>

<body></body>
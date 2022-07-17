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

    $image = NULL;

    //need to delete one of these -- ont know which
    //also need to alter js file to let not upload file in comment
    if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
        //no upload file
    } else {

        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    }

    $username = $_POST['username'];
    $comment = $_POST['comment'];
    $id = $_POST['id'];

    // SQL query to select data from database
    $sql = "insert into comments (id, image, username, comment) values ('$id', '$image', '$username', '$comment' )";
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
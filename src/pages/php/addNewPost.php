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

    // $type = $_POST['type']; TODO: remove types from everywhere

    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $username = $_POST['username'];
    $title = $_POST['title'];
    $comment = $_POST['comment'];


    $sql = "insert into posts (image, username, title, comment) values ('$image', '$username', '$title', '$comment' )";
    if ($mysqli->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    //if done with phpmyadmin
    $cfg['PersistentConnections'] = TRUE;

    // SQL query to select last inserted id from database for redirect
    $sql = "select last_insert_id() from posts where username = '" . $username . "' and title = '" . $title . "';";
    $result = $mysqli->query($sql);
    $rows = $result->fetch_assoc();
    $id = $rows['last_insert_id()'];

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
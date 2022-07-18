<!DOCTYPE html>
<html>

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

    //fetch post - only first line, maybe there is a better way?
    $id = $_POST['id'];
    $postPassword = $_POST['inputPassword'];
    $sql = "select password from posts where id = " . $id . ";";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();

    $postPassword = hash('sha256', $postPassword);


    if ($row['password'] === $postPassword) {

        $sql = "delete from posts where id = " . $id . ";";
        $result = $mysqli->query($sql);

        $sql = "delete from comments where id = " . $id . ";";
        $result = $mysqli->query($sql);
    }

    $mysqli->close();
    header('Location: /');
    ?>
</head>

</html>
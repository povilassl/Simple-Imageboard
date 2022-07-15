<!DOCTYPE html>

<head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <link rel="stylesheet" href="/src/css/board_style.css" />
    <?php
    $servername = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'my_db';

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

    $post_type = $_GET['type'];
    echo $post_type;

    //we try to get id, if not means its the full submit comment data
    //$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $username = $_POST['username'];
    // $post_id = $_POST['id'];
    // $comment = $_POST['comment'];

    // // SQL query to select data from database
    // $sql = "insert into comments (id, image, username, comment) values ('$image', '$username', '$title', '$comment' )";
    // if ($mysqli->query($sql) === TRUE) {
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
    //if there is no such data - its the first time visiting the page
    $post_id = $_GET['id'];

    // SQL query to select data from database
    $sql = " select * from posts where id = " . $post_id . ";";
    $result = $mysqli->query($sql);
    $mysqli->close();

    // while ($rows = $result->fetch_assoc()) {
    //     echo $rows['username'];
    //     echo $rows['title'];
    //     echo $rows['comment'];
    // }
    ?>

</head>


<body>
    <nav class="center boards">
        <a class="board home" href="/">home</a>
        <a class="board test" href="/src/pages/">test</a>
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
    <form id="form-add-post" class="form-add-post" enctype="multipart/form-data" method="POST" action="#">
        <input type="hidden" name="post_id" value="<?php var_dump($post_id) ?>" />
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

    <table>
        <?php
        while ($rows = $result->fetch_assoc()) {
        ?>
            <tr>
                <td>
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

<style>
    .post div {
        display: inline-block;
    }
</style>

<!-- need to fix this -->
<script type="text/javascript" src="/src/js/post_interactions.js"></script>
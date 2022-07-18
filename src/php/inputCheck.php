<html>

<head>

    <?php

    function contains($input)
    {
        $badChars = "~ ! @ # $ % ^ & * ( ) _ + , . / ; : \ ' - =";
        $arr = explode(" ", $badChars);
        foreach ($arr as $a) {
            if (str_contains($input, $a)) {
                return true;
            }
        }

        return false;
    }

    //TODO: check image

    function checkPostValid($image, $username, $title, $comment, $postPassword)
    {

        $userlen = strlen($username);
        $titlelen = strlen($title);
        $commlen = strlen($comment);
        $passlen = strlen($postPassword);

        //dont sanitize password
        if (
            $userlen  >= 5 && $userlen <= 20 &&
            $titlelen >= 5 && $titlelen <= 50 &&
            $commlen >= 5 && $commlen <= 500 &&
            $passlen >= 5 && $passlen <= 20 &&
            !contains($username) &&
            !contains($title) &&
            !contains($comment)
        ) {
            $valid = true;
        } else {
            $valid = false;
        }
        return $valid;
    }

    ?>
</head>

</html>
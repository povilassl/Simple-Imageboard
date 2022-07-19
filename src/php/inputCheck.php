<html>

<head>

    <?php

    use function PHPSTORM_META\registerArgumentsSet;

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

    function checkPostValid($imageName, $username, $title, $comment, $postPassword)
    {
        $userlen = strlen($username);
        $titlelen = strlen($title);
        $commlen = strlen($comment);
        $passlen = strlen($postPassword);

        //to deal with non ascii characters in extension - https://stackoverflow.com/questions/173868/how-to-get-a-files-extension-in-php
        setlocale(LC_ALL, 'en_US.UTF-8');

        $extension = pathinfo($imageName, PATHINFO_EXTENSION);
        $countOfDots = substr_count($imageName, ".");
        $regex = "/(png|jpg|jpeg|gif)/i";

        if (!preg_match($regex, $extension) || $countOfDots !== 1) {
            return false;
        }

        //dont sanitize password
        if (
            !($userlen  >= 5 && $userlen <= 20 &&
                $titlelen >= 5 && $titlelen <= 50 &&
                $commlen >= 5 && $commlen <= 500 &&
                $passlen >= 5 && $passlen <= 20 &&
                !contains($username) &&
                !contains($title) &&
                !contains($comment))
        ) {
            return false;
        }
        return true;
    }

    ?>
</head>

</html>
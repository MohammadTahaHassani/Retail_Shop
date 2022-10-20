<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
        <?php
            foreach($_SESSION["user"] as $key => $value){
                if($key != "user_status_id"){
                    echo "<p>$key => $value</p>";
                }
            }
        ?>

        <br>

        <a href="index.php?action=edit_user_information_form&
                user_id=<?php echo $_SESSION["user"]["id"]?>">Edit Information</a>
    </body>
</html>
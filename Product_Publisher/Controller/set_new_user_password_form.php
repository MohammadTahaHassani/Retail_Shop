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
            if(isset($error_message)){
                echo "<p>$error_message</p>";
            }
        ?>

        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="set_new_user_password">

            <input type="hidden" name="user_id" 
                value="<?php echo $user_id?>">

            <label>Password : </label>
            <input type="password" name="user_password">

            <br>            

            <input type="submit" value="Reset Password">

        </form>
    </body>
</html>
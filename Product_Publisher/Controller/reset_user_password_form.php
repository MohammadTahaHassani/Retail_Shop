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
            <input type="hidden" name="action" value="reset_user_password">

            <label>Username : </label>
            <input type="text" name="user_username">

            <br>            

            <label>Phone : </label>
            <input type="text" name="user_phone">

            <br>

            <input type="submit" value="Reset Password">

        </form>
    </body>
</html>
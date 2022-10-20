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
            if(!empty($pattern_error_message)){
                foreach($pattern_error_message as $error){
                    echo "<p>$error</p>";
                }
            }
        ?>
        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="singup">

            <label>Name : </label>
            <input type="text" name="user_name">

            <br>

            <label>Family : </label>
            <input type="text" name="user_family">

            <br>

            <label>Phone : </label>
            <input type="text" name="user_phone">

            <br>

            <label>Address : </label>
            <input type="text" name="user_address">

            <br>

            <label>Username : </label>
            <input type="text" name="user_username">

            <br>

            <label>Password : </label>
            <input type="password" name="user_password">

            <br>

            <input type="submit" value="Login">
        </form>

    </body>
</html>
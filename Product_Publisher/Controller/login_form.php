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
            if(!empty($error_array)){
                foreach($error_array as $error){
                    echo "<p>$error</p>";
                }
            }
        ?>
        <h1>Login</h1>
        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="login">

            <label>Username : </label>
            <input type="text" name="username">

            <br>

            <label>password : </label>
            <input type="password" name="password">

            <br>

            <input type="submit" value="Login">
        </form>

        <br>

        <a href="index.php?action=view_singup">Singup</a>
        <br>
        <a href="index.php?action=reset_user_password_form">Forget Password</a>

    </body>
</html>
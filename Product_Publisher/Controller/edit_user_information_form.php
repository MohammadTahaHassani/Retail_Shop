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
            <input type="hidden" name="action" value="edit_user_information">
            <input type="hidden" name="user_id"
                value="<?php echo $user_information->__get("user_id")?>">


            <label>Name : </label>
            <input type="text" name="user_name"
                value="<?php echo $user_information->__get("user_name")?>">

            <br>

            <label>Family : </label>
            <input type="text" name="user_family"
                value="<?php echo $user_information->__get("user_family")?>">

            <br>

            <label>Phone : </label>
            <input type="text" name="user_phone"
                value="<?php echo $user_information->__get("user_phone")?>">

            <br>

            <label>Address : </label>
            <input type="text" name="user_address"
                value="<?php echo $user_information->__get("user_address")?>">

            <br>

            <label>Username : </label>
            <input type="text" name="user_username"
                value="<?php echo $user_information->__get("user_username")?>">

            <br>

            <input type="submit" value="Edit">

        </form>
    </body>
</html>
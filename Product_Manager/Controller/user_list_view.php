<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>

    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="user_search">

        <label>Search : </label>
        <input type="text" name="search_text">

        <input type="submit" value="Search">
    </form>

    <hr>
        <table>
            <th>User Code</th>
            <th>User Name</th>
            <th>User Family</th>
            <th>User Phone</th>
            <th>User Address</th>
            <th>User Username</th>
            <th>User Status</th>

            <?php foreach($users as $user):?>
                <tr>
                    <td>
                        <?php echo $user->__get("user_id")?>
                    </td>
                    <td>
                        <?php echo $user->__get("user_name")?>
                    </td>
                    <td>
                        <?php echo $user->__get("user_family")?>
                    </td>
                    <td>
                        <?php echo $user->__get("user_phone")?>
                    </td>
                    <td>
                        <?php echo $user->__get("user_address")?>
                    </td>
                    <td>
                        <?php echo $user->__get("user_username")?>
                    </td>
                    <td>
                        <form action="index.php" method="POST">
                            <input type="hidden" name="action" value="change_user_status">
                            <input type="hidden" name="user_id"
                                value="<?php echo $user->__get("user_id")?>">

                            <select name="status_id">
                                <?php foreach($assignments as $assignment):?>
                                    <option <?php if($assignment->__get("assignment_id") == $user->__get("user_status_id")):?>
                                                selected="selected"
                                            <?php endif?>
                                        value="<?php echo $assignment->__get("assignment_id")?>">
                                            <?php echo $assignment->__get("assignment_description")?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                            <input type="submit" value="Edit">
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </body>
</html>
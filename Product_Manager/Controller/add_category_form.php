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
            <input type="hidden" name="action" value="add_category">

            <label>Category : </label>
            <input type="text" name="category">

            <br>

            <input type="submit" value="Add">
        </form>
    </body>
</html>
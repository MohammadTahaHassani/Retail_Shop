<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
        <table>
            <th>Category Code</th>
            <th>Category Name</th>

            <?php foreach($categories as $category):?>
                <tr>
                    <td>
                        <?php echo $category->__get("category_id")?>
                    </td>
                    <td>
                        <?php echo $category->__get("category_name")?>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </body>
</html>
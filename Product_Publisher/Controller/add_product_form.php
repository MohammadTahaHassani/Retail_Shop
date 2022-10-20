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
                foreach($error_array as $error_message){
                    echo "<p>$error_message</p><br>";
                }
            }
        ?>

        <form action="index.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add_product">

            <label>City : </label>
            <select name="product_city_published">
                <option value="losangeles">losangels</option>
                <option value="california">california</option>
                <option value="newyork">newyork</option>
                <option value="dallas">dallas</option>
                <option value="chicago">chicago</option>
            </select>

            <br>

            <label>Category : </label>
            <select name="category_id">
                <?php foreach($categories as $category):?>
                    <option value="<?php echo $category->__get("category_id")?>">
                        <?php echo $category->__get("category_name")?>
                    </option>
                <?php endforeach;?>
            </select>

            <br>

            <label>Name : </label>
            <input type="text" name="product_name">
            
            <br>

            <label>Subject : </label>
            <input type="text" name="product_subject">

            <br>

            <label>Description : </label>
            <input type="text" name="product_description">

            <br>

            <label>Price : </label>
            <input type="text" name="product_price">

            <br>

            <label>Images : </label>
            <br>
            <input type="file" name="product_image[]">
            <br>
            <input type="file" name="product_image[]">
            <br>
            <input type="file" name="product_image[]">

            <br><br>
            
            <input type="submit" value="Add Product">
        </form>
    </body>
</html>
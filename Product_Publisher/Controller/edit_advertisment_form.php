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

        Image _1 : <img src="<?php echo $product->__get("product_image_1")?>">
        Image _2 : <img src="<?php echo $product->__get("product_image_2")?>">
        Image _3 : <img src="<?php echo $product->__get("product_image_3")?>">

        <hr>

        <form action="index.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="edit_personal_advertisment">
            <input type="hidden" name="product_id"
                value="<?php echo $product->__get("product_id")?>">

            <label>Category : </label>
            <select name="category_id">
                <?php foreach($categories as $category):?>
                        <option <?php if($category->__get("category_id") == $category_id) "selected='selected'"?>
                            value="<?php echo $category->__get("category_id")?>">
                            <?php echo $category->__get("category_name")?>
                        </option>
                <?php endforeach;?>
            </select>

            <br>

            <label>City : </label>
                <select name="product_city_published">
                    <option value="losangeles">losangels</option>
                    <option value="california">california</option>
                    <option value="newyork">newyork</option>
                    <option value="dallas">dallas</option>
                    <option value="chicago">chicago</option>
                </select>

                <br>

            <label>Name : </label>
            <input type="text" name="product_name"
                value="<?php echo $product->__get("product_name")?>">
            
            <br>

            <label>Subject : </label>
            <input type="text" name="product_subject"
                value="<?php echo $product->__get("product_subject")?>">

            <br>

            <label>Description : </label>
            <input type="text" name="product_description"
                value="<?php echo $product->__get("product_description")?>">

            <br>

            <label>Price : </label>
            <input type="text" name="product_price"
                value="<?php echo $product->__get("product_price")?>">

            <br>

            <label>Image_1 : </label>
            <input type="file" name="product_image_1">

            <br>
            
            <label>Image_2 : </label>
            <input type="file" name="product_image_2">

            <br>
            <label>Image_3 : </label>
            <input type="file" name="product_image_3">

            <br>

            <input type="submit" value="Edit">
        </form>
    </body>
</html>
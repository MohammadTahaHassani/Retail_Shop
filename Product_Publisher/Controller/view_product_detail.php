<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
        <h2>
            <?php echo $product_detail->__get("product_name")?>
        </h2>

        <h3>
            <?php echo $product_detail->__get("product_subject")?>
        </h3>

        <h4>
            <?php echo $product_detail->__get("product_category_information")->__get("category_name")?>
        </h4>

        <p>
            City : <?php echo $product_detail->__get("product_city_published")?>
        </p>

        <br>

        <p>
            Description : <?php echo $product_detail->__get("product_description")?>
        </p>

        <br>

        <p>Images : </p>
        <img src="<?php echo $product_detail->__get("product_image_1")?>">
        <br>
        <img src="<?php echo $product_detail->__get("product_image_2")?>">
        <br>
        <img src="<?php echo $product_detail->__get("product_image_3")?>">

        <br>

        <p>
            City : <?php echo $product_detail->__get("product_city_published")?>
        </p>

        <br>

        <p>
            Price : <?php echo $product_detail->__get("product_price")?>
        </p>

        <br>

        <p>Phone Number Of Owner : 
            <?php echo $product_detail->__get("product_user_information")->__get("user_phone")?>
        </p>

        <p>Address Of Owner : 
        <?php echo $product_detail->__get("product_user_information")->__get("user_address")?>
        </p>
    </body>
</html>
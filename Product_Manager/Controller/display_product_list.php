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
        <input type="hidden" name="action" value="advertisement_search">

        <label>Search : </label>
        <input type="text" name="search_text">

        <input type="submit" value="Search">
    </form>

    <hr>

        <table>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Product Subject</th>
            <th>Product Description</th>
            <th>Product Price</th>
            <th>Product Publish</th>
            <th>Product City Published</th>
            <th>Product Image 1</th>
            <th>Product Image 2</th>
            <th>Product Image 3</th>
            <th>Advertisement Status</th>
                <?php foreach($products as $product):?>
                    <tr>
                        <td>
                            <?php echo $product->__get("product_id")?>
                        </td>
                        <td>
                            <?php echo $product->__get("product_name")?>
                        </td>
                        <td>
                            <?php echo $product->__get("product_subject")?>
                        </td>
                        <td>
                            <?php echo $product->__get("product_description")?>
                        </td>
                        <td>
                            <?php echo $product->__get("product_price")?>
                        </td>
                        <td>
                            <?php echo $product->__get("product_publish")?>
                        </td>
                        <td>
                            <?php echo $product->__get("product_city_published")?>
                        </td>
                        <td>
                            <img src="<?php echo $product->__get("product_image_1")?>">
                        </td>
                        <td>
                            <img src="<?php echo $product->__get("product_image_2")?>">
                        </td>
                        <td>
                            <img src="<?php echo $product->__get("product_image_3")?>">
                        </td>

                        <td>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="action" value="edit_product_status">
                                <input type="hidden" name="product_id" 
                                    value="<?php echo $product->__get("product_id")?>">

                                <select name="product_status_id">
                                    <?php foreach($publishs as $publish):?>
                                        <option <?php if($product->__get("product_status") == $publish->__get("publish_id")):?>
                                                    selected='selected'
                                                <?php endif?>  
                                            value="<?php echo $publish->__get("publish_id")?>">
                                            <?php echo $publish->__get("publish_description")?>
                                        </option>
                                    <?php endforeach;?>
                                </select>

                                <input type="submit" value="Edit">
                            </form>
                        </td>
                    </tr>
                <?php endforeach?>
        </table>
    </body>
</html>
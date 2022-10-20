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
            <th>Name</th>
            <th>City</th>
            <th>Category</th>
            <th>Image</th>
            <th>Sunject</th>
            <th>Price</th>
            <th>Description</th>
            <th>Status</th>
            <?php foreach($products as $product):?>
                <tr>
                    <td>
                        <?php echo $product->__get("product_name")?>
                    </td>
                    
                    <td>
                        <?php echo $product->__get("product_city_published")?>
                    </td>

                    <td>
                        <?php echo $product->__get("product_category_information")->__get("category_name")?>
                    </td>

                    <td>
                        <img src="<?php echo $product->__get("product_image_1")?>">
                    </td>
                    
                    <td>
                        <?php echo $product->__get("product_subject")?>
                    </td>
                    
                    <td>
                        <?php echo $product->__get("product_price")?>
                    </td>
                    
                    <td>
                        <?php echo $product->__get("product_description")?>
                    </td>
                    <td>
                        <?php 
                            if($product->__get("product_status_id") == 1){
                                echo "Wating";
                            }else{
                                echo "Published";
                            }
                        ?>
                    </td>

                    <td>
                        <form action="index.php" method="POST">
                            <input type="hidden" name="action" value="edit_personal_advertisment_form">

                            <input type="hidden" name="product_id" 
                                value="<?php echo $product->__get("product_id")?>">

                            <input type="hidden" name="category_id" 
                                value="<?php echo $product->__get("product_category_information")->__get("category_id")?>">

                            <input type="hidden" name="city" 
                                value="<?php echo $product->__get("product_city_published")?>">

                            <input type="submit" value="Edit">
                        </form>
                    </td>

                    <td>
                        <form action="index.php" method="POST">
                        <input type="hidden" name="action" value="delete_personal_advertisment">

                        <input type="hidden" name="product_id" 
                            value="<?php echo $product->__get("product_id")?>">

                        <input type="submit" value="Delete">
                        
                        </form>
                    </td>

                </tr>
            <?php endforeach;?>
        </table>
    </body>
</html>
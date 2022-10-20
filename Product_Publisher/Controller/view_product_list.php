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
            <input type="hidden" name="action" value="search_product">

            <label>Search : </label>
            <input type="text" name="serach_text">

            <input type="submit" value="Search">
        </form>

        <hr>

        <h2>Categories : </h2>
        <ul>
            <?php foreach($categories as $category):?>
                <li>
                    <a href="index.php?action=display_product_list&
                        category_id=<?php echo $category->__get("category_id")?>">
                        <?php echo $category->__get("category_name")?>
                    </a>
                </li>
            <?php endforeach;?>
        </ul>

        <hr>

        Category : <?php echo $category_name?>

        <h2>Products : </h2>
        <ul>
            <?php foreach($products as $product):?>
                <?php if($product->__get("product_status_id") == 1):?>
                    <li>
                        <a href="index.php?action=display_product_detail&
                                    product_id=<?php echo $product->__get("product_id")?>">
                            <img src="<?php echo $product->__get("product_image_1")?>">
                            <?php echo $product->__get("product_name")?>    
                        </a>
                    </li>
                <?php endif;?>
            <?php endforeach;?>
        </ul>
    </body>
</html>
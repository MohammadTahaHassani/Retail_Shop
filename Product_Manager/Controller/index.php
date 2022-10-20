<?php
    include("../Model_And_Class/database.php");
    include("../Model_And_Class/product.php");
    include("../Model_And_Class/category.php");
    include("../Model_And_Class/user.php");
    include("../Model_And_Class/publish.php");
    include("../Model_And_Class/assignment.php");
    include("../Model_And_Class/process_on_product.php");
    include("../Model_And_Class/process_on_category.php");
    include("../Model_And_Class/process_on_user.php");
    include("../Model_And_Class/process_on_publish.php");
    include("../Model_And_Class/process_on_assignment.php");
    include("../Model_And_Class/button_and_process_on_button.php");


    // ------------------------------ Button Section ------------------------------

    $buttons = ["Advertisements List" => "index.php?action=display_product_list",
                "Users List" => "index.php?action=display_user_list",
                "Category List" => "index.php?action=display_category_list",
                "Add Category" => "index.php?action=add_category_form"];

    ButtonAndPrcessOnButton::setButton($buttons);


    echo "<hr>";

    // ------------------------------ Action Section ------------------------------

    if(isset($_POST["action"])){
        $action = $_POST["action"];
    }else if(isset($_GET["action"])){
        $action = $_GET["action"];
    }else{
        $action = "display_product_list";
    }

    // ------------------------------ Product Section ------------------------------

    if($action == "display_product_list"){
        $publishs = ProcessOnPublish::getAllPublish();
        $products = ProcessOnProduct::showProducts();
        include("display_product_list.php");
    }

    // ------------------------------

    else if($action == "edit_product_status"){
        $product_id = $_POST["product_id"];
        $product_status_id = $_POST["product_status_id"];
        ProcessOnProduct::editStatus($product_id , $product_status_id);
        header("Location: index.php?action=display_product_list");
    }

    // ------------------------------

    else if ($action == "advertisement_search"){
        $search_text = $_POST["search_text"];
        $publishs = ProcessOnPublish::getAllPublish();
        $products = ProcessOnProduct::searchProducts($search_text);
        include("display_product_list.php");
    }

    // ------------------------------ Category Section ------------------------------

    else if($action == "add_category_form"){
        include("add_category_form.php");
    }

    // ------------------------------

    else if($action == "add_category"){
        $category_name = $_POST["category"];
        ProcessOnCategory::addCategory($category_name);
        header("Location: index.php?action=display_product_list");
    }

    // ------------------------------

    else if($action == "display_category_list"){
        $categories = ProcessOnCategory::getAllCategories();
        include("category_list_view.php");
    }

    // ------------------------------ User Section ------------------------------

    else if($action == "display_user_list"){
        $users = ProcessOnUser::getAllUser();
        $assignments = ProcessOnAssignment::getAllAssignment();
        include("user_list_view.php");
    }

    // ------------------------------

    else if($action == "change_user_status"){
        $user_id = $_POST["user_id"];
        $status_id = $_POST["status_id"];
        ProcessOnUser::editUserStatus($user_id , $status_id);
        header("Location: index.php?action=display_user_list");
    }

    // ------------------------------

    else if($action == "user_search"){
        $search_text = $_POST["search_text"];
        $users = ProcessOnUser::searchUser($search_text);
        $assignments = ProcessOnAssignment::getAllAssignment();
        include("user_list_view.php");
    }
?>
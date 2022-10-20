<?php
    include("../Model_And_Class/database.php");
    include("../Model_And_Class/product.php");
    include("../Model_And_Class/category.php");
    include("../Model_And_Class/user.php");
    include("../Model_And_Class/process_on_product.php");
    include("../Model_And_Class/process_on_category.php");
    include("../Model_And_Class/process_on_user.php");
    include("../Model_And_Class/button_and_process_on_button.php");
    include("../Model_And_Class/session_and_cookie_and_process.php");
    include("../Model_And_Class/file_and_process_on_file.php");
    include("../Pattern/pattern.php");

    // ------------------------------ Session Section ------------------------------

    SessionAndCookieAndProcessOnSessionAndCookie::setAndStartSession();

    // ------------------------------ Buuton Section ------------------------------

    $buttons_array = ["home" => "index.php",
                        "Add_product" => "index.php?action=add_product_form",
                        "Login" => "index.php?action=login_form"
                    ];
    if(isset($_SESSION["user"])){
        array_pop($buttons_array);
        $new_button = ["User_information" => "index.php?action=display_user_information",
                        "Logout" => "index.php?action=logout"];
        ButtonAndProcessOnButton::appendButton($buttons_array , $new_button);
        

        if($_SESSION["user"]["id"] == 2){
            $new_button = ["Admin Panel" => "../../Product_Manager/Controller"];
            ButtonAndProcessOnButton::appendButton($buttons_array , $new_button);
        }
    }

    $new_button = ["My_Advertisments" => "index.php?action=show_my_advertisment"];
    ButtonAndProcessOnButton::appendButton($buttons_array , $new_button);

    ButtonAndProcessOnButton::setButtonArray($buttons_array);

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

        if(isset($_POST["category_id"])){
            $category_id = $_POST["category_id"];
        }else if(isset($_GET["category_id"])){
            $category_id = $_GET["category_id"];
        }else{
            $category_id = "all";
        }

        $categories = ProcessOnCategory::getCategories();

        if($category_id == "all"){
            $products = ProcessOnProduct::showProducts();
            $category_name = "All Categries";
        }else{
            $products = ProcessOnProduct::showProductsByCategoryId($category_id);
            $category_name = ProcessOnCategory::getCategoryInformationByCategoyId($category_id)->__get("category_name");
        }

        include("view_product_list.php");
    }

    // ------------------------------

    else if($action == "display_product_detail"){
        $product_id = $_GET["product_id"];
        $product_detail = ProcessOnProduct::showProductsDetail($product_id);
        include("view_product_detail.php");
    }

    // ------------------------------

    else if($action == "add_product_form"){
        if(isset($_SESSION["user"])){
            $categories = ProcessOnCategory::getCategories();
            include("add_product_form.php");
        }else{
            include("login_form.php");
        }
    }

    // ------------------------------

    else if($action == "add_product"){
        if(isset($_SESSION["user"])){
            $error_array = array();

            if(empty($_POST["product_name"])){
                $error_array[] = "Product Name Must Not Empty";
            }if(empty($_POST["product_subject"])){
                $error_array[] = "Product Subject Must Not Empty";
            }if(empty($_POST["product_description"])){
                $error_array[] = "Product Description Must Not Empty";
            }if(empty($_POST["product_price"])){
                $error_array[] = "Product Price Must Not Empty";
            }if(empty($_FILES["product_image"]["name"][0]) || 
                empty($_FILES["product_image"]["name"][1]) || 
                empty($_FILES["product_image"]["name"][2])){
                $error_array[] = "Product Image Must Not Empty Or Can Not Be Less Than 3 Items";
            }

            if(!empty($error_array)){
                $categories = ProcessOnCategory::getCategories();
                include("add_product_form.php");
            }else{
                $category_id = $_POST["category_id"];
                $category_detail = ProcessOnCategory::getCategoryInformationByCategoyId($category_id);

                $user_id = $_SESSION["user"]["id"];
                $user_detail = ProcessOnUser::getUserInformationByUserId($user_id);

                $product_city_published = $_POST["product_city_published"];
                $product_name = $_POST["product_name"];
                $product_subject = $_POST["product_subject"];
                $product_description = $_POST["product_description"];
                $product_price = $_POST["product_price"];
                $images = $_FILES["product_image"];

                $files_destinations = FileAndProcessOnFile::uploadImage($_FILES["product_image"]);
                $image_1 = $files_destinations[0];
                $image_2 = $files_destinations[1];
                $image_3 = $files_destinations[2];

                $product = new Product($category_detail,
                                        $user_detail,
                                        $product_name,
                                        $product_city_published,
                                        $image_1,
                                        $image_2,
                                        $image_3,
                                        $product_subject,
                                        $product_price,
                                        $product_description);
                ProcessOnProduct::addNewProduct($product);
                header("Location: index.php?action=display_product_list");
            }
        }else{
            include("login_form.php");
        }
    }

    // ------------------------------

    else if($action == "search_product"){
        $search_text =$_POST["serach_text"];
        $category_name = "Search Base";
        $categories = ProcessOnCategory::getCategories();
        $products = ProcessOnProduct::searchProduct($search_text);
        include("view_product_list.php");
    }

    // ------------------------------ User Section ------------------------------

    else if($action == "login_form"){
        include("login_form.php");
    }

    // ------------------------------

    else if($action == "login"){

        $error_array = array();

        $username = $_POST["username"];
        $password = $_POST["password"];

        if(!empty($username) &&
            !empty($password)){
        $user = ProcessOnUser::validateUser($username);

            if(!empty($user)){
                if(password_verify($password,
                                    $user->__get("user_password"))){
                        if(!isset($_SESSION["user"])){
                            SessionAndCookieAndProcessOnSessionAndCookie::setAndStartSession();
                        }
                    SessionAndCookieAndProcessOnSessionAndCookie::setUserSessionAndCookie($user);
                    include("user_information.php");
                }else{
                    $error_array[] = "Invalid Password";
                }
            }else{
                $error_array[] = "Invalid Username";
            }
        }else{
            $error_array[] = "Enter Username And Password";
        }
        if(!empty($error_array)){
            include("login_form.php");
        }
    }

    // ------------------------------

    else if($action == "logout"){
        SessionAndCookieAndProcessOnSessionAndCookie::endAndDeleteSessionAndCookie();
        header("Location: index.php?action=display_product_list");
    }

    // ------------------------------

    else if($action == "display_user_information"){
        include("user_information.php");
    }

    // ------------------------------

    else if($action == "view_singup"){
        include("singup_form.php");
    }

    // ------------------------------

    else if($action == "singup"){

        $pattern_error_message = array();

        if(isset($_POST["user_name"])&&
            isset($_POST["user_family"])&&
            isset($_POST["user_phone"])&&
            isset($_POST["user_address"])&&
            isset($_POST["user_username"])&&
            isset($_POST["user_password"])){

                $user_name = $_POST["user_name"];
                $user_family = $_POST["user_family"];
                $user_phone = $_POST["user_phone"];
                $user_address = $_POST["user_address"];
                $user_username = $_POST["user_username"];
                $user_password = $_POST["user_password"];

                if(!preg_match($name_pattern , $user_name)){
                    $pattern_error_message[] = "Please Enter Correct Name";
                }if(!preg_match($family_pattern , $user_family)){
                    $pattern_error_message[] = "Please Enter Correct Family";
                }if(!preg_match($phone_pattern , $user_phone)){
                    $pattern_error_message[] = "Please Enter Correct Phone";
                }if(!preg_match($address_pattern , $user_address)){
                    $pattern_error_message[] = "Please Enter Correct Address";
                }if(!preg_match($username_pattern , $user_username)){
                    $pattern_error_message[] = "Please Enter Correct Username";
                }if(!preg_match($password_pattern , $user_password)){
                    $pattern_error_message[] = "Please Enter Correct Password";
                }if((ProcessOnUser::checkForExistUsername($user_username)) == false){
                    $pattern_error_message[] = "Username Is Alredy Exist";
                }

                if(!empty($pattern_error_message)){
                    include("singup_form.php");
                }else{
                    $user = new User($user_name,
                                    $user_family,
                                    $user_phone,
                                    $user_address,
                                    $user_username,
                                    password_hash($user_password , PASSWORD_DEFAULT));
                    ProcessOnUser::addNewUser($user);
                    include("login_form.php");
                }
            }
    }

    // ------------------------------

    else if($action == "edit_user_information_form"){
        $user_id = $_GET["user_id"];
        $user_information = ProcessOnUser::getUserInformationByUserId($user_id);
        include("edit_user_information_form.php");
    }

    // ------------------------------

    else if($action == "edit_user_information"){
        $pattern_error_message = array();

        if(isset($_POST["user_name"])&&
            isset($_POST["user_family"])&&
            isset($_POST["user_phone"])&&
            isset($_POST["user_address"])&&
            isset($_POST["user_username"])){

                $user_id = $_POST["user_id"];
                $user_name = $_POST["user_name"];
                $user_family = $_POST["user_family"];
                $user_phone = $_POST["user_phone"];
                $user_address = $_POST["user_address"];
                $user_username = $_POST["user_username"];

                $user_information = ProcessOnUser::getUserInformationByUserId($user_id);

                if(!preg_match($name_pattern , $user_name)){
                    $pattern_error_message["user_name"] = "Please Enter Correct Name";
                }if(!preg_match($family_pattern , $user_family)){
                    $pattern_error_message["user_family"] = "Please Enter Correct Family";
                }if(!preg_match($phone_pattern , $user_phone)){
                    $pattern_error_message["user_phone"] = "Please Enter Correct Phone";
                }if(!preg_match($address_pattern , $user_address)){
                    $pattern_error_message["user_address"] = "Please Enter Correct Address";
                }if(!preg_match($username_pattern , $user_username)){
                    $pattern_error_message["user_username"] = "Please Enter Correct Username";
                }if((ProcessOnUser::checkForExsistUsername($user_username)) == false){
                    $pattern_error_message["user_username_exsist"] = "Username Is Alredy Exsist";
                }if($user_username == $user_information->__get("user_username")){
                    unset($pattern_error_message["user_username_exsist"]);
                }
                if(!empty($pattern_error_message)){
                    include("edit_user_information_form.php");
                }else{
                    $user = new User($user_name,
                    $user_family,
                    $user_phone,
                    $user_address,
                    $user_username,
                    null);
                    $user->__set("user_id" , $user_id);
                    ProcessOnUser::editUserInformation($user , $user_id);
                    SessionAndCookieAndProcessOnSessionAndCookie::setUserSessionAndCookie($user);
                    include("user_information.php");
                }
            }
    }

    // ------------------------------

    else if($action == "reset_user_password_form"){
        include("reset_user_password_form.php");
    }

    // ------------------------------

    else if($action == "reset_user_password"){

        if(!empty($_POST["user_username"])&&
            !empty($_POST["user_phone"])){
                $user_username = $_POST["user_username"];
                $user_phone = $_POST["user_phone"];
                $user = ProcessOnUser::validateUserByOtherWay($user_username , $user_phone);
                if(!$user){
                    $error_message = "Invalid Username Or Phone";
                    include("reset_user_password_form.php");
                }else{
                    $user_id = $user;
                    include("set_new_user_password_form.php");
                }
            }else{
                $error_message = "Elements Cannot Be Empty";
                include("reset_user_password_form.php");

            }
    }

    // ------------------------------

    else if($action == "set_new_user_password"){
        $user_id = $_POST["user_id"];
        $password = $_POST["user_password"];
        if(!preg_match($password_pattern , $password)){
            $error_message = "Invalid Psssword";
            include("set_new_user_password_form.php");
        }else{
            ProcessOnUser::changePassword($user_id , 
                                            password_hash($password , PASSWORD_DEFAULT));
            include("login_form.php");
        }
    }

    // ------------------------------ Personal Processing Section ------------------------------


    else if($action == "show_my_advertisment"){
        if(isset($_SESSION["user"])){
            $user_id = $_SESSION["user"]["id"];
            $products = ProcessOnProduct::getProductByUserId($user_id);
            include("view_personal_advertisment.php");
        }else{
            include("login_form.php");
        }
    }

    // ------------------------------

    else if($action == "edit_personal_advertisment_form"){
        $product_id = $_POST["product_id"];
        $category_id = $_POST["category_id"];
        $city = $_POST["city"];
        $product = ProcessOnProduct::showProductsDetail($product_id);
        $categories = ProcessOnCategory::getCategories();
        include("edit_advertisment_form.php");
    }

    // ------------------------------

    else if($action == "edit_personal_advertisment"){

        $product_id = $_POST["product_id"];
        $last_product = ProcessOnProduct::showProductsDetail($product_id);

        $error_array = array();

        if(empty($_POST["product_name"])){
            $error_array[] = "Product Name Must Not Empty";
        }if(empty($_POST["product_subject"])){
            $error_array[] = "Product Subject Must Not Empty";
        }if(empty($_POST["product_description"])){
            $error_array[] = "Product Description Must Not Empty";
        }if(empty($_POST["product_price"])){
            $error_array[] = "Product Price Must Not Empty";
        }

        $category_id = $_POST["category_id"];
        $category_detail = ProcessOnCategory::getCategoryInformationByCategoyId($category_id);

        if(!empty($error_array)){
            $product = $last_product;
            $categories = ProcessOnCategory::getCategories();
            include("edit_advertisment_form.php");
            exit;
        }

        $product_city_published = $_POST["product_city_published"];
        $product_name = $_POST["product_name"];
        $product_subject = $_POST["product_subject"];
        $product_description = $_POST["product_description"];
        $product_price = $_POST["product_price"];

        if(!empty($_FILES["product_image_1"]["name"])){
           $last_file_name = $last_product->__get("product_image_1");
           $product_image_1 = FileAndProcessOnFile::uploadNewImage($_FILES["product_image_1"] , $last_file_name);
        }else{
            $product_image_1 = $last_product->__get("product_image_1");
        }
        if(!empty($_FILES["product_image_2"]["name"])){
           $last_file_name = $last_product->__get("product_image_2");
           $product_image_2 = FileAndProcessOnFile::uploadNewImage($_FILES["product_image_2"] , $last_file_name);
        }else{
            $product_image_2 = $last_product->__get("product_image_2");
        }
        if(!empty($_FILES["product_image_3"]["name"])){
           $last_file_name = $last_product->__get("product_image3");
           $product_image_3 = FileAndProcessOnFile::uploadNewImage($_FILES["product_image_3"] , $last_file_name);
        }else{
            $product_image_3 = $last_product->__get("product_image_3");
        }

        $new_product = new Product($category_detail,
                                    null,
                                    $product_name,
                                    $product_city_published,
                                    $product_image_1,
                                    $product_image_2,
                                    $product_image_3,
                                    $product_subject,
                                    $product_price,
                                    $product_description);
        $new_product->__set("product_id" , $product_id);
        ProcessOnProduct::editProduct($new_product);
        header("Location: index.php?action=show_my_advertisment");
    }

    // ------------------------------

    else if($action == "delete_personal_advertisment"){
        $product_id = $_POST["product_id"];
        $product = ProcessOnProduct::showProductsDetail($product_id);
        $images = array($product->__get("product_image_1"),
                        $product->__get("product_image_2"),
                        $product->__get("product_image_3"));
        FileAndProcessOnFile::deleteImages($images);
        ProcessOnProduct::deleteProduct($product_id);
        header("Location: index.php?action=show_my_advertisment");
    }
?>
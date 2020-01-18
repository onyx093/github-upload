<?php

    /* if($connection)
    {
        echo "Connected from functions.php";
    }
 */

 #helper functions

 function set_message($msg)
 {
     if(!empty($msg))
     {
         $_SESSION['message'] = $msg;
     }
     else{
         $msg = "";
     }
 }

 function display_message()
 {
     if(isset($_SESSION['message']))
     {
         echo $_SESSION['message'];
         unset($_SESSION['message']);
     }
 }

 function redirect($link)
 {
     header("Location: $link");
 }

 function query_result($sql)
 {
     global $connection;
     return mysqli_query($connection, $sql);
 }

 function confirm($result)
 {
     if(!$result)
     {
        global $connection;
         die("MySQL Query Failed: " . mysqli_error($connection));
     }
 }

 function escape_string($string)
 {
    global $connection;
     return mysqli_real_escape_string($connection, $string);
 }

 function fetch_array($result)
 {
     return mysqli_fetch_array($result);
 }


 #utility functions

 function get_products()
 {
    $result = query_result("SELECT * FROM products");
    confirm($result);
    if($result)
    {
        while ($row = fetch_array($result))
        {
            $products = <<<DELIMITER
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <a target="_blank" href="item.php?id={$row['product_id']}" ><img src="{$row['product_image']}" alt=""></a>
                        <div class="caption">
                            <h4 class="pull-right">\${$row['product_price']}</h4>
                            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                            </h4>
                            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                        </div>
                        <div class="ratings">
                            <p class="pull-right">15 reviews</p>
                            <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                            </p>
                        </div>
                        <a class="btn btn-primary center-block" target="_blank" href="item.php?id={$row['product_id']}">View more</a>
                    </div>
                </div>
            DELIMITER;
            //echo "{$row['product_price']} \n";
            echo $products;
        }
    }
 }

 function get_categories()
 {
    $result = query_result("SELECT * FROM categories");
    confirm($result);
    if($result)
    {
        while ($row = fetch_array($result))
        {
            $categories = <<<DELIMITER
                <a href="category.php?id={$row['cat_id']}" class="list-group-item">{$row['cat_title']}</a>
            DELIMITER;
            echo $categories;
        }
    }
 }

 function get_products_in_cat_page()
 {
    $result = query_result("SELECT * FROM products WHERE product_category_id = " . escape_string($_GET['id']));
    confirm($result);
    if($result)
    {
        while ($row = fetch_array($result))
        {
            $products = <<<DELIMITER
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['product_short_desc']}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
            DELIMITER;
            echo $products;
        }
    }
 }

 function get_products_in_shop_page()
 {
    $result = query_result("SELECT * FROM products");
    confirm($result);
    if($result)
    {
        while ($row = fetch_array($result))
        {
            $products = <<<DELIMITER
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['product_short_desc']}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
            DELIMITER;
            echo $products;
        }
    }
 }

 function login_user()
 {
     if(isset($_POST['submit']))
     {
        $username = $_POST['username'];
        $password = escape_string($_POST['password']);

        $query = query_result("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'");
        confirm($query);

        if(mysqli_num_rows($query) == 0)
        {
            set_message("Your username or password is not found");
            redirect("login.php");
        }
        else{
            set_message("Welcome to the admin section, {$username}");
            redirect("admin");
        }
     }
 }
 
?>
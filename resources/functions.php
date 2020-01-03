<?php

    /* if($connection)
    {
        echo "Connected from functions.php";
    }
 */

 #helper functions

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
                        <img src="{$row['product_image']}" alt="">
                        <div class="caption">
                            <h4 class="pull-right">\${$row['product_price']}</h4>
                            <h4><a href="product.html">{$row['product_title']}</a>
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
                        <a class="btn btn-primary center-block" target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">Buy Now</a>
                    </div>
                </div>
            DELIMITER;
            //echo "{$row['product_price']} \n";
            echo $products;
        }
    }
 }
 
?>
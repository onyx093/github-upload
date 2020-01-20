<?php

    require_once("../resources/config.php");

    if(isset($_GET['add']))
    {
        $query = query_result("SELECT * FROM products WHERE product_id = " . escape_string($_GET['add']));
        confirm($query);
        while ($row = fetch_array($query))
        {
            if($row['product_quantity'] > $_SESSION['product_' . $_GET['add']])
            {
                $_SESSION['product_' . $_GET['add']] += 1;
            }
            else{
                set_message("We only have " . $row['product_quantity'] . " " . $row['product_title'] . " available");
            }
        }
        //$_SESSION['product_' . $_GET['add']] += 1;
        redirect($_SERVER['HTTP_REFERER']);
    }

    if(isset($_GET['remove']))
    {
        if($_SESSION['product_' . $_GET['remove']] > 0)
        {
            $_SESSION['product_' . $_GET['remove']]--;
        }
        else{
            unset($_SESSION['grand_total']);
            unset($_SESSION['item_count']);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    if(isset($_GET['delete']))
    {
        $_SESSION['product_' . $_GET['delete']] = 0;
        unset($_SESSION['product_' . $_GET['delete']]);
        unset($_SESSION['grand_total']);
        unset($_SESSION['item_count']);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function cart()
    {
        $grandTotal = 0;
        $itemCount = 0;
        foreach ($_SESSION as $key => $value)
        {
            if(substr($key, 0, 8) === "product_")
            {
                if($value > 0)
                {
                    $id = substr($key, 8);
                    $query = query_result("SELECT * FROM products WHERE product_id=". escape_string($id));
                    confirm($query);
                    while($row = fetch_array($query))
                    {
                        $subTotal = bcmul($value, $row['product_price'], 2);
                        $grandTotal += $subTotal;
                        $itemCount += $value;
                        $products = <<<DELIMITER
                            <tr>
                                <td>{$row['product_title']}</td>
                                <td>\${$row['product_price']}</td>
                                <td>{$value}</td>
                                <td>\${$subTotal}</td>
                                <td>
                                    <a class="btn btn-warning" href="cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus" ></span></a>
                                    <a class="btn btn-success" href="cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus" ></span></a>
                                    <a class="btn btn-danger" href="cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove" ></span></a></td>
                            </tr>
                        DELIMITER;
                        echo $products;
                    }
                }
            }
        }
        $_SESSION['grand_total'] = $grandTotal;
        $_SESSION['item_count'] = $itemCount;
    }



<?php

    require_once("../resources/config.php");
    require_once("cart.php");
    include(TEMPLATE_FRONT . DS . "header.php");
?>


    <!-- Page Content -->
    <div class="container">

    <h3 class="bg-warning" ><?php display_message(); ?></h3>

<!-- /.row --> 

<div class="row">
    <h1>Checkout</h1>

<form action="">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>
            <?php cart(); ?>
        </tbody>
    </table>
</form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?php echo isset($_SESSION['item_count']) ? $_SESSION['item_count']:"0" ?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">$<?php echo isset($_SESSION['grand_total']) ? $_SESSION['grand_total']:"00.00" ?></span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->


 <?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>

 <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

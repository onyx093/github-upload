<div class="col-md-3">
    <p class="lead">Shop Name</p>
    <div class="list-group">
        <?php

            $query = "SELECT * FROM categories";
            $result = mysqli_query($connection, $query);

            if($result)
            {

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<a href=\"\#\" class=\"list-group-item\">{$row['cat_title']}</a>";
                }

            }
            else{
                die("MYSQL Query Failed: " . mysqli_error());
            }

        ?>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi sequi ad, eius, quidem facilis sed quod provident porro eaque maiores deleniti natus? Voluptate ipsam explicabo natus. Hic et rem aspernatur?
        Nulla commodi harum minima sed perspiciatis eligendi, consectetur quasi odit officia sunt! Praesentium est vero, molestiae totam, voluptates, laboriosam ratione inventore in error rem vel veniam dignissimos enim impedit qui.
        Dignissimos, laboriosam nostrum et, est quod quam quaerat totam voluptatibus aliquid soluta at debitis dolore repellendus sed veniam corporis voluptates excepturi aperiam eius, fuga maiores! Soluta labore quos iure ratione!</p>
    </div>
</div>
<?php

$category = str_replace("/Cakes/products/","",$_SERVER["REQUEST_URI"]);
$category = str_replace(".html","",$category);
$category = strtoupper($category[0]).substr($category,1);

if (!($prod_query = mysqli_query($link, "SELECT * FROM products WHERE product_category='".$category."' ORDER BY product_id DESC")))
{
    die('Неверный запрос: ' . mysqli_error($link));
}

while ($product = mysqli_fetch_array($prod_query)) {
    echo '<div class="col-xs-6 col-sm-4 col-md-3">';
        echo '<div class="thumbnail">';
            echo '<div class="caption">';
                echo '<h3><a href"#">'.$product['product_name'].'</a></h3>';
            echo '</div>';
            echo '<div class="item-image">';
               echo '<img src="'.$product['product_img'].'" alt="" class="img-responsive">';
                /*<!--<a href="#">
                    <span class="fa-stack cart-icon fa-lg">
                        <span class="fa fa-square fa-stack-2x"></span>
                        <span class="fa fa-cart-plus fa-stack-1x"></span>
                    </span>
                </a>-->*/
             echo '</div>';
         echo '</div>';
    echo '</div>';
}

?>

<?php

    if ($sub_query = mysqli_query($link, "SELECT `product_subcategory` FROM `products` WHERE `product_category`='Cakes' GROUP BY `product_subcategory`"))
    {
        $i = 0;
        while ($cake = mysqli_fetch_array($sub_query)) {
            if (!($prod_query = mysqli_query($link, "SELECT * FROM products WHERE product_subcategory='".$cake['product_subcategory']."' ORDER BY product_id DESC")))
            {
                die('Неверный запрос: ' . mysqli_error($link));
            }

            if ($i == 0)
                echo '<div class="row text-center tab-pane fade in active" id="'.$cake['product_subcategory'].'">';
            else
                echo '<div class="row text-center tab-pane fade" id="'.$cake['product_subcategory'].'">';
            while ($product = mysqli_fetch_array($prod_query)) {
                echo '<div class="col-xs-6 col-sm-4 col-md-3">';
                    echo '<div class="thumbnail">';
                        echo '<div class="caption">';
                            echo '<h3><a href="#">'.$product['product_name'].'</a></h3>';
                        echo '</div>';
                        echo '<div class="item-image">';
                           echo '<img src='.$product['product_img'].' alt="" class="img-responsive">';
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
            echo '</div>';
            $badges[$cake['product_subcategory']] = mysqli_num_rows($prod_query);
            $i++;
        }
    }
    else
    {
        die('Неверный запрос: ' . mysqli_error($link));
    }
?>
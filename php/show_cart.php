<?php
    $fillings_count = 0;
    $products_count = 0;
    if(isset($_COOKIE['fillings'])) {
        $fillings = json_decode($_COOKIE['fillings'], true);
        $fillings_count = count($fillings);
    }
    if(isset($_COOKIE['products'])) {
        $products = json_decode($_COOKIE['products'], true);
        $products_count = count($products);
    }

    $cart_count = $fillings_count + $products_count;

    echo '<li class="dropdown">';
        echo '<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">';
            echo '<i class="fa fa-shopping-cart fa-lg"></i>';
            echo '                        Корзина
                                          ';
            echo '<span class="badge">'.$cart_count.'</span>';
        echo '</a>';
        /*if ($cart_count > 0){*/
            echo '<ul class="dropdown-menu dropdown-cart" role="menu">';
            echo '<li class="cart-category">';
                echo 'Товары';
            echo '</li>';
            echo '<li class="divider" id="cart-divider-product"></li>';
                if ($products_count > 0){
                    foreach ($products as $value) {
                        if ($prod_query = mysqli_query($link, "SELECT * FROM `products` WHERE `product_id`=".$value)){
                            $product = mysqli_fetch_array($prod_query);
                            echo'<li class="product" id="cart-product-'.$product['product_id'].'">';
                                echo'<span class="item">';
                                    echo'<span class="item-left">';
                                        echo'<img src="'.$product['product_img'].'" alt="" />';
                                        echo'<span class="item-info">';
                                            echo'<span>'.$product['product_name'].'</span>';
                                        echo'</span>';
                                    echo'</span>';
                                    echo'<span class="item-right">';
                                        echo'<button class="btn btn-xs btn-danger pull-right">x</button>';
                                    echo'</span>';
                                echo'</span>';
                            echo'</li>';
                        }
                    }
                }
                else {
                    echo '<i id="i_product">Товары не выбраны</i>';
                    echo '<br>';
                }
            echo '<br>';
            echo '<li class="cart-category">';
                echo 'Начинки';
            echo '</li>';
            echo '<li class="divider" id="cart-divider-filling"></li>';
                if ($fillings_count > 0){
                    foreach ($fillings as $value) {
                        if ($fill_query = mysqli_query($link, "SELECT * FROM `fillings` WHERE `filling_id`=".$value)){
                            $filling = mysqli_fetch_array($fill_query);
                            echo'<li class="filling" id="cart-filling-'.$filling['filling_id'].'">';
                                echo'<span class="item">';
                                    echo'<span class="item-left">';
                                        echo'<img src="'.$filling['filling_img'].'" alt="" />';
                                        echo'<span class="item-info">';
                                            echo'<span>'.$filling['filling_name'].'</span>';
                                        echo'</span>';
                                    echo'</span>';
                                    echo'<span class="item-right">';
                                        echo'<button class="btn btn-xs btn-danger pull-right">x</button>';
                                    echo'</span>';
                                echo'</span>';
                            echo'</li>';
                        }
                    }
                }
                else{
                    echo '<i id="i_filling">Начинки не выбраны</i>';
                    echo '<br>';
                }
            echo '</ul>';
        /*}*/
    echo '</li>';
?>
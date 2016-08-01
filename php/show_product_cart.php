<?php
    if(!isset($_COOKIE['products'])) {
        echo '<i>Вы не выбрали ни один товар</i>';
    }
    else{
        $products = json_decode($_COOKIE['products'], true);
        foreach ($products as $value) {
            if ($prod_query = mysqli_query($link, "SELECT * FROM `products` WHERE `product_id`=".$value)){
                $product = mysqli_fetch_array($prod_query);
                echo '<li class="product" id="order-product-'.$product['product_id'].'">';
                    echo '<span class="item">';
                        echo '<span class="item-left">';
                            echo '<img src="'.$product['product_img'].'" alt="" />';
                            echo '<span class="item-info">';
                                echo '<span>'.$product['product_name'].'</span>';
                            echo '</span>';
                        echo '</span>';
                        echo '<span class="item-right">';
                            echo '<button class="btn btn-xs btn-danger pull-right">x</button>';
                        echo '</span>';
                    echo '</span>';
                echo '</li>';
            }
            else{
                die('Неверный запрос: ' . mysqli_error($link));
            }
        }
    }
?>
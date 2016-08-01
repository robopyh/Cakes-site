<?php

if ($fillings_query = mysqli_query($link, "SELECT * FROM fillings ORDER BY filling_name"))
{
    while ($filling = mysqli_fetch_array($fillings_query)) {
        echo '<div class="col-xs-6 col-sm-4 col-md-3">';
            echo '<div class="thumbnail">';
                echo '<div class="caption">';
                    echo '<h3><a href="#">'.$filling['filling_name'].'</a></h3>';
                echo '</div>';
                echo '<div class="item-image">';
                    echo '<a class="link-image" href="'.$filling['filling_img'].'" data-lightbox="fillings">';
                        echo '<img src="'.$filling['filling_img'].'" alt="" class="img-responsive">';
                    echo '</a>';
                    echo '<a href="#" class="link-icon" id="'.$filling['filling_id'].'">';
                        echo '<span class="fa-stack cart-icon fa-lg">';
                            echo '<span class="fa fa-square fa-stack-2x"></span>';
                            echo '<span class="fa fa-cart-plus fa-stack-1x"></span>';
                        echo '</span>';
                        echo '<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>';
                    echo '</a>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}
else
{
    die('Неверный запрос: ' . mysqli_error($link));
}

?>
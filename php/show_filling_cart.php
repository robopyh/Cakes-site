<?php
    if(!isset($_COOKIE['fillings'])) {
        echo '<i>Вы не выбрали ни один вариант начнинки</i>';
    }
    else{
        $fillings = json_decode($_COOKIE['fillings'], true);
        foreach ($fillings as $value) {
            if ($fill_query = mysqli_query($link, "SELECT * FROM `fillings` WHERE `filling_id`=".$value)){
                $filling = mysqli_fetch_array($fill_query);
                echo '<li class="filling" id="order-filling-'.$filling['filling_id'].'">';
                    echo '<span class="item">';
                        echo '<span class="item-left">';
                            echo '<img src="'.$filling['filling_img'].'" alt="" />';
                            echo '<span class="item-info">';
                                echo '<span>'.$filling['filling_name'].'</span>';
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
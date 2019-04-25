<?php
function price ($cat_price)
{
    ceil($cat_price);
    if ($cat_price < 1000)
        {
            echo $cat_price." &#x20bd;";
        }
    elseif ($cat_price >= 1000 ) 
        {
        echo number_format($cat_price, 0, ',', ' ')." &#x20bd;";
        }

}



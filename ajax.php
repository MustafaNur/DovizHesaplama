<?php

    extract($_POST); // extract fonksiyonu ile değişkenleri gelen isimleriyle kullanılır hale getirdik
    if ($POST) { //post işlemi varsa
        echo "Euro=". $euro_buying." ". "USD=".$usd_buying;
    }
?>
<?php

    $imagesArr = ["berlins_wall","gate", "night","museum", "parliament"];
    echo "<div class=\"galery\">";

    foreach($imagesArr as $img) {
            echo "<a href=\"./img/" . $img . "\" target=\"_blank\"><img src=\"./img/" . $img . ".jpg\" alt=\"$img\" title=\"$img\"/> </a>";
        }
    echo "</div>";
?>
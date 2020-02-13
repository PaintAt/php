<?php
    $rootDirectory = array(
        "pages" => [
            "homePage" => "Domovská stránka",
            "coven" => "Coven expanze",
            "gameModes" => "Herní módy",
            "howToPlay" => "Jak hrát",
            "roles" => "Role"
        ],
        "visitors" => [
            "visitingBook" => "Kniha navštěv"
        ]
    );

    echo "<nav >"
       ."<div class=\"subMenu\">";
        foreach($rootDirectory as $folder => $pages) {
            foreach($pages as $file => $page) {
                    echo "<a href=\"?category=$folder&page=$file\"> $page </a>";
            }
        }
    echo "</div>";
    echo "<div class=\"registrationMenu\">"
            ."<a href=\"?category=visitors&page=registration\"> Registrace </a>"
        ."</div>"
    ."</nav>";
?>
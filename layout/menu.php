<?php
    $rootDirectory = array(
        "pages" => [
            "homePage" => "Domovská stránka",
            "galery" => "Galerie",
            "info" => "Informace",
            "howToPlay" => "Jak hrát",
            "roles" => "Role"
        ],
        "visitors" => [
            "visitingBook" => "Kniha navštěv"
        ]
    );

    echo "<nav class=\"menu\">"
       ."<div class=\"subMenu\">";
        foreach($rootDirectory as $folder => $pages) {
            foreach($pages as $file => $page) {
                if($_GET["page"] == $file) {
                    echo "<a href=\"?category=$folder&page=$file\" class=\"active\"> $page </a>";
                }
                else {
                    echo "<a href=\"?category=$folder&page=$file\" class=\"linkMenu\"> $page </a>";
                }
            }
        }
    echo "</div>";
    echo "<div class=\"registrationMenu\">"
            ."<a href=\"?category=visitors&page=registration\"  class=\"linkRegistration\"> Registrace </a>"
        ."</div>"
    ."</nav>";
?>
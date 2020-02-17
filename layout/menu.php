<?php
    $rootDirectory = array(
        "pages" => [
            "homePage" => "Domovská stránka",
            "galery" => "Galerie",
            "video" => "Video prohlídka",
            "germany" => "Německo",
            "history" => "Historie Německa"
        ],
        "visitors" => [
            "visitingBook" => "Kniha navštěv"
        ]
    );

    echo "<nav class=\"menu\">"
       ."<div class=\"subMenu\">";
        foreach($rootDirectory as $folder => $pages) {
            foreach($pages as $file => $page) {
                activePage($folder, $file, $page);
            }
        }
        echo"<div class=\"registrationMenu\">";
            activePage("visitors", "registration", "Registrace");
        echo" </div>";
    echo "</div>"
    ."</nav>";

    /* Aktivní stránce přiděl class="active"; */
    function activePage($folder, $file, $page) {
        $urlPath = isSet($_GET["page"]) ? $_GET["page"] : "";        
        if($urlPath == $file) {
            echo "<a href=\"?category=$folder&page=$file\" class=\"active\"> $page </a>";
        }
        else {
            echo "<a href=\"?category=$folder&page=$file\" class=\"linkMenu\"> $page </a>";
        }
    }
?>
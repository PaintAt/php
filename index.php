<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php

    // ZMĚNA NÁZVU STRÁNKY
    //Zjištění aktuální stránky.
    if(!isSet($_GET['page'])) {
        $title = "";
    } 
    else {
        $title = $_GET['page'];
    }
    
    
    echo "<title>";

    //Porovnání aktuální stránky pomocí switche a následné vypsání názvu stránky.
    switch($title) {
        case "homePage":
            echo "Domovská stránka";
            break;
        case "howToPlay":
            echo "Jak hrát";
            break;
        case "registration":
            echo "Registrace";
            break;
        case "roles":
            echo "Role";
            break;
        case "gameModes":
            echo "Herní módy";
            break;
        case "coven":
            echo "Coven expanze";
            break;
        case "visitingBook":
            echo "Kniha návštěv";
            break;
        default:
            echo "Town of Salem"; 
            break;
    }

    echo "</title>";
    ?>  
</head>
<body>
    <?php
        include_once("./layout/menu.php");
        include_once("./layout/header.php");

        // NAČÍTÁNÍ STRÁNKY Z URL
        $url = '';

        // Získání názvu kategorie a stránky z URL pomocí index.php?
        if (isset($_GET['category'])) {
            //Kategorie / podsložka.
            $url .= $_GET['category'] . '/';
        }  

        if (isset($_GET['page'])) {
            //Stránka + .php koncovka.
            $url .= $_GET['page'] . '.php';
        }

        //Ověření existující cesty k souboru. Pokud cesta neexistuje, načte se 404.
        if(file_exists($url)) {
            //Načte soubor za pomocí URL
            include_once($url);
        } 
        elseif (!$url) {
            //Defaultní page
            include_once("./pages/homePage.php");
        }
        else {
            //Pokud cesta k soboru není nalezena
            include_once("./errors/notFound.php");
        }

        echo "<br/>";
        include_once("./layout/footer.php");
    ?>
</body>
</html>
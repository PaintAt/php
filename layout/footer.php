<?php
        //DATUM ------------------------
        setlocale(LC_ALL, "czech.utf8");     
        $date = strftime("%A %d/%B/%Y");
        //POSLEDNÍ AKTUALIZACE ------------------------
        //Čas, kdy byl posledně navštíven web uživatelem. (ten před aktuální návštěvou)
        $pathLastVisit = "./layout/footerLastVisit.txt";
        $fileOld = fopen($pathLastVisit, "r+");
        $fLastVisitSize = filesize($pathLastVisit); 
         //Pokud je soubor prázdný, první návstěva.
        if(!$fLastVisitSize) {
                $fLastVisitSize = filesize($pathLastVisit) + 1;
        }
        //Čtení posledního příchodu na stránku.
        $timeOld = (int)fread($fileOld, $fLastVisitSize);
        //Aktuální čas v sekundách od 1.1.1970.
        $currentTime = time();
        //Zpět na začátek.
        rewind($fileOld);
        //Zápis času, kdy uživatel přišel na web.
        fwrite($fileOld, $currentTime);
        //Převod sekund na formát Hodiny
        $hours = gmdate("G", $timeOld);
        $minutes = gmdate("i", $timeOld);
        $seconds = gmdate("s", $timeOld);

        // POČET NÁVŠTĚV ------------------------
        $pathVisits = "./layout/footerVisits.txt";
        $fileFooter = fopen($pathVisits, "r+");
        $fVisitsSize = filesize($pathVisits);
        //Pokud je soubor prázdný, první návštěva.
        if(!$fVisitsSize) {
                $fVisitsSize = filesize($pathVisits) + 1;
        }
        //Čtení aktuálního počtu návštěv (+1 kvůli započítání příchodu uživatele, který se aktuálné na stránku díva).
        $textFooter = ((int)fread($fileFooter, $fVisitsSize) + 1);
        //Zpět na začátek
        rewind($fileFooter);
        fwrite($fileFooter, $textFooter);  
        
        //ZDROJE
        $resourcesArr = ["w3schools.com"=>"w3schools",];
        //OUTPUT
        echo "<footer class=\"footer\">";
                echo "<div class=\"dateAndTime\">"      
                        ."Dnes je " . $date . ", čas Vaší poslední návštěvy či aktualizace je $hours hodin $minutes minut $seconds vteřin."
                ."</div>";
                echo "<div class=\"visitors\">"
                        ."Počet návštěv: " . $textFooter
                ."</div>";
                echo "<div class=\"resources\">"
                        ."Zdroje: ";
                        foreach($resourcesArr as $page => $pageName) {
                                $page = "https://www." . $page;
                                echo "<a href=\"$page\" class=\"resource\"> $pageName </a>";
                        }
                echo "</div>";
        echo "</footer>";
?>
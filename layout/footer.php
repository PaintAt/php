<?php
        //DATUM
        setlocale(LC_ALL, "czech.utf8");     
        $datum = strftime("%A %d/%B/%Y");
        //POSLEDNÍ AKTUALIZACE
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
        //Rozdíl. Kolik času oběhlo od poslední návštěvy.
        $lastVisitInSec =  $currentTime - $timeOld;
        //Zpět na začátek.
        rewind($fileOld);
        //Zápis času, kdy uživatel přišel na web.
        fwrite($fileOld, $currentTime);
        
        //Převod sekund na formát Hodiny
        $hours = gmdate("G", $lastVisitInSec);
        $minutes = gmdate("i", $lastVisitInSec);
        $seconds = gmdate("s", $lastVisitInSec);

        echo "<p>";
        echo "Dnes je " . $datum . ", čas Vaší poslední návštěvy či aktualizace je $hours hodin $minutes minut $seconds vteřin.";
        echo "<p>";
        // POČET NÁVŠTĚV
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
        
        
        echo "Počet návštěv: " . $textFooter;
?>
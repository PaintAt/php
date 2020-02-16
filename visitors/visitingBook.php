<?php
    date_default_timezone_set('Europe/Prague'); 
    $path = "./visitors/visitingBook.txt";
    $file = fopen($path, "a+");

    echo "<h1> KNIHA NÁVŠTĚV </h1>";
    echo "<form method=\"POST\">"
            ."<fieldset>"
                ."<legend> Vyplňte všechny údaje </legend>"
                ."<label for=\"name\"> Vaše jméno: </label> <input type=\"text\" name=\"name\" id=\"name\" size=\"25\" required/> <br /> <br />"
                ."<label for=\"email\"> Váš e-mail: </label> <input type=\"email\" name=\"email\" id=\"email\" size=\"25\" required/> <br /> <br /> <br />"
                ."<label for=\"textArea\"> Vaše zpráva: <br /> </label> <textarea style=\" width: 99%\" rows=\"10\" name=\"comment\" id=\"textArea\" required></textarea> <br /> <br /> <br />"
                ."<input type=\"submit\" value=\"Odeslat\" name=\"submit\"/>"
            ."</fieldset>"
        ."</form>";

    //Formulář odeslán.
    if(isset($_POST['submit'])) {
        // Odstranění nežádoucích věcí z inputů. Možné scripty atd. (https://www.w3schools.com/php/php_form_validation.asp)
        $name = $email = $comment = "";

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = test_input($_POST["name"]);
            $email = test_input($_POST["email"]);
            $comment = test_input($_POST["comment"]);
        }
    
        //Získání aktuálního data a zápis do souboru.
        $date = Date("d. m. Y G:i:s");
        // "|" oddělaní informace od jednoho uživatele. "#" oddĚlení uživatelů.
        $write = "$date|$name|$email|$comment#";
        fwrite($file, $write);
        //Vracení se na začátek.
        rewind($file);        
        }

    //Kniha navštěvníků.
    //Počet zpráv na stránku není omezen.
    $fSize = filesize($path);
    if($fSize > 0) {
        //Načtení všech příspěvků.
        $text = fread($file, $fSize);
        //Rozdělení přízpěvků na uživatele.
        $users = explode('#', substr($text, 0, -1));
        //Vypisování od nejnovějšího příspěvku.
        for($i = count($users) - 1; $i >= 0; $i--) {
            //Rozdělení příspěvků uživatele na samostatné informace. (Datum a čas, Jméno, Email a Zprávu)
            $user = explode('|', $users[$i]);
            echo "<p class=\"userPost\">";
                echo "<span class=\"parameters\">Datum a čas:</span> $user[0] <br />"
                ."<span class=\"parameters\">Navštěvník:</span> $user[1] <br />"
                ."<span class=\"parameters\">E-mail:</span> <a href=\"mailto:$user[2]\">$user[2]</a> <br />"
                ."<span class=\"parameters\">Zpráva:</span> $user[3]";
                echo "<hr class=\"postHr\">";
            echo "</p>";
        }
    }
?>
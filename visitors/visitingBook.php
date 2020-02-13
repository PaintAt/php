<?php
    $path = "./visitors/visitingBook.txt";
    $file = fopen($path, "a+");

    echo "<form method=\"POST\">"
            ."<fieldset>"
                ."<legend> Vyplňte všechny údaje </legend>"
                ."<label for=\"name\"> Vaše jméno: </label> <input type=\"text\" name=\"name\" id=\"name\" size=\"25\" /> <br /> <br />"
                ."<label for=\"email\"> Váš e-mail: </label> <input type=\"email\" name=\"email\" id=\"email\" size=\"25\" /> <br /> <br /> <br />"
                ."<label for=\"textArea\"> Vaše zpráva: <br /> </label> <textarea cols=\"140\" rows=\"10\" name=\"comment\" id=\"textArea\"> </textarea> <br /> <br /> <br />"
                ."<input type=\"submit\" value=\"Odeslat\" name=\"submit\"/>"
            ."</fieldset>"
        ."</form>";

    //Když je formulář odeslán.
    if(isset($_POST['submit'])) {
        // Odstranění nežádoucích věcí z polí. Možné scripty atd. (https://www.w3schools.com/php/php_form_validation.asp)
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
        $date = Date("d. m. Y h:i:s");
        $write = "$date|$name|$email|$comment#";
        fwrite($file, $write);
        //Vracení se na začátek po psaní do souboru.
        rewind($file);        
        }

    //Kniha navštěvníků.
    //Počet zpráv na stránku není omezeno.
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
            echo "<p>";
            echo "Datum a čas: $user[0] <br />"
            ."Navštěvník: $user[1] <br />"
            ."E-mail: $user[2] <br />"
            ."Zpráva: $user[3]";
            echo "</p>";
        }
    }
?>
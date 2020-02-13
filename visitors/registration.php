<?php
    if(isset($_POST['submit'])) {
        // Odstranění nežádoucích věcí z polí. Možné scripty atd. (https://www.w3schools.com/php/php_form_validation.asp)
        $firstName = $familyName = $gender = $html = $css = $php = $js = $sql = $otherText = "";
        $noTechnologies = false;

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Input type text
            $firstName = test_input($_POST["firstName"]);
            $familyName = test_input($_POST["familyName"]);
            //Radio
            $gender = test_input($_POST["gender"]);
            //Select
            $rating = test_input($_POST["rating"]);
            //Checkboxes
            if(isSet($_POST["html"])) {
                $html = test_input($_POST["html"]);
            }
            if(isSet($_POST["css"])) {
                $css = test_input($_POST["css"]);
            }
            if(isSet($_POST["php"])) {
                $php = test_input($_POST["php"]);
            }
            if(isSet($_POST["js"])) {
                $js = test_input($_POST["js"]);
            }
            if(isSet($_POST["sql"])) {
                $sql = test_input($_POST["sql"]);
            }
            if(isSet($_POST["other"])) {
                $otherText = test_input($_POST["otherText"]);
            }
        }

        //Autor/ka webu
        $author;

        if($gender == "žena") {
            $author = "Autorka ";
        }
        else {
            $author = "Autor ";
        }

        $author .= "webu: $firstName $familyName";

        echo "<p class=\"author\">"
                ."$author"
            ."</p>";

        //Hodnocení webu
        echo "<p class=\"rating\">";
        if($rating == "ujde") {
            echo "Tento web $rating.";
        }
        else {
            echo "Tento web je $rating.";
        }
        echo "</p>";

         //Použité technologie
        echo "<p class=\"checkbox\">";
        echo "Použité technologie: <br />";

        function techIsSet($technology) {
            if($technology) {
                echo $technology . "<br />";
            }
        }

        if($html || $css || $php || $js || $sql || $otherText) {
            techIsSet($html);
            techIsSet($css);
            techIsSet($php);
            techIsSet($js);
            techIsSet($sql);
            techIsSet($otherText);           
        } 
        else {
            echo "Žádné";
        }
        echo "</p>";
    }
    else {
    echo "<h1>Forumulář k webu</h1>";
    echo 
    "<form method=\"POST\">"
        ."<h2> Autor </h2> "
        ."<label for=\"firstName\"> Jméno: </label> <input type=\"text\" name=\"firstName\" id=\"firstName\" size=\"30\" placeholder=\"Zadejte své křestní jméno ...\" /> <br /> <br />"
        ."<label for=\"familyName\"> Příjmení: </label> <input type=\"text\" name=\"familyName\" id=\"familyName\" size=\"30\" placeholder=\"Zadejte své příjmení...\" /> <br /> <br /> <br />"
        ."<h2> Pohlaví </h2> "
        ."<input type=\"radio\" id=\"man\" name=\"gender\" value=\"muž\" checked /> <label for=\"man\"> muž </label>"
        ."<input type=\"radio\" id=\"woman\" name=\"gender\"  value=\"žena\" /> <label for=\"woman\"> žena </label> <br /> <br />"
        ."<h2> Hodnocení webu </h2> "
        ."<select name=\"rating\">"
            ."<option value=\"úžasný\" >" . "úžasný" ."</option>"
            ."<option value=\"pěkný\" selected>" . "pěkný" ."</option>"
            ."<option value=\"ujde\" >" . "ujde" ."</option>"
            ."<option value=\"strašný\" >" . "strašný" ."</option>"
        ."</select>"
        ."<h2> Použité technologie </h2> "
        ."<input type=\"checkbox\" name=\"html\"  id=\"htmlCheckBox\" value=\"HTML\" checked /> <label for=\"htmlCheckBox\"> HTML </label> <br />"
        ."<input type=\"checkbox\" name=\"css\"  id=\"cssCheckBox\" value=\"CSS\" checked /> <label for=\"htmlCheckBox\"> CSS </label> <br />"
        ."<input type=\"checkbox\" name=\"php\"  id=\"phpCheckBox\" value=\"PHP\" checked /> <label for=\"htmlCheckBox\"> PHP </label> <br />"
        ."<input type=\"checkbox\" name=\"js\"  id=\"jsCheckBox\" value=\"JavaScript\" /> <label for=\"htmlCheckBox\"> JavaScript </label> <br />" 
        ."<input type=\"checkbox\" name=\"sql\"  id=\"sqlCheckBox\" value=\"SQL\" /> <label for=\"htmlCheckBox\"> SQL </label> <br />"
        ."<input type=\"checkbox\" name=\"other\"  id=\"otherCheckBox\" value=\"other\" checked /> <label for=\"htmlCheckBox\"> jiné </label> <input type=\"text\" name=\"otherText\" /> <br /> <br />"
        ."<input type=\"submit\" name=\"submit\" value=\"Odeslat\" />"
    ."</form>";
    }
?>
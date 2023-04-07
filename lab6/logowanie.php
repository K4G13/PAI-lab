<?php

    session_start();
    require("funkcje.php");

    if(isSet($_POST["zaloguj"])){

        if( test_input($_POST["login"]) == $osoba1->login && test_input($_POST["haslo"]) == $osoba1->haslo ){
            $_SESSION['zalogowanyImie'] = $osoba1->imieNazwisko;
            $_SESSION['zalogowany'] = 1;
            header("Location: user.php");
        }
        else if( test_input($_POST["login"]) == $osoba2->login && test_input($_POST["haslo"]) == $osoba2->haslo ){
            $_SESSION['zalogowanyImie'] = $osoba2->imieNazwisko;
            $_SESSION['zalogowany'] = 1;
            header("Location: user.php");
        }
        else{
            header("Location: index.php");
        }
    }

?>
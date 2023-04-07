<?php session_start(); ?>
<?php require("funkcje.php"); ?>
<!DOCTYPE html>
<html><head>
    <title>PHP</title>
    <meta charset='UTF-8' />
</head><body>

    <?php echo "<h1>Nasz system</h1>"; ?>

    <?php
        if(isSet($_POST["zaloguj"])){
            // echo "Przesłany login:" . test_input($_POST["login"]) . "<br>"
            //     ."Przesłane hasło:" . test_input($_POST["haslo"]);
        }
    ?>

    <?php
        if(isSet($_POST["wyloguj"])){
            $_SESSION['zalogowany'] = 0;
        }
    ?>


    <form action="logowanie.php" method="post">
        <fieldset>
            <legend>Sign in</legend>    
            <label>Login:</label>
            <input type="text" name="login"><br>
            <label>Hasło:</label>
            <input type="text" name="haslo"><br><br>
            <input type="submit" name="zaloguj" value="Zaloguj">
            <a href="user.php">user</a>
        </fieldset>
    </form>

    <form action="cookie.php" method="get">
        <fieldset>
            <legend>Cookies</legend>    
            <fieldset>
                <legend>active</legend>    
                <?php
                    if($_COOKIE) {
                        foreach ($_COOKIE as $key=>$val)
                        {
                            echo $key.' : '.$val."<br>\n";
                        }
                    }
                ?>    
            </fieldset>
            <fieldset>
                <legend>create new cookie</legend>  
                <label>Nazwa:</label>
                <input type="text" name="nazwaCookie"><br>
                <label>Wartość:</label>
                <input type="text" name="wartoscCookie"><br>
                <label>Czas:</label>
                <input type="number" name="czas"><br>
                <input type="submit" name="utworzCookie" value="Utworz Cookie">             
            </fieldset>           
        </fieldset>
    </form>

   

</body></html>
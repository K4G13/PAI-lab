<?php session_start(); ?>
<?php require("funkcje.php"); ?>
<!DOCTYPE html>
<html><head>
    <title>PHP</title>
    <meta charset='UTF-8' />
</head><body>

    <?php
        if( $_GET['czas']>=0 and $_GET['nazwaCookie']!="" and $_GET['wartoscCookie']){
            setcookie($_GET['nazwaCookie'], $_GET['wartoscCookie'], time() + ($_GET['czas']), "/");
            echo "Utworzono Cookie na czas: " . $_GET['czas'] . "s";
        }
        else{
            echo "Nieprawidłowa wartość!";
            header("Location: index.php");
        }
    ?>

    <a href="index.php">wstecz</a>

</body></html>
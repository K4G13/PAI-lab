<?php session_start();?>
<html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        fieldset{
            display: flex;
            flex-direction: column;
            width: 400px;
        }
        fieldset > *{
            margin: 5px;
        }
    </style>
</head><body>
    <?php
        if(isset($_SESSION["insertNewPracownikError"])){
            echo $_SESSION["insertNewPracownikError"];
            unset($_SESSION["insertNewPracownikError"]); 
        }
    ?>
    <form action="form06_redirect.php" method="POST">
        <fieldset>
            <legend>Wstaw nowego pracownika</legend>  
            id_prac:
            <input type="text" name="id_prac">
            nazwisko:
            <input type="text" name="nazwisko">
            <input type="submit" value="Wstaw">
            <input type="reset" value="Wyczysc">
        </fieldset>
    </form>
    <a href="form06_get.php">Lista pracowników</a>
</body></html>
<?php session_start(); ?>
<?php require("funkcje.php"); ?>
<!DOCTYPE html>
<html><head>
    <title>PHP</title>
    <meta charset='UTF-8' />
</head><body>

    <?php
        if($_SESSION['zalogowany']==1){  
            echo "<b>Zalogowano: " . $_SESSION['zalogowanyImie'] . "</b>";
        }
        else{
            header("Location: index.php");
        }
    ?>

    <form action="index.php" method="post">
        <fieldset>
            <legend>Log out</legend>
            <input type="submit" name="wyloguj" value="Wyloguj">
            <a href="index.php">home(index.php)</a>
        </fieldset>
    </form>

    <form action='user.php' method='POST' enctype='multipart/form-data'>
        <fieldset>
            <legend>Upload img</legend>
            <input type="file" name="myfile">
            <input type="submit" name="przeslijplik" value="Prześlij">
            <br><br>
            <img src="zdjeciaUzytkownikow/sample.jpg">
        </fieldset>
    </form>

    <?php
        if(isSet($_POST["przeslijplik"])){
            $currentDir = getcwd();
            $uploadDir = "/zdjeciaUzytkownikow/";
            $fileName = $_FILES['myfile']['name'];
            $fileSize = $_FILES['myfile']['size'];
            $fileTmpName = $_FILES['myfile']['tmp_name'];
            $fileType = $_FILES['myfile']['type'];
            if( $fileName != "" and
                ($fileType == 'image/png' or $fileType == 'image/jpeg' or $fileType == 'image/JPEG' or $fileType == 'image/PNG')
            ){
                $uploadPath = $currentDir . $uploadDir . $fileName;
                if( file_exists($uploadPath) ){
                    echo "Plik już istnieje!";
                }
                else if(move_uploaded_file($fileTmpName, $uploadPath))
                    echo "Zdjęcie zostało załadowane na serwer FTP";
            }
        }
    ?>


</body></html>
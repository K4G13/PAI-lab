<?php session_start();?>
<?php

    if( $_POST['id_prac']==null ){
        $_SESSION["insertNewPracownikError"] = "No 'id_prac' value";
        header("Location: form06_post.php");
        exit();
    }
    if( $_POST['nazwisko']==null ){
        $_SESSION["insertNewPracownikError"] = "No 'nazwisko' value";
        header("Location: form06_post.php");
        exit();
    }

    $link = mysqli_connect("localhost", "scott", "tiger", "instytut");
    if (!$link) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    if (isset($_POST['id_prac']) &&
        is_numeric($_POST['id_prac']) &&
        is_string($_POST['nazwisko']))
    {
        $sql = "INSERT INTO pracownicy(id_prac,nazwisko) VALUES(?,?)";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("is", $_POST['id_prac'], $_POST['nazwisko']);
        try{ 
            $result = $stmt->execute(); 
        }
        catch(Exception){
            $_SESSION["insertNewPracownikError"] = mysqli_error($link);
            header("Location: form06_post.php");
            $stmt->close();
            $link->close();
            exit();
        }   
        $stmt->close();
    }
    $link->close();

    $_SESSION["insertNewPracownikOk"] = "Inserted new PRACOWNIK: " . $_POST['id_prac'] . " " . $_POST['nazwisko'];
    header("Location: form06_get.php");
?>
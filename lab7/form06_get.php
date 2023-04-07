<?php session_start();?>
<?php

    if(isset($_SESSION["insertNewPracownikOk"])){
        echo $_SESSION["insertNewPracownikOk"] . "<br>";
        unset($_SESSION["insertNewPracownikOk"]); 
    }

    $link = mysqli_connect("localhost", "scott", "tiger", "instytut");
    if (!$link) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $sql = "SELECT * FROM pracownicy ORDER BY id_prac";
    $result = $link->query($sql);
    
    printf("<table border=\"1\">");
    printf("<tr><th>ID_PRAC</th><th>NAZWISKO</th></tr>");
    foreach ($result as $v)
        echo "<tr><td>" . $v["ID_PRAC"]."</td><td>".$v["NAZWISKO"]."</td><tr/>";
    printf("</table>");

    $result->free();
    $link->close();
?>
<a href="form06_post.php"> [+] Wstaw nowego pracownika</a>
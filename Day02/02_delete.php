<?php

$servername = "localhost";
$username = "root";
$password = "coderslab";
$basename = "cwiczenia";

//Tworzymy nowe polaczenie
$conn = new mysqli($servername, $username, $password, $basename);

//Sprawdzamy czy polaczenie sie udalo
if($conn->connect_error) {
    die("Polaczenie nieudane. blad " . $conn->connect_error);
}
echo ("Polaczenie udane.<br>");


/*
//Usuwamy element z tabeli

$table = "kino"; //nazwa tabeli

$delete = "
DELETE FROM $table WHERE
id=4
";

$result = $conn->query($delete);

if ($result === TRUE) {
    echo ("W tabeli $table zostal usuniety rekord");
} else {
    echo ("Blad podczas usuwania rekordu: " . $conn->error);
}

*/

//Niszczymy połączenie
$conn->close();
$conn = null;

?>

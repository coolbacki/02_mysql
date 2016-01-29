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


//Wstawiamy element do tabeli
/*

$table = "kino"; //nazwa tabeli

$insert = "
INSERT INTO $table(
name,
adres
)
VALUES(
'Wisla',
'Palac Wilsona'
)
";

$result = $conn->query($insert);
$last_id = $conn->insert_id;

if ($result === TRUE) {
    echo ("Do tabeli $table zostal dodany rekord o id " . $last_id);
} else {
    echo ("Blad podczas dodawania rekordu: " . $conn->error);
}
*/

//Niszczymy połączenie
$conn->close();
$conn = null;

?>

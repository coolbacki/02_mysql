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



//Tworzenie tabeli
/*
$namet = "platnosc";

$newtable = "
CREATE TABLE $namet (
id int AUTO_INCREMENT PRIMARY KEY,
typ varchar(32),
data date
)";

$result = $conn->query($newtable);

if ($result === TRUE) {
    echo ("Tabela $namet zostala stworzona poprawnie");
} else {
echo ("Blad podczas tworzenia tabeli: " . $conn->error);
}
*/

//Niszczymy połączenie
$conn->close();
$conn = null;

?>

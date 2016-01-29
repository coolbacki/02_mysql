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

//Niszczymy połączenie
$conn->close();
$conn = null;

?>

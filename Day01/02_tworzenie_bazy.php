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



//Tworzenie baz
/*
$result = $conn->query("create database cwiczenia");
var_dump($result);
*/


//Niszczymy połączenie
$conn->close();
$conn = null;

?>

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
//Aktualizujemy element do tabeli


$table = "kino"; //nazwa tabeli

$update = "
UPDATE $table SET
name='Muranow',
adres='Plac Bankowy'
WHERE id=3
";

$result = $conn->query($update);
$last_id = $conn->insert_id;

if ($result === TRUE) {
    echo ("W tabeli $table zostal zaktualizowany rekord");
} else {
    echo ("Blad podczas aktualizacji rekordu: " . $conn->error);
}

*/
//Niszczymy połączenie
$conn->close();
$conn = null;

?>

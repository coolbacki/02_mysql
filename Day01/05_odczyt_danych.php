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


$table = "kino"; //nazwa tabeli

$upload = "SELECT * FROM $table WHERE id BETWEEN 1 and 2";
$result = $conn->query($upload);
var_dump($result);

if ($result->num_rows >0) {
    echo "<table>";
    while($row = $result->fetch_assoc()){
        echo "<tr>";
        foreach ($row as $el) {
            echo("<td>$el</td>");
        }
        echo "</tr>";
    }
    echo "</table>";

} else {
    echo ("Brak wynikow");
}

/*
if ($result->num_rows >0) {
    while($row = $result->fetch_assoc()){
        var_dump($row);
        foreach ($row as $key => $el) {
            echo("$key - $el <br>");
        }
    }
} else {
    echo ("Brak wynikow");
}

*/


//Niszczymy połączenie
$conn->close();
$conn = null;

?>

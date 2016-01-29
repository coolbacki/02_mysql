<?php

$name = "";
$adres = "";

$servername = "localhost";
$username = "root";
$password = "coderslab";
$basename = "cwiczenia";

$conn = new mysqli($servername, $username, $password, $basename);

if($conn->connect_error) {
    die("Polaczenie nieudane. blad " . $conn->connect_error);
}
echo ("Polaczenie udane.<br>");

$table = "kino"; //nazwa tabeli


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //wywołanie metodą POST - formularz został wysłany

    if (isset($_POST['name']) && strlen(trim($_POST['name'])) > 2) { //isset - istnienie pola w formularzu
        $name = trim($_POST['name']); //strlen - dlugosc stringa     //trim - wywal biale znaki z poczatku i konca
    }

    if (isset($_POST['adres']) && strlen(trim($_POST['adres'])) > 2) {
        $adres = trim($_POST['adres']);
    }

    if ($name && $adres) {

        $insert = "
        INSERT INTO $table(
        name,
        adres
        )
        VALUES(
        '$name',
        '$adres'
        )
        ";

        $result = $conn->query($insert);
        $last_id = $conn->insert_id;

        if ($result === TRUE) {
            echo("Formularz wypelniony poprawnie. Dziekujemy!<br>");
            echo("Do tabeli $table zostal dodany rekord o id " . $last_id);
        } else {
            echo("Blad podczas dodawania rekordu: " . $conn->error);
        }

        $name = $adres = '';
    } else {
        echo('Formularz wypelniony niepoprawnie');

    }

    if (isset($_POST['delete'])) { //isset - istnienie pola w formularzu
        $deleterow = $_POST['delete']; //strlen - dlugosc stringa     //trim - wywal biale znaki z poczatku i konca
        $delete = "
            DELETE FROM $table WHERE
            id=$deleterow
             ";

        $result = $conn->query($delete);

        if ($result === TRUE) {
            echo("W tabeli $table zostal usuniety rekord");
        } else {
            echo("Blad podczas usuwania rekordu: " . $conn->error);


        }

    }

}

?>


<html>
<head>
</head>
<body>

<form method="POST">
    <fieldset>
        <legend>Dodaj kino</legend>
        <p>
            <label>
                Nazwa kina:
                <input type="text" name="name" placeholder="Wpisz nazwe kina" value="<?php echo($name); ?>"></label>
        </p>
        <p>
            <label>
                adres:
                <input type="text" name="adres" placeholder="Wpis adres kina" value="<?php echo($adres); ?>">
            </label>
        </p>
        <input type="submit" value="Dodaj">
        <p>
            <?php

            $upload = "SELECT * FROM $table";
            $result = $conn->query($upload);
            if ($result->num_rows >0) {
                echo "<table border='1'>";
                while($row = $result->fetch_assoc()){
                    echo "<tr>";
                    foreach ($row as $key => $el) {
                        echo("<td>$el</td>");
                    }
                    echo "<td>" ?>


        <form method='POST'>
            <input type='hidden' name='delete' value='<?php echo"$row[id]"?>'>
            <input type='submit' value='usun'>
        </form>


                <?php
                echo("</td></tr>");
                }
                echo "</table>";

            } else {
                echo("Brak wynikow");
            }

            $conn->close();
            $conn = null;
            ?>
        </p>




    </fieldset>
</form>

</body>
</html>
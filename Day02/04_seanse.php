<?php
$servername = "localhost";
$username = "root";
$password = "coderslab";
$basename = "CINEMAS";
$conn = new mysqli($servername, $username, $password, $basename);
if ($conn->connect_error) {
    die("Polaczenie nieudane. blad " . $conn->connect_error);
}
echo("Polaczenie udane.<br>");

$cinema = "";
$movie = "";
$tableC = "Cinemas";
$tableM = "Movies";
$tableS = "seans";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cinema']) && $_POST['cinema'] > 0) {
        $cinema = $_POST['cinema'];
    }
    if (isset($_POST['movie']) && $_POST['movie'] > 0) {
        $movie = $_POST['movie'];
    }
    if ($cinema && $movie) {
        $insert = "
        INSERT INTO $tableS(
        cinema_id,
        movie_id
        )
        VALUES(
        '$cinema',
        '$movie'
        )
        ";
        $result = $conn->query($insert);
        $last_id = $conn->insert_id;
        if ($result === TRUE) {
            echo("<br>Formularz wypelniony poprawnie. Dziekujemy!<br>");
            echo("Do tabeli $tableS zostal dodany rekord o id " . $last_id);
        } else {
            echo("Blad podczas dodawania rekordu: " . $conn->error);
        }
        $cinema = $movie = '';
    } else {
        echo('Formularz wypelniony niepoprawnie');
    }
    if (isset($_POST['delete']) && $_POST['action'] == "usun") {
        $deleterow = $_POST['delete'];
        $delete = "
            DELETE FROM $tableS WHERE
            s_id=$deleterow
             ";
        $result = $conn->query($delete);
        if ($result === TRUE) {
            echo("W tabeli $tableS zostal usuniety rekord");
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
                <legend>Wprowadz filmy do kin</legend>
                <p>
                    Kino:
                    <select name="cinema">
                        <option value='0'>Wybierz kino</option>
                        <?php
                        $upload = "SELECT * FROM $tableC";
                        $result = $conn->query($upload);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='$row[id]'>$row[c_name]</option>";
                            }
                        }
                        ?>
                    </select>
                </p>
                <p>
                    Film:
                    <select name="movie">
                        <option value='0'>Wybierz film</option>
                        <?php
                        $upload = "SELECT * FROM $tableM";
                        $result = $conn->query($upload);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='$row[id]'>$row[m_name]</option>";
                            }
                        }
                        ?>
                    </select>
                </p>
                <input type="submit" value="wprowadz film">
                <p>
                    <?php
                    echo("Tabela $tableS <br>");
                    $upload = "SELECT s_id, c_name, m_name  FROM $tableS
                    JOIN $tableC ON $tableS.cinema_id=$tableC.id
                    JOIN $tableM ON $tableS.movie_id=$tableM.id
                    ORDER BY s_id";

                    $result = $conn->query($upload);
                    if ($result->num_rows > 0) {
                    echo "<table border='1'>";
                    while ($row = $result->fetch_assoc()){
                    echo "<tr>";
                    foreach ($row as $key => $el) {
                        echo("<td>$el</td>");
                    }
                    echo "<td>" ?>
                        <form method='POST'>
                            <input type='hidden' name='delete' value='<?php echo "$row[s_id]" ?>'>
                            <input type='submit' name='action' value='usun'>
                        </form>
                <?php
                echo("</td></tr>");
                }
                echo "</table>";
                } else {
                    echo("Brak wynikow - $tableS");
                }
                $conn->close();
                $conn = null;
                ?>
                </p>

            </fieldset>
        </form>

    </body>
</html>
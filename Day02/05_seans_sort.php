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
    if (isset($_POST['cinema'])) {
        $cinema = $_POST['cinema'];
    }
    if (isset($_POST['movie'])) {
        $movie = $_POST['movie'];
    }
}
?>
<html>
    <head>
    </head>
    <body>
        <form method="POST">
            <fieldset>
                <legend>Wybierz kino / film</legend>
                <p>
                    Kino:
                    <select name="cinema">
                        <option value=''>Wszystkie kina</option>
                        <?php
                        $upload = "SELECT * FROM $tableC";
                        $result = $conn->query($upload);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()){
                                echo("<option value='$row[c_name]'");
                                echo $cinema == $row['c_name'] ? ' selected' : '';
                                echo(">$row[c_name]</option>");
                            }
                        }
                        ?>
                    </select>
                </p>
                <p>
                    Film:
                    <select name="movie">
                        <option value=''>Wszystkie filmy</option>
                        <?php
                        $upload = "SELECT * FROM $tableM";
                        $result = $conn->query($upload);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()){
                                echo("<option value='$row[m_name]'");
                                echo $movie == $row['m_name'] ? ' selected' : '';
                                echo(">$row[m_name]</option>");
                            }
                        }
                        ?>
                    </select>
                </p>
                <input type="submit" value="sortuj">
                <p>
                    <?php
                    $sort = "";
                    if($cinema == "" && $movie == ""){
                        $sort = "";
                    } elseif($cinema == "" && $movie != ""){
                        $sort = "WHERE m_name LIKE '$movie'";
                    } elseif($cinema != "" && $movie == ""){
                        $sort = "WHERE c_name LIKE '$cinema'";
                    } else{
                        $sort = "WHERE c_name LIKE '$cinema' AND m_name LIKE '$movie'";
                    }

                    echo("Tabela $tableS <br>");
                    $upload = "SELECT c_name, m_name  FROM $tableS
                    JOIN $tableC ON $tableS.cinema_id=$tableC.id
                    JOIN $tableM ON $tableS.movie_id=$tableM.id
                    $sort
                    ORDER BY s_id
                    ";

                    $result = $conn->query($upload);
                    if ($result->num_rows > 0) {
                    echo "<table border='1'>";
                    while ($row = $result->fetch_assoc()){
                    echo "<tr>";
                    foreach ($row as $key => $el) {
                        echo("<td>$el</td>");
                    }

                echo("</tr>");
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
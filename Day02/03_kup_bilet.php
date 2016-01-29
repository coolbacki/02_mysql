<?php

$quantity = "";
$price = "";
$payment = "";

$servername = "localhost";
$username = "root";
$password = "coderslab";
$basename = "CINEMAS";

$conn = new mysqli($servername, $username, $password, $basename);

if($conn->connect_error) {
    die("Polaczenie nieudane. blad " . $conn->connect_error);
}
echo ("Polaczenie udane.<br>");

$tableT = "Tickets"; //nazwa tabeli
$tableP = "payments"; //nazwa tabeli


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //wywołanie metodą POST - formularz został wysłany

    if (isset($_POST['quantity']) && strlen(trim($_POST['quantity'])) > 0) { //isset - istnienie pola w formularzu
        $quantity = trim($_POST['quantity']); //strlen - dlugosc stringa     //trim - wywal biale znaki z poczatku i konca
    }

    if (isset($_POST['price']) && strlen(trim($_POST['price'])) > 0) {
        $price = trim($_POST['price']);
    }

    if (isset($_POST['payment'])) {
        $payment = trim($_POST['payment']);
    }

    if ($quantity && $price) {

        $insert = "
        INSERT INTO $tableT(
        quantity,
        price
        )
        VALUES(
        '$quantity',
        '$price'
        )
        ";

        $result = $conn->query($insert);
        $last_id = $conn->insert_id;

        if ($result === TRUE) {
            echo("<br>Formularz wypelniony poprawnie. Dziekujemy!<br>");
            echo ("Do tabeli $tableT zostal dodany rekord o id " . $last_id);
        } else {
            echo ("Blad podczas dodawania rekordu: " . $conn->error);
        }

        $quantity = $price = '';
    } else {
        echo('Formularz wypelniony niepoprawnie');
    }

    if ($payment <> 0){
        $insert2 = "
        INSERT INTO $tableP(
        payment_id,
        payment_typ
        )
        VALUES(
        '$last_id',
        '$payment'
        )
        ";

        $result2 = $conn->query($insert2);

        if ($result2 === TRUE) {
            echo("<br>Formularz wypelniony poprawnie. Dziekujemy!<br>");
            echo ("Do tabeli $tableP zostal dodany rekord o id " . $last_id);
        } else {
            echo ("Blad podczas dodawania rekordu: " . $conn->error);
        }

        $payment = '';
    } else {
        echo('Platnosc niezatwierdzona');
    }

    if (isset($_POST['deleteT']) && $_POST['action'] == "usunT") { //isset - istnienie pola w formularzu
        $deleterow = $_POST['deleteT']; //strlen - dlugosc stringa     //trim - wywal biale znaki z poczatku i konca
        $delete = "
            DELETE FROM $tableT WHERE
            id=$deleterow
             ";

        $result = $conn->query($delete);

        if ($result === TRUE) {
            echo("W tabeli $tableT zostal usuniety rekord");
        } else {
            echo("Blad podczas usuwania rekordu: " . $conn->error);


        }

    }

    if (isset($_POST['deleteP']) && $_POST['action'] == "usunP") { //isset - istnienie pola w formularzu
        $deleterow = $_POST['deleteP']; //strlen - dlugosc stringa     //trim - wywal biale znaki z poczatku i konca
        $delete = "
            DELETE FROM $tableP WHERE
            payment_id=$deleterow
             ";

        $result = $conn->query($delete);

        if ($result === TRUE) {
            echo("W tabeli $tableP zostal usuniety rekord");
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
        <legend>Kub bilety</legend>
        <p>
            <label>
                Ilosc biletow:
                <input type="text" name="quantity" placeholder="" value="<?php echo($quantity); ?>"> </label>
        </p>
        <p>
            <label>
                Cena:
                <input type="text" name="price" placeholder="" value="<?php echo($price); ?>"> </label>
        </p>
        <p>
            <select name="payment">
                <option value="0">nieoplacone</option>
                <option value="1" <?php echo $payment == '1' ? ' selected' : '' ?>>karta</option>
                <option value="2" <?php echo $payment == '2' ? ' selected' : '' ?>>gotowa</option>
                <option value="3" <?php echo $payment == '3' ? ' selected' : '' ?>>przelew online</option>
            </select>
        </p>
        <input type="submit" value="Zaplac">
        <p>
            <?php
            echo("tabela tickets");
            $upload = "SELECT * FROM $tableT";
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
            <input type='hidden' name='deleteT' value='<?php echo"$row[id]"?>'>
            <input type='submit' name='action' value='usunT'>
        </form>


        <?php
        echo("</td></tr>");
                }
                echo "</table>";

            } else {
                echo("Brak wynikow - Tickets");
            }

            ?>
        </p>
        <p>
            <?php
            echo("tabela payments");
            $upload2 = "SELECT * FROM $tableP";
            $result2 = $conn->query($upload2);
            if ($result2->num_rows >0) {
                echo "<table border='1'>";
                while($row2 = $result2->fetch_assoc()){
                    echo "<tr>";
                    foreach ($row2 as $key => $el) {
                        echo("<td>$el</td>");
                    }
            echo "<td>" ?>


        <form method='POST'>
            <input type='hidden' name='deleteP' value='<?php echo"$row2[payment_id]"?>'>
            <input type='submit' name='action' value='usunP'>
        </form>


        <?php
        echo("</td></tr>");
                }
                echo "</table>";

            } else {
                echo("Brak wynikow - Payments");
            }


            $conn->close();
            $conn = null;
            ?>
        </p>



    </fieldset>
</form>

</body>
</html>
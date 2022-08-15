<?php

include 'db_connection.php';

$conn = openCon();



mysqli_query($conn, 'set names utf8');
$sql = "SELECT idmenu, nombre FROM tmenu";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // datos de salida
    while ($row = $result->fetch_assoc()) {
        $myArray[] = $row;
    }
    echo json_encode($myArray);
} else {
    echo "0 resultados";
}
$conn->close();

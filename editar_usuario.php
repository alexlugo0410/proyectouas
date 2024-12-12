<?php
include_once('conexion.php');

$dbase = new DB_CONEXION();
$conn = $dbase->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = intval($_POST['id']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $query = "UPDATE tbl_usuario SET nombreUsuario = ?, emailUsuario = ? WHERE idUsuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $nombre, $email, $idUsuario);

    if ($stmt->execute()) {
        echo "Usuario actualizado correctamente.";
    } else {
        echo "Error al actualizar el usuario: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


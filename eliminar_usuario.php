<?php
include_once('conexion.php');

$dbase = new DB_CONEXION();
$conn = $dbase->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = $_POST['id'];

    $query = "DELETE FROM tbl_usuario WHERE idUsuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idUsuario);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Usuario eliminado correctamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al eliminar el usuario."]);
    }
    $stmt->close();
    $conn->close();
}
?>
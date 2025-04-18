<?php
session_start();

// Verificar que el usuario esté autenticado
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit();
}

include("db.php");

$id_usuario = $_SESSION["id_usuario"];

$sql = "SELECT r.fecha_reserva, r.hora, s.nombre_servicio, e.estado_reserva
        FROM reserva r
        JOIN servicio s ON r.id_servicio = s.id_servicio
        JOIN estado_reserva e ON r.id_estado = e.id_estado
        WHERE r.id_usuario = ?
        ORDER BY r.fecha_reserva DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mis Reservas</title>
</head>
<body>
    <h2>Reservas de <?= htmlspecialchars($_SESSION["nombre"]) ?></h2>

    <?php if ($resultado->num_rows > 0): ?>
        <table border="1" cellpadding="10">
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Servicio</th>
                <th>Estado</th>
            </tr>
            <?php while($reserva = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $reserva["fecha_reserva"] ?></td>
                    <td><?= $reserva["hora"] ?></td>
                    <td><?= $reserva["nombre_servicio"] ?></td>
                    <td><?= $reserva["estado_reserva"] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No tienes reservas registradas.</p>
    <?php endif; ?>

    <br>
    <a href="crear_reserva.php">Hacer nueva reserva</a> |
    <a href="logout.php">Cerrar sesión</a>

</body>
</html>

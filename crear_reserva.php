<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit();
}

include("db.php");

// Obtener servicios desde la base de datos
$servicios = $conn->query("SELECT id_servicio, nombre_servicio FROM servicio");

// Procesar formulario de reserva
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $id_servicio = $_POST["id_servicio"];
    $id_usuario = $_SESSION["id_usuario"];
    $id_estado = 1; // 1 = Pendiente (debes tener este valor en estado_reserva)

    $sql = "INSERT INTO reserva (fecha_reserva, hora, id_usuario, id_servicio, id_estado)
            VALUES ('$fecha', '$hora', $id_usuario, $id_servicio, $id_estado)";

if ($conn->query($sql) === TRUE) {
    header("Location: ver_reservas.php");
    exit();
}
 else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Reserva</title>
</head>
<body>
    <h2>Crear nueva reserva</h2>
    <form method="POST" action="">
        <label>Fecha:</label><br>
        <input type="date" name="fecha" required><br><br>

        <label>Hora:</label><br>
        <input type="time" name="hora" required><br><br>

        <label>Servicio:</label><br>
        <select name="id_servicio" required>
            <option value="">-- Selecciona un servicio --</option>
            <?php while($servicio = $servicios->fetch_assoc()): ?>
                <option value="<?= $servicio['id_servicio'] ?>">
                    <?= $servicio['nombre_servicio'] ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <input type="submit" value="Reservar">
    </form>
</body>
</html>

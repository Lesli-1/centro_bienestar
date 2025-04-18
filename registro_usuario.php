<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $contrasena = $_POST["contrasena"];
    $confirmar_contrasena = $_POST["confirmar_contrasena"];

    // Validaciones
    if (strlen($contrasena) < 8) {
        echo "La contraseña debe tener al menos 8 caracteres.";
        exit();
    }

    if (!preg_match("/[a-zA-Z]/", $contrasena)) {
        echo "La contraseña debe contener al menos una letra.";
        exit();
    }

    if (!preg_match("/[0-9]/", $contrasena)) {
        echo "La contraseña debe contener al menos un número.";
        exit();
    }

    if (!preg_match("/[\W_]/", $contrasena)) {
        echo "La contraseña debe contener al menos un carácter especial.";
        exit();
    }

    if ($contrasena !== $confirmar_contrasena) {
        echo "Las contraseñas no coinciden.";
        exit();
    }

    // Encriptar y guardar
    $contrasena_segura = password_hash($contrasena, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario (nombre, correo, telefono, contrasena)
            VALUES ('$nombre', '$correo', '$telefono', '$contrasena_segura')";

if ($conn->query($sql) === TRUE) {
    // Redirigir automáticamente al login
    header("Location: login.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form method="POST" action="">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo" required><br><br>

        <label>Teléfono:</label><br>
        <input type="text" name="telefono" pattern="\d{10}" title="Debe tener 10 dígitos" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="contrasena"
               pattern="(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\W_]).{8,}"
               title="Mínimo 8 caracteres, con al menos una letra, un número y un carácter especial"
               required><br><br>

        <label>Confirmar contraseña:</label><br>
        <input type="password" name="confirmar_contrasena" required><br><br>

        <input type="submit" value="Registrarse">
    </form>
</body>
</html>

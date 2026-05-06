<?php
// 🔥 DATOS DE TU BASE DE DATOS (InfinityFree)
$host = "sql305.infinityfree.com";
$user = "if0_41754671";
$pass = "x6icOspwi1F";
$db   = "if0_41754671_login";

// 🔗 CONEXIÓN
$conexion = mysqli_connect($host, $user, $pass, $db);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// 🚀 SI SE ENVÍA EL FORMULARIO
if (isset($_POST['registrar'])) {

    // 📥 DATOS DEL FORMULARIO
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 🔐 ENCRIPTAR CONTRASEÑA (RECOMENDADO)
    $password = password_hash($password, PASSWORD_DEFAULT);

    // 🔍 VERIFICAR SI EL EMAIL YA EXISTE
    $verificar = "SELECT * FROM usuarios WHERE email='$email'";
    $resultado_verificar = mysqli_query($conexion, $verificar);

    if (mysqli_num_rows($resultado_verificar) > 0) {
        echo "❌ Este correo ya está registrado";
        exit();
    }

    // 💾 INSERTAR DATOS
    $sql = "INSERT INTO usuarios (nombre, email, password) 
            VALUES ('$nombre', '$email', '$password')";

    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        // ✅ REDIRIGIR SI TODO SALE BIEN
        header("Location: login.html?registro=exito");
        exit();
    } else {
        echo "❌ Error al registrar: " . mysqli_error($conexion);
    }
}
?>
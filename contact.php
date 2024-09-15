<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Verificación del CAPTCHA
    $secretKey = "TU_CLAVE_SECRETA";
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];
    
    $verifyURL = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    
    $response = file_get_contents($verifyURL);
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        echo "Verificación CAPTCHA fallida. Por favor, intenta de nuevo.";
    } else {
        // Verificar credenciales (aquí podrías conectar con la base de datos)
        if ($username == "usuarioEjemplo" && $password == "contraseñaEjemplo") {
            echo "Inicio de sesión exitoso.";
        } else {
            echo "Credenciales incorrectas.";
        }
    }
}
?>

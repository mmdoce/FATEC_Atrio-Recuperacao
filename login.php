<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "includes/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'] ?? '';
    $senha_hash = $_POST['senha'] ?? '';

    if (empty($email) || empty($senha_hash)) {
        $_SESSION['erro_login'] = "Preencha todos os campos!";
        header("Location: login.php");
        exit;
    }

    $sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
    $result = $connection->query($sql);

    if ($result->num_rows == 1) {
        
        $user = $result->fetch_assoc();

        // se você quiser usar hash depois, aqui troca pra password_verify()
        if ($senha_hash === $user['senha_hash']) {

            $_SESSION['usuario_id'] = $user['usuario_id'];
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['perfil'] = $user['perfil'];

            header("Location: dashboard.php");
            exit;

        } else {
            $_SESSION['erro_login'] = "Senha incorreta!";
        }
    } else {
        $_SESSION['erro_login'] = "E-mail não encontrado!";
    }

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Átrio - Login</title>
    <link rel="stylesheet" href="assets/css/style_interno.css">

    <script src="https://kit.fontawesome.com/6105ef985f.js" crossorigin="anonymous"></script>
</head>
<body id="login">
    <main class="login">
        <img src="slide-bar/src/logo-atrio.jpg" alt="Logo do centro Átrio" class="logo">
        <h2 style="margin-bottom: 1em;">Login no sistema</h2>

              

        <!-- FORM CORRETO -->
        <form action="includes/valida_login.php" method="post">

            <input type="text" name="email" placeholder="E-mail" class="form-txt input-login" required><br>

            <input type="password" name="senha" placeholder="Senha" class="form-txt input-login" required><br>

            <button type="submit" class="btn-geral btn-login">Login</button>

        </form>
    </main>
</body>
</html>

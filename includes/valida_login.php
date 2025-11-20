<?php
session_start();
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email']);
    $senha_hash = trim($_POST['senha']);

    // Busca usuário
    $sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
    $result = $connection->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifica senha hash
        if ($senha_hash === $user['senha_hash']) {


            // Salva usuário na sessão
            $_SESSION['usuario_id'] = $user['usuario_id'];
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['perfil'] = $user['perfil'];

            header("Location: ../dashboard.php");
            exit;
        } else {
            header("Location: ../login.php?erro=senha");
            exit;
        }
    } else {
        header("Location: ../login.php?erro=email");
        exit;
    }
}
?>

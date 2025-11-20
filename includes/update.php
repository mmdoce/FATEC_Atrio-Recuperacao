<?php
require_once "conexao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario_id = intval($_POST['usuario_id']);
    $nome = $connection->real_escape_string($_POST['nome']);
    $email = $connection->real_escape_string($_POST['email']);
    $perfil = $connection->real_escape_string($_POST['perfil']);
    $senha_hash = $connection->real_escape_string($_POST['senha']);

    $sql = "UPDATE usuarios 
            SET nome = '$nome', email = '$email', perfil = '$perfil'
            WHERE usuario_id = $usuario_id";

    if ($connection->query($sql) === TRUE) {
        header("Location: ../acessos.php?msg=atualizado");
        exit;
    } else {
        echo "Erro ao atualizar: " . $connection->error;
    }
}
?>

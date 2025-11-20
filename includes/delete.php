<?php
require_once "conexao.php";

if (isset($_GET['usuario_id'])) {
    $usuario_id = intval($_GET['usuario_id']);

    $sql = "DELETE FROM usuarios WHERE usuario_id = $usuario_id";

    if ($connection->query($sql) === TRUE) {
        header("Location: ../acessos.php?msg=deletado");
        exit;
    } else {
        echo "Erro ao deletar: " . $connection->error;
    }
}
?>

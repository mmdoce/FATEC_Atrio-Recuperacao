<?php
require_once "conexao.php";

if (!isset($_GET['usuario_id'])) {
    die("ID inválido.");
}

$usuario_id = intval($_GET['usuario_id']);

$sql = "SELECT * FROM usuarios WHERE usuario_id = $usuario_id";
$result = $connection->query($sql);

if ($result->num_rows == 0) {
    die("Usuário não encontrado.");
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>



<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 100vh;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-size: 26px;
        font-weight: 600;
    }

    form {
        background: white;
        padding: 30px;
        border-radius: 12px;
        width: 380px;
        margin-top: 40px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-top: 8px;
        margin-bottom: 15px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 15px;
        background: #fafafa;
        transition: 0.2s;
    }

    form input:focus {
        border-color: #007bff;
        box-shadow: 0 0 4px rgba(0,123,255,0.3);
        background: white;
    }

    form button {
        width: 100%;
        padding: 14px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.2s;
    }

    form button:hover {
        background: #005fcc;
    }

    label {
        font-weight: bold;
        color: #444;
    }

    .mostrar-senha {
        margin-bottom: 15px;
        font-size: 14px;
        color: #444;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .titulo-edit {
    font-size: 26px;
    margin-bottom: 20px;
    color: #1f2937;
    font-weight: bold;
}

</style>


</head>
<body>

<h2 class="titulo-edit">Editar Usuário – ID <?= $user['usuario_id'] ?></h2>


<form action="update.php" method="POST">

    <input type="hidden" name="usuario_id" value="<?= $user['usuario_id'] ?>">

    Nome:  
    <input type="text" name="nome" value="<?= $user['nome'] ?>" required><br><br>

    Email:  
    <input type="email" name="email" value="<?= $user['email'] ?>" required><br><br>

    Perfil:  
    <input type="text" name="perfil" value="<?= $user['perfil'] ?>" required><br><br>

    Senha (deixe vazio para manter a atual):  
    <input type="password" name="senha" id="senha" value="<?= $user['senha_hash'] ?>"  ><br><br>

    <input type="checkbox" onclick="mostrarSenha()"> Mostrar senha<br><br>

    <button type="submit">Salvar</button>
</form>

<script>
function mostrarSenha() {
    let campo = document.getElementById("senha");
    campo.type = campo.type === "password" ? "text" : "password";
}
</script>



</body>
</html>
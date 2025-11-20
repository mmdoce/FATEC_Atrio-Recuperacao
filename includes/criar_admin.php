<?php
include 'conexao.php';

$nome = "Administrador";
$email = "admin@admin.com";
$senha = "123456"; // escolha a senha que quiser
$perfil = "admin";

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO Usuarios (nome, email, senha_hash, perfil)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nome, $email, $senha_hash, $perfil);

if ($stmt->execute()) {
    echo "Admin criado com sucesso!";
} else {
    echo "Erro: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

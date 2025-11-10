<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $senha_pura = $_POST['senha']; 
    $perfil = $conn->real_escape_string($_POST['perfil']);
    $registro_profissional = $conn->real_escape_string($_POST['registro_profissional'] ?? NULL);
    
    $senha_hash = password_hash($senha_pura, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Usuarios (nome, email, senha_hash, perfil, registro_profissional) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $email, $senha_hash, $perfil, $registro_profissional);

    if ($stmt->execute()) {
        header("Location: dashboard.html?msg=UsuarioCriado"); 
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
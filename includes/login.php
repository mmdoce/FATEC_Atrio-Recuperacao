<?php
include 'conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $conn->real_escape_string($_POST['email']);
    $senha_digitada = $_POST['senha'];

    $sql = "SELECT usuario_id, senha_hash, perfil, nome FROM Usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();
        $senha_hash = $usuario['senha_hash'];

        if (password_verify($senha_digitada, $senha_hash)) {
            
            $_SESSION['usuario_id'] = $usuario['usuario_id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['perfil'] = $usuario['perfil']; 


            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: login.html?erro=senha");
            exit();
        }
    } else {
        header("Location: login.html?erro=usuario");
        exit();
    }
    $stmt->close();
}
$conn->close();
?>
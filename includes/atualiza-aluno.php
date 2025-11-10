<?php
include 'conexao.php'; 

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html?erro=nao_logado");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['paciente_id'])) {
    
    $paciente_id = $_POST['paciente_id'];
    
    $endereco = $conn->real_escape_string($_POST['endereco']);
    $status_cadastro = $conn->real_escape_string($_POST['status_cadastro']); 

    $sql_update = "UPDATE Pacientes SET endereco = ?, status_cadastro = ? WHERE paciente_id = ?";
    
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssi", $endereco, $status_cadastro, $paciente_id);

    if ($stmt_update->execute()) {
        header("Location: aluno-exemplo.html?id=$paciente_id&msg=sucesso");
        exit();
    } else {
        echo "Erro ao atualizar paciente: " . $stmt_update->error;
    }
    $stmt_update->close();
}
$conn->close();
?>
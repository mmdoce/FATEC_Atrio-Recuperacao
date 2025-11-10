<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $perfil_permitido = ['ADMIN', 'COORDENADOR', 'MEDICO_PSICOLOGO'];
    if (!isset($_SESSION['usuario_id']) || !in_array($_SESSION['perfil'] ?? 'GUEST', $perfil_permitido)) {
        die("Acesso negado. Você não tem permissão para criar relatórios.");
    }
    
    $usuario_id = $_SESSION['usuario_id'];
    $paciente_id = $conn->real_escape_string($_POST['paciente_id']);
    $data_sessao = $conn->real_escape_string($_POST['data_sessao']);
    $queixa_principal = $conn->real_escape_string($_POST['queixa_principal'] ?? NULL);
    $analise_sessao = $conn->real_escape_string($_POST['analise_sessao'] ?? NULL);

    $sql = "INSERT INTO Relatorios_Acompanhamento (paciente_id, usuario_id, data_sessao, queixa_principal, analise_sessao)
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissa", $paciente_id, $usuario_id, $data_sessao, $queixa_principal, $analise_sessao);

    if ($stmt->execute()) {
        header("Location: aluno-exemplo.php?id=$paciente_id&msg=RelatorioCriado");
    } else {
        echo "Erro ao salvar relatório: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
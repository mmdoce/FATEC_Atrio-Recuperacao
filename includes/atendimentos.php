<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id'] ?? 0; 
    if ($usuario_id == 0) {
        die("Erro: Usuário não logado.");
    }

    $paciente_id = $conn->real_escape_string($_POST['paciente_id']);
    $data_hora_atendimento = $conn->real_escape_string($_POST['data_hora']);
    $tipo_atendimento = $conn->real_escape_string($_POST['tipo']);
    $observacoes = $conn->real_escape_string($_POST['observacoes'] ?? NULL);

    $sql = "INSERT INTO Atendimentos (paciente_id, usuario_id, data_hora_atendimento, tipo_atendimento, observacoes)
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissa", $paciente_id, $usuario_id, $data_hora_atendimento, $tipo_atendimento, $observacoes);

    if ($stmt->execute()) {
        header("Location: agenda.html?msg=AgendamentoCriado");
    } else {
        echo "Erro ao agendar atendimento: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
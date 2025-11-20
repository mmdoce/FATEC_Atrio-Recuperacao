<?php
include 'conexao.php'; 

if (!isset($_SESSION['usuario_id'])) {

    header("Location: index.html?erro=nao_logado");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuario_id = $_SESSION['usuario_id'];
    
    $paciente_id = $conn->real_escape_string($_POST['paciente_id'] ?? NULL);
    $data_hora_atendimento = $conn->real_escape_string($_POST['data_hora'] ?? NULL);
    $tipo_atendimento = $conn->real_escape_string($_POST['tipo'] ?? NULL);
    $observacoes = $conn->real_escape_string($_POST['observacoes'] ?? NULL);

   
    if (empty($paciente_id) || empty($data_hora_atendimento) || empty($tipo_atendimento)) {
        header("Location: agenda.php?erro=campos_vazios");
        exit();
    }
    

    $sql = "INSERT INTO Atendimentos (paciente_id, usuario_id, data_hora_atendimento, tipo_atendimento, observacoes)
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissa", $paciente_id, $usuario_id, $data_hora_atendimento, $tipo_atendimento, $observacoes);

    if ($stmt->execute()) {
        header("Location: dashboard.php?msg=AgendamentoCriado");
        exit();
    } else {
        echo "Erro ao agendar atendimento: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
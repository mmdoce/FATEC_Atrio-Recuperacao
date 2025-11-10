<?php
include 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html?erro=nao_logado"); 
    exit();
}

$paciente_id = $_GET['id'] ?? null;
$paciente = null;

if ($paciente_id) {
    $sql = "SELECT * FROM Pacientes WHERE paciente_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $paciente_id); 
    $stmt->execute();
    $result = $stmt->get_result();
    $paciente = $result->fetch_assoc();
    $stmt->close();
}
$conn->close();
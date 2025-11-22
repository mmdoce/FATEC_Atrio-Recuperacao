<?php
require_once __DIR__ . '/conexao.php'; // $connection

$pacientes = [];

// Busca todos os pacientes cadastrados
$sql = "SELECT * FROM paciente ORDER BY nome ASC";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Verifica a última PAS
        $id_paciente = $row['id_paciente'];
        $sql_pas = "SELECT * FROM pas WHERE id_paciente = $id_paciente ORDER BY data_criacao DESC LIMIT 1";
        $res_pas = $connection->query($sql_pas);
        $ultimaPAS = $res_pas->fetch_assoc();

        // Adiciona informações ao array de pacientes
        $row['ultima_pas'] = $ultimaPAS['data_criacao'] ?? null;
        $row['tem_pas'] = $ultimaPAS ? true : false;

        $pacientes[] = $row;
    }
}

// Função para buscar paciente específico
function buscarPacientePorId($id_paciente) {
    global $connection;
    $id = intval($id_paciente);
    $sql = "SELECT * FROM pacientes WHERE id = $id";
    $res = $connection->query($sql);
    $paciente = $res->fetch_assoc();

    if ($paciente) {
        // Puxa última PAS
        $sql_pas = "SELECT * FROM pas WHERE id_paciente = $id ORDER BY data_criacao DESC LIMIT 1";
        $res_pas = $connection->query($sql_pas);
        $ultimaPAS = $res_pas->fetch_assoc();
        $paciente['ultimaPAS'] = $ultimaPAS;
    }

    return $paciente;
}

return $pacientes;

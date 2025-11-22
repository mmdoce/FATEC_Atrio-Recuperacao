<?php
session_start();
require_once 'conexao.php';

// Só permite POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../dashboard.php");
    exit;
}

// Pega dados do formulário
$id_paciente = intval($_POST['id_paciente'] ?? 0);
$queixa = $connection->real_escape_string($_POST['queixa'] ?? '');
$descricao = $connection->real_escape_string($_POST['desc-sessao'] ?? '');
$analise = $connection->real_escape_string($_POST['analise-sessao'] ?? '');
$observacao = $connection->real_escape_string($_POST['obs'] ?? '');
$espiritualidade = $connection->real_escape_string($_POST['espi'] ?? '');
$evolucao_vinculo = $connection->real_escape_string($_POST['evo-vin'] ?? '');

// Pega profissional logado
$id_profissional = $_SESSION['usuario_id'] ?? 0;

// Verifica se profissional existe
$res_prof = $connection->query("SELECT * FROM profissionais WHERE id_profissional = $id_profissional");
if ($res_prof->num_rows === 0) {
    $_SESSION['msg_erro'] = "Profissional inválido!";
    header("Location: ../PASS.php?paciente_id=$id_paciente");
    exit;
}

// Verifica se paciente existe
$res_pac = $connection->query("SELECT * FROM pacientes WHERE id_paciente = $id_paciente");
if ($res_pac->num_rows === 0) {
    $_SESSION['msg_erro'] = "Paciente inválido!";
    header("Location: ../dashboard.php");
    exit;
}

// SQL para inserir PAS
$sql = "INSERT INTO pas 
        (id_paciente, id_profissional, data_criacao, queixa_principal, descricao_sessao, analise_sessao, observacao_pas, laboterapia_espiritualidade, evolucao_vinculo_familiar)
        VALUES
        ($id_paciente, $id_profissional, NOW(), '$queixa', '$descricao', '$analise', '$observacao', '$espiritualidade', '$evolucao_vinculo')";

// Executa insert
if ($connection->query($sql)) {
    $_SESSION['msg_sucesso'] = "PAS salva com sucesso!";
} else {
    $_SESSION['msg_erro'] = "Erro ao salvar PAS: " . $connection->error;
}

// Redireciona de volta para o formulário do paciente
header("Location: ../PASS.php?paciente_id=$id_paciente");
exit;
?>

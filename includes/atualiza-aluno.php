<?php
require_once "conexao.php";

// Verifica se veio ID
if (!isset($_POST['id_paciente'])) {
    die("ID do paciente não enviado.");
}

$id_paciente = $_POST['id_paciente'];

// Campos que podem ser atualizados agora
$nome = $_POST['nome'] ?? null;
$data_nascimento = $_POST['data_nascimento'] ?? null;
$cpf = $_POST['cpf'] ?? null;
$endereco = $_POST['endereco'] ?? null;
$data_entrada = $_POST['data_entrada'] ?? null;
$nome_mae = $_POST['nome_mae'] ?? null;
$nome_pai = $_POST['nome_pai'] ?? null;
$historico_psiquiatrico = $_POST['historico_psiquiatrico'] ?? null;
$toma_medicamento = $_POST['toma_medicamento'] ?? null;
$medicamento_especificar = $_POST['medicamento_especificar'] ?? null;
$entorpecentes_usados = $_POST['entorpecentes_usados'] ?? null;
$observacao_profissional = $_POST['observacao_profissional'] ?? null;

// ---------------------------------------------------------------------
// FOTO DO PACIENTE
// ---------------------------------------------------------------------
$foto_nome_final = null;

if (!empty($_FILES['foto']['name'])) {

    // Pasta onde vai salvar
    $pasta_upload = "../uploads/";

    // Cria a pasta se não existir
    if (!is_dir($pasta_upload)) {
        mkdir($pasta_upload, 0777, true);
    }

    // Nome único para evitar conflito
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto_nome_final = "foto_" . time() . "_" . rand(1000, 9999) . "." . $ext;

    $caminho_final = $pasta_upload . $foto_nome_final;

    // Move o arquivo
    move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_final);

    // Atualiza apenas a foto
    $sql_foto = "UPDATE paciente SET foto = ? WHERE id_paciente = ?";
    $stmt_foto = $connection->prepare($sql_foto);
    $stmt_foto->bind_param("si", $foto_nome_final, $id_paciente);
    $stmt_foto->execute();
}

// ---------------------------------------------------------------------
// ATUALIZA DADOS DO PACIENTE
// ---------------------------------------------------------------------

$sql = "UPDATE paciente SET 
            nome = ?, 
            data_nascimento = ?, 
            cpf = ?, 
            endereco = ?, 
            data_entrada = ?, 
            nome_mae = ?, 
            nome_pai = ?, 
            historico_psiquiatrico = ?, 
            toma_medicamento = ?, 
            medicamento_especificar = ?, 
            entorpecentes_usados = ?, 
            observacao_profissional = ?
        WHERE id_paciente = ?";

$stmt = $connection->prepare($sql);
$stmt->bind_param(
    "ssssssssssssi", 
    $nome,
    $data_nascimento,
    $cpf,
    $endereco,
    $data_entrada,
    $nome_mae,
    $nome_pai,
    $historico_psiquiatrico,
    $toma_medicamento,
    $medicamento_especificar,
    $entorpecentes_usados,
    $observacao_profissional,
    $id_paciente
);

if ($stmt->execute()) {
    header("Location: ../aluno-ficha.php?id=" . $id_paciente);
    exit;
} else {
    echo "Erro ao atualizar: " . $connection->error;
}

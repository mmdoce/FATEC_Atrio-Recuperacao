<?php
// includes/editar-aluno.php
include 'conexao.php'; // Conexão com o banco ($connection)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recebe os dados do formulário
    $id_paciente = $_POST['id_paciente'] ?? null;
    $nome = $_POST['nome'] ?? '';
    $data_nascimento = $_POST['data_nascimento'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $data_entrada = $_POST['data_entrada'] ?? '';
    $historico_psiquiatrico = $_POST['historico_psiquiatrico'] ?? 0; // 1 ou 0
    $toma_medicamento = $_POST['toma_medicamento'] ?? 0; // 1 ou 0
    $medicamento_especificar = $_POST['medicamento_especificar'] ?? '';
    $entorpecentes_usados = $_POST['entorpecentes_usados'] ?? '';
    $nome_mae = $_POST['nome_mae'] ?? '';
    $nome_pai = $_POST['nome_pai'] ?? '';
    $observacao_profissional = $_POST['observacao_profissional'] ?? '';

    if (!$id_paciente) {
        die("Paciente não especificado!");
    }

    // Atualiza os dados no banco
    $sql = "UPDATE paciente SET
        nome = ?, 
        data_nascimento = ?, 
        cpf = ?, 
        endereco = ?, 
        data_entrada = ?, 
        historico_psiquiatrico = ?, 
        toma_medicamento = ?, 
        medicamento_especificar = ?, 
        entorpecentes_usados = ?, 
        nome_mae = ?, 
        nome_pai = ?, 
        observacao_profissional = ?
        WHERE id_paciente = ?";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param(
        "sssssiisssssi", 
        $nome, $data_nascimento, $cpf, $endereco, $data_entrada,
        $historico_psiquiatrico, $toma_medicamento,
        $medicamento_especificar, $entorpecentes_usados,
        $nome_mae, $nome_pai, $observacao_profissional, $id_paciente
    );

    if ($stmt->execute()) {
        header("Location: ../aluno-ficha.php?id=$id_paciente");
        exit;
    } else {
        echo "Erro ao atualizar paciente: " . $stmt->error;
    }

} else {
    echo "Acesso inválido!";
}

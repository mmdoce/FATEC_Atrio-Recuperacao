<?php
require_once "conexao.php";

if (!isset($_GET['id'])) {
    echo "Paciente não encontrado!";
    exit;
}

$id = intval($_GET['id']);

// BUSCAR DADOS DO PACIENTE
$sql = "SELECT * FROM paciente WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$paciente = $resultado->fetch_assoc();

if (!$paciente) {
    echo "Paciente não encontrado!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ficha do Paciente</title>
    <link rel="stylesheet" href="../assets/css/style_interno.css">
</head>
<body>

<h2>Ficha do Paciente</h2>

<p><strong>Nome:</strong> <?= $paciente['nome'] ?></p>
<p><strong>Data de Nascimento:</strong> <?= $paciente['data_nascimento'] ?></p>
<p><strong>Responsável:</strong> <?= $paciente['responsavel'] ?></p>

<?php if (!empty($paciente['foto'])): ?>
    <img src="../assets/fotos_pacientes/<?= $paciente['foto'] ?>" width="150">
<?php else: ?>
    <p><em>Nenhuma foto cadastrada</em></p>
<?php endif; ?>

<hr>

<h3>Enviar/Alterar Foto</h3>
<form action="upload_foto.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">
    <input type="file" name="foto" required>
    <button type="submit">Enviar Foto</button>
</form>

<hr>

<h3>Status</h3>
<p><strong>Ativo/Inativo:</strong> <?= $paciente['status'] ?></p>

<form action="toggle_status.php" method="POST">
    <input type="hidden" name="id" value="<?= $id ?>">
    <button type="submit">
        <?= $paciente['status'] === 'ativo' ? 'Marcar como inativo' : 'Reativar' ?>
    </button>
</form>

<hr>

<h3>Sessões PASS já realizadas</h3>

<?php
$sqlRel = "SELECT * FROM pas WHERE paciente_id = ? ORDER BY data DESC";
$stmtRel = $connection->prepare($sqlRel);
$stmtRel->bind_param("i", $id);
$stmtRel->execute();
$relatorios = $stmtRel->get_result();
?>

<?php if ($relatorios->num_rows > 0): ?>
    <ul>
        <?php while ($r = $relatorios->fetch_assoc()): ?>
            <li>
                <strong>Data:</strong> <?= $r['data'] ?> —
                <a href="ver_pass.php?id=<?= $r['id'] ?>">Ver relatório</a>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p>Nenhum PASS cadastrado.</p>
<?php endif; ?>

<hr>

<a href="novo_pass.php?paciente_id=<?= $id ?>">Criar nova sessão PASS</a>

</body>
</html>

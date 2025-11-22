<?php
include 'conexao.php';

$sql = "SELECT * FROM paciente ORDER BY nome ASC";
$result = $connection->query($sql);

if ($result->num_rows > 0):
    while ($paciente = $result->fetch_assoc()):
        $foto = !empty($paciente['foto']) ? $paciente['foto'] : 'default.png';
?>
<div class="card">
    <div class="card-header">
<img src="/assets/upload/fotos/<?= htmlspecialchars($foto) ?>" class="avatar foto-perfil-lista" alt="Foto do paciente">

    <h3><?= htmlspecialchars($paciente['nome']) ?></h3>
    </div>
    <div class="card-body">
        <div class="info-row"><strong>Id:</strong> <?= $paciente['id_paciente'] ?></div>
        <div class="info-row"><strong>Data de Entrada:</strong> <?= date('d/m/Y', strtotime($paciente['data_entrada'])) ?></div>
    </div>
    <div class="card-footer">
        <a href="aluno-ficha.php?id=<?= $paciente['id_paciente'] ?>" class="btn-ver">Ver ficha</a>
    </div>
</div>
<?php
    endwhile;
else:
    echo "<p>Nenhum paciente encontrado.</p>";
endif;
?>

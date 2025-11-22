<?php
// includes/lista.php
include 'conexao.php';

$sql = "SELECT * FROM paciente ORDER BY nome ASC";
$result = $connection->query($sql);

if ($result->num_rows > 0):
    while ($paciente = $result->fetch_assoc()):
        // Se não tiver foto, usa default.png
        $foto = !empty($paciente['foto']) ? $paciente['foto'] : 'default.png';
?>
<div class="card-paciente">
    <img src="uploads/<?= htmlspecialchars($foto) ?>" class="foto-perfil-lista" alt="Foto do paciente">
    <div class="info-paciente">
        <h3><?= htmlspecialchars($paciente['nome']) ?></h3>
        <p>Id: <?= $paciente['id_paciente'] ?></p>
        <a href="aluno-ficha.php?id=<?= $paciente['id_paciente'] ?>" class="btn-geral">Ver ficha</a>
    </div>
</div>
<?php
    endwhile;
else:
    echo "<p>Nenhum paciente encontrado.</p>";
endif;
?>

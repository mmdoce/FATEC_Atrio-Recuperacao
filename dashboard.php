<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Átrio - Dashboard PAS</title>
    <link rel="stylesheet" href="assets/css/style_interno.css">
    <link rel="stylesheet" href="slide-bar/ESTILO.css">
    
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Ícones -->
    <script src="https://kit.fontawesome.com/6105ef985f.js" crossorigin="anonymous"></script>
</head>
<body id="app">

<?php 
include 'slide-bar/sidebar.html'; 
$pacientes = include 'includes/paciente-dia.php';

// Paciente selecionado
$pacienteSelecionado = null;
if (isset($_GET['paciente_id'])) {
    $id = intval($_GET['paciente_id']);
    $pacienteSelecionado = buscarPacientePorId($id);
}
?>

<div class="page-content">
    <main class="main">
        <div class="header">
            <h2>Pacientes do dia</h2>
            <form action="#" method="get" class="busca-form">
                <input type="text" class="input busca" placeholder="Buscar paciente...">
                <button class="button fa-solid fa-magnifying-glass"></button>
            </form>
        </div>

        <nav id="filtro">
            <p>Filtrar:</p>
            <input type="date" class="input">
            <input type="number" class="input" placeholder="Idade">
            <select name="ordenacao" id="ordem" class="input">
                <option value="">Ordem alfabética</option>
                <option value="">Mais recente</option>
                <option value="">Mais antigo</option>
            </select>
        </nav>

        <!-- Lista de pacientes -->
        <section class="lista-pac" id="pac-dia">
    <?php if (empty($pacientes)) { ?>
        <p>Nenhum paciente cadastrado 😴</p>
    <?php } else { 
        foreach ($pacientes as $p) { 

            // Calcula a idade a partir de data_nascimento
            if (!empty($p['data_nascimento'])) {
                $nascimento = new DateTime($p['data_nascimento']);
                $hoje = new DateTime();
                $idade = $hoje->diff($nascimento)->y;
            } else {
                $idade = 'Não informado';
            }
    ?>
        <a href="PASS.php?id_paciente=<?= $p['id_paciente'] ?>">
            <div class="card paciente">
                <img src="<?= $p['foto'] ?? 'https://i.pinimg.com/736x/a4/d8/28/a4d8289d97adac030bab9a4e7101bb5b.jpg' ?>" 
                     alt="Foto do paciente" class="pac-icon">
                <div>
                    <h3><?= $p['nome'] ?></h3>
                    <p>Idade: <?= $idade ?></p>
                    <h4>Pendente: <?= $p['tem_pas'] ? 'Não' : 'Sim' ?></h4>
                    <p>Última PAS: <?= $p['ultima_pas'] ?? 'Nenhuma' ?></p>
                </div>
            </div>
        </a>
    <?php } ?>
    <?php } ?>
</section>

        <!-- Ficha do paciente selecionado -->
        <?php if ($pacienteSelecionado) { ?>
            <section class="ficha-paciente">
                <h2><?= $pacienteSelecionado['nome'] ?> - PAS</h2>
                <form action="includes/salvar_pas.php" method="post">
                    <input type="hidden" name="id_paciente" value="<?= $pacienteSelecionado['id'] ?>">

                    <label>Queixa Principal</label>
                    <textarea name="queixa_principal"><?= $pacienteSelecionado['ultimaPAS']['queixa_principal'] ?? '' ?></textarea>

                    <label>Descrição da Sessão</label>
                    <textarea name="descricao_sessao"><?= $pacienteSelecionado['ultimaPAS']['descricao_sessao'] ?? '' ?></textarea>

                    <label>Análise da Sessão</label>
                    <textarea name="analise_sessao"><?= $pacienteSelecionado['ultimaPAS']['analise_sessao'] ?? '' ?></textarea>

                    <label>Observações</label>
                    <textarea name="observacao_pas"><?= $pacienteSelecionado['ultimaPAS']['observacao_pas'] ?? '' ?></textarea>

                    <label>Laboterapia / Espiritualidade</label>
                    <textarea name="laboterapia_espiritualidade"><?= $pacienteSelecionado['ultimaPAS']['laboterapia_espiritualidade'] ?? '' ?></textarea>

                    <label>Evolução / Vínculo Familiar</label>
                    <textarea name="evolucao_vinculo_familiar"><?= $pacienteSelecionado['ultimaPAS']['evolucao_vinculo_familiar'] ?? '' ?></textarea>

                    <button type="submit">Salvar PAS</button>
                </form>
            </section>
        <?php } ?>

    </main>
</div>

<script src="slide-bar/script.js"></script>
</body>
</html>

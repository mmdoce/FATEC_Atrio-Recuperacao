<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Átrio - Plano de Assistência Singular</title>
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
require_once 'includes/conexao.php';

// Inicializa variáveis
$paciente = null;
$ultimaPAS = null;
$historico = [];
$idade = '--';

// Pega o paciente via GET
if (isset($_GET['id_paciente'])) {
    $id = intval($_GET['id_paciente']);

    // Busca paciente
    $res = $connection->query("SELECT * FROM paciente WHERE id_paciente = $id");
    if ($res) {
        $paciente = $res->fetch_assoc();

        // Calcula idade
        if (!empty($paciente['data_nascimento'])) {
            $nasc = new DateTime($paciente['data_nascimento']);
            $hoje = new DateTime();
            $idade = $hoje->diff($nasc)->y;
        }

        // Busca última PAS
        $res_pas = $connection->query("SELECT * FROM pas WHERE id_paciente = $id ORDER BY data_criacao DESC LIMIT 1");
        if ($res_pas) $ultimaPAS = $res_pas->fetch_assoc();

        // Histórico de sessões
        $res_hist = $connection->query("SELECT * FROM pas WHERE id_paciente = $id ORDER BY data_criacao DESC");
        if ($res_hist) {
            while ($row = $res_hist->fetch_assoc()) {
                $historico[] = $row;
            }
        }
    }
}
?>

<?php
if (isset($_SESSION['msg_sucesso'])) {
    echo "<p class='msg-sucesso'>{$_SESSION['msg_sucesso']}</p>";
    unset($_SESSION['msg_sucesso']);
}

if (isset($_SESSION['msg_erro'])) {
    echo "<p class='msg-erro'>{$_SESSION['msg_erro']}</p>";
    unset($_SESSION['msg_erro']);
}
?>


<main class="main">
    <button class="btn-nobg">
        <a href="dashboard.php"><i class="fa-solid fa-chevron-left"></i> Voltar</a>
    </button>

   <div id="content">
    <div class="header">
        <h2>Plano de Assistência Singular</h2>
    </div>

    <div class="form-card-wrapper">
        <!-- Formulário -->
        <form action="includes/salvar_pas.php" method="post" class="form-pas">
            <input type="hidden" name="id_paciente" value="<?= $paciente['id_paciente'] ?? '' ?>">

            <form-group>
                <label for="queixa" class="form-label">Queixa principal</label>
                <textarea name="queixa" id="queixa" class="form-txt pass"><?= $ultimaPAS['queixa_principal'] ?? '' ?></textarea>

                <label for="desc-sessao" class="form-label">Descrição da sessão</label>
                <textarea name="desc-sessao" id="desc-sessao" class="form-txt pass"><?= $ultimaPAS['descricao_sessao'] ?? '' ?></textarea>

                <label for="analise-sessao" class="form-label">Análise da sessão</label>
                <textarea name="analise-sessao" id="analise-sessao" class="form-txt pass"><?= $ultimaPAS['analise_sessao'] ?? '' ?></textarea>

                <label for="obs" class="form-label">Observação</label>
                <textarea name="obs" id="obs" class="form-txt pass"><?= $ultimaPAS['observacao_pas'] ?? '' ?></textarea>
            </form-group>

            <form-group>
                <h2>Laboterapia</h2>
                <label for="espi" class="form-label">Espiritualidade</label>
                <textarea name="espi" id="espi" class="form-txt pass"><?= $ultimaPAS['laboterapia_espiritualidade'] ?? '' ?></textarea>

                <label for="evo-vin" class="form-label">Evolução de vínculo familiar</label>
                <textarea name="evo-vin" id="evo-vin" class="form-txt pass"><?= $ultimaPAS['evolucao_vinculo_familiar'] ?? '' ?></textarea>
            </form-group>

            <button class="btn-geral" type="submit">Salvar <i class="fa-solid fa-ellipsis"></i></button>
            <button class="btn-alt" type="button" onclick="window.print()">Imprimir</button>
        </form>

        <!-- Card do paciente -->
        <aside class="profile">
            <div class="profile-info">
                <div>
                    <h3><?= $paciente['nome'] ?? 'Paciente não selecionado' ?></h3>
                    <p><strong>Idade: <?= $idade ?? '--' ?></strong></p>
                </div>
                <img src="<?= $paciente['foto'] ?? 'https://i.pinimg.com/736x/a4/d8/28/a4d8289d97adac030bab9a4e7101bb5b.jpg' ?>" 
                     alt="Foto do paciente" class="pac-icon quad">
            </div>

            <div class="hist-sessao">
                <h2 class="header-hist">Histórico de sessões</h2>
                <?php if (!empty($historico)) {
                    foreach ($historico as $sessao) { ?>
                        <div class="sessao">
                            <h3>Sessão <?= $sessao['id_pas'] ?></h3>
                            <p><?= date('d/m/Y', strtotime($sessao['data_criacao'])) ?></p>
                        </div>
                <?php } } else { ?>
                    <p>Nenhuma sessão registrada.</p>
                <?php } ?>
            </div>
        </aside>
    </div>
</div>


</main>

<script src="slide-bar/script.js"></script>
</body>
</html>

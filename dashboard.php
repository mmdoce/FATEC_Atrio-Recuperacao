<!-- Criei essa página com o intuito de ser a área do monitor. Provavelmente irá substituir a pág admin.html
 ! Feito com base no design do Figma. -->

 <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Átrio - Administração e Formulários</title>
    <link rel="stylesheet" href="assets/css/style_interno.css">
    <link rel="stylesheet" href="slide-bar/ESTILO.css">

    <!-- Fontes personalizadas -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Ícones -->
    <script src="https://kit.fontawesome.com/6105ef985f.js" crossorigin="anonymous"></script>
</head>
<body id="app">
        <form action="includes/dashboard.php" method="post"></form>

       
     <?php include 'slide-bar/sidebar.html'; ?>
     
<div class="page-content">

    <main class="main">
        <div class="header">
            <h2>Pacientes do dia</h2>
            <form action="includes/lista.php" method="get">
                <input type="text" class="input busca">
                <button id="btn-busca" class=" button fa-solid fa-magnifying-glass"></button> <!-- TODO: Adicionar o bendito ícone + funcionalidade do botão -->
            </form>
        </div>
        <nav id="filtro"> <!-- TODO: Add funcionalidade dos filtros -->
            <p>Filtrar:</p>
            <input type="date" placeholder="Chegada" class="input">
            <input type="number" placeholder="Idade" class="input">
            <select name="ordenacao" id="ordem" class="input">
                <option value="">Ordem alfabética</option> <!-- TODO: Adicionar valor -->
                <option value="">Mais recente</option>
                <option value="">Mais antigo</option>
            </select>
        </nav>

        <?php 
$pacientes = include 'includes/dashboard.php';
?>

<section class="lista-pac" id="pac-dia">

<?php if (empty($pacientes)) { ?>
    <p>Nenhum paciente hoje 😴</p>
<?php } else { ?>

    <?php foreach ($pacientes as $p) { ?>
    <a href="aluno-exemplo.html">
        <div class="card paciente">
            <img 
                src="<?= $p['foto'] ?>" 
                alt="Foto do paciente"
                class="pac-icon">
            <div>
                <h3><?= $p['nome'] ?></h3>
                <p><?= $p['descricao'] ?></p>
                <p><strong>Idade: <?= $p['idade'] ?></strong></p>
                <h4>Pendente : <?= $p['status_relatorio'] ?></h4>
            </div>
        </div>
    </a>
    <?php } ?>

<?php } ?>

</section>

       
    </main>
    <section id="calend">
            <div>
                <h3>Nome Psicologo</h3>
                <p>RA: 515.870.232.187</p>
            </div>
            <!-- TODO: Adicionar um calendário e fazer dele funcional. -->
            <div id="tasks">
                <h3><i class="fa-solid fa-list"></i> Pendências</h3>
                <form action="">
                    <input type="checkbox" name="" id="pend1">
                    <label for="pend1">Exemplo de afazer</label> <br>
                    <input type="checkbox" name="" id="pend2">
                    <label for="pend2">Exemplo de afazer</label> <br>
                    <input type="checkbox" name="" id="pend3">
                    <label for="pend3">Exemplo de afazer</label> <br>
                    <button disabled="disabled" class="button" id="btn-add-task"><i class="fa-solid fa-plus"></i></button>
                </form>
            </div>
        </section>

</div>

     <script src="slide-bar/script.js"></script>

</body>
</html>
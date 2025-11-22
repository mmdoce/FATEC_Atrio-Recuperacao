<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Átrio - Cadastro de Aluno</title>
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

      <?php include 'slide-bar/sidebar.html'; ?>

    <!-- TODO: funcionalidade (e um campo) de adicionar foto -->
    <main class="main">
        <button class="btn-nobg"><a href="lista-alunos.php"><i class="fa-solid fa-chevron-left"></i> Voltar</a></button>
        <div id="content">

        <?php if (isset($_GET['erro']) && $_GET['erro'] == 'cpf'): ?>
    <script>
        alert("❌ Não foi possível cadastrar: este CPF já está registrado.");
    </script>
<?php endif; ?>


        <div class="header">
            <h2>Cadastro de paciente</h2>
        </div>
        


<form action="includes/cadastro-aluno.php" method="post">


    <label for="nome" class="form-label">Nome Completo</label>
    <input type="text" name="nome" class="form-entry">

    <label class="form-label">Data de nascimento</label>
    <input type="date" name="data_nascimento" class="form-entry">

    <label class="form-label">CPF</label>
    <input type="text" name="cpf" class="form-entry">

    <label class="form-label">Endereço</label>
    <input type="text" name="endereco" class="form-entry">

    <label class="form-label">Data de entrada na casa</label>
    <input type="date" name="data_entrada" class="form-entry">

    <label class="form-label">Possui acompanhamento psiquiátrico?</label>
    <input type="radio" name="historico_psiquiatrico" value="sim"> Sim
    <input type="radio" name="historico_psiquiatrico" value="nao"> Não

    <label class="form-label">Toma medicamento?</label>
    <input type="radio" name="toma_medicamento" value="sim"> Sim
    <input type="radio" name="toma_medicamento" value="nao"> Não

    <label class="form-label">Especifique</label>
    <input type="text" name="medicamento_especificar" class="form-entry">

    <label class="form-label">Quais entorpecentes usava?</label>
    <input type="text" name="entorpecentes_usados" class="form-entry">

    <label class="form-label">Nome da mãe</label>
    <input type="text" name="nome_mae" class="form-entry">

    <label class="form-label">Nome do pai</label>
    <input type="text" name="nome_pai" class="form-entry">

    <label class="form-label">Observação profissional</label>
    <textarea name="observacao_profissional" class="form-txt"></textarea>

    <button class="btn-geral" type="submit" >Cadastrar</button>

</form>

    
        </div>
    </main>

    <script src="slide-bar/script.js"></script>

</body>
</html>
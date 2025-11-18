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
        <button class="btn-nobg"><a href="lista-alunos.html"><i class="fa-solid fa-chevron-left"></i> Voltar</a></button>
        <div id="content">
        <div class="header">
            <h2>Cadastro de paciente</h2>
        </div>
          <form action="includes/aluno-exemplo.php" method="post"></form>
          <form action="includes/atualiza-aluno.php" method="post"></form>
          <form action="includes/cadastro-aluno.php" method="post"></form>
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" class="form-entry">
            <label for="data-nasc" class="form-label">Data de nascimento</label>
            <input type="date" class="form-entry">
            <label for="CPF" class="form-label">CPF</label>
            <input type="text" class="form-entry">
            <label for="enredeco" class="form-label">Endereço</label>
            <input type="text" class="form-entry">
            <label for="data-entrada" class="form-label">Data de entrada na casa</label>
            <input type="date" class="form-entry">
            <label for="acomp-psi" class="form-label">Possui histórico de acompanhamento psiquiátrico?</label>
            <input type="radio" name="acomp-psi" class="form-radio">
            <label for="">Sim</label>
            <input type="radio" name="acomp-psi" class="form-radio">
            <label for="">Não</label>
            <label for="medicamento" class="form-label">Toma medicamento?</label>
            <input type="radio" name="medicamento" class="form-radio">
            <label for="">Sim</label>
            <input type="radio" name="medicamento" class="form-radio">
            <label for="">Não</label>
            <label for="medicamento-qual" class="form-label">Especifique</label>
            <input type="text" class="form-entry">
            <label for="entorpecente" class="form-label">Quais entorpecentes usava?</label>
            <input type="text" class="form-entry">
            <label for="mae" class="form-label">Nome da mãe</label>
            <input type="text" class="form-entry">
            <label for="pai" class="form-label">Nome do pai</label>
            <input type="text" class="form-entry">
            <label for="obs" class="form-label">Observação profissional</label>
            <textarea name="obs" id="obs" class="form-txt"></textarea>
            <button class="btn-geral">Cadastrar</button>
        </form>
    
        </div>
    </main>

    <script src="slide-bar/script.js"></script>

</body>
</html>
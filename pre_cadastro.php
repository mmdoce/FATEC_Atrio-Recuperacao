<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   // Coleta os dados seguramente
    $nome_paciente = filter_input(INPUT_POST, 'nome_paciente', FILTER_SANITIZE_STRING);
    $contato_resp = filter_input(INPUT_POST, 'contato_resp', FILTER_SANITIZE_STRING);
    $email_resp = filter_input(INPUT_POST, 'email_resp', FILTER_SANITIZE_EMAIL);
    
    // Salva o momento
    $data_solicitacao = date('Y-m-d H:i:s'); 

    // Define o CSV e cabeçalho
    $arquivo = 'solicitacoes_internacao.csv';
    $cabecalho = "Nome do Paciente,Contato,Email do Responsável,Data da Solicitação\n"; 

    if (!file_exists($arquivo)) {
        file_put_contents($arquivo, $cabecalho, LOCK_EX);
    }
    
    //  nova linha de dados 
    $linha = "$nome_paciente,$contato_resp,$email_resp,$data_solicitacao\n";
    
    //  salva a nova linha 
    if (file_put_contents($arquivo, $linha, FILE_APPEND | LOCK_EX)) {
        
        // Tela de conclusão
        echo "<html><head><title>Sucesso!</title></head><body>";
        echo "<h1>✅ Solicitação de Internação Enviada com Sucesso!</h1>";
        echo "<p>Prezado(a) **$nome_paciente** (ou responsável),</p>";
        echo "<p>Sua solicitação foi registrada em **$data_solicitacao**.</p>";
        echo "<p>Entraremos em contato o mais breve possível no número: <b>$contato_resp</b>.</p>";
        echo "<br>";
        echo "<p><a href='index.html'>&larr; Clique aqui para voltar para o Site</a></p>";
        echo "</body></html>";
        
    } else {
        

        echo "<h1>ERRO: Não foi possível processar sua solicitação.</h1>";
        echo "<p>Por favor, tente novamente ou entre em contato diretamente por telefone.</p>";
        
    }
} else {
    // Se acessar a página sem o formulário, volta pra home
    header("Location: index.html");
}

?>
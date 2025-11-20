<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: acessos.php");
    exit;
}

// Só ADMIN pode acessar páginas críticas
if ($_SESSION['nivel'] !== 'admin') {
    echo "<script>alert('Você não tem permissão para acessar esta página.'); 
          window.location.href='index.php';</script>";
    exit;
}
?> 

<?php
$host = "localhost:3306";      // Host local do XAMPP
$username = "root";       // Usuário padrão do XAMPP
$password = "";           // Senha padrão (vazia)
$database = "recrutaverde"; // Nome do seu banco

// Cria conexão
$conn = new mysqli($host, $username, $password, $database);

// Verifica se deu erro
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>

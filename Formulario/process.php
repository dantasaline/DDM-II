<?php
// Configurações do banco de dados
$servername = "localhost"; // ou o endereço do seu servidor MySQL
$username = "root"; // seu usuário do MySQL
$password = ""; // sua senha do MySQL
$dbname = "formulario"; // nome do banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $fruit = htmlspecialchars($_POST['fruit']);

    // Preparar e vincular
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, fruta) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $fruit);

    // Executar a consulta
    if ($stmt->execute()) {
        echo "<h1>Dados Recebidos</h1>";
        echo "<p><strong>Nome:</strong> $name</p>";
        echo "<p><strong>E-mail:</strong> $email</p>";
        echo "<p><strong>Fruta Favorita:</strong> $fruit</p>";
        echo "<p>Dados salvos com sucesso!</p>";
    } else {
        echo "Erro: " . $stmt->error;
    }

    // Fechar a declaração e a conexão
    $stmt->close();
} else {
    echo "Método de requisição inválido.";
}

$conn->close();
?>
<?php
// Conectar ao banco de dados (substitua com suas credenciais)
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Função para adicionar uma transação ao banco de dados
function addTransaction($type, $amount) {
    global $conn;

    $sql = "INSERT INTO transactions (type, amount) VALUES ('$type', $amount)";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Rota para registrar um depósito
if (isset($_POST['deposit'])) {
    $amount = $_POST['amount'];
    if (addTransaction('deposit', $amount)) {
        echo "Depósito de $amount registrado com sucesso.";
    } else {
        echo "Erro ao registrar o depósito.";
    }
}

// Rota para registrar um levantamento
if (isset($_POST['withdraw'])) {
    $amount = $_POST['amount'];
    if (addTransaction('withdraw', $amount)) {
        echo "Levantamento de $amount registrado com sucesso.";
    } else {
        echo "Erro ao registrar o levantamento.";
    }
}

// Rota para registrar um pagamento de produto
if (isset($_POST['payment'])) {
    $amount = $_POST['amount'];
    if (addTransaction('payment', $amount)) {
        echo "Pagamento de produto no valor de $amount registrado com sucesso.";
    } else {
        echo "Erro ao registrar o pagamento de produto.";
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Política de Transações</title>
</head>
<body>
    <h1>Política de Transações</h1>

    <h2>Registrar Depósito</h2>
    <form method="post">
        <input type="hidden" name="deposit" value="1">
        <label for="amount">Valor:</label>
        <input type="text" id="amount" name="amount" required>
        <input type="submit" value="Depositar">
    </form>

    <h2>Registrar Levantamento</h2>
    <form method="post">
        <input type="hidden" name="withdraw" value="1">
        <label for="amount">Valor:</label>
        <input type="text" id="amount" name="amount" required>
        <input type="submit" value="Levantar">
    </form>

    <h2>Registrar Pagamento de Produto</h2>
    <form method="post">
        <input type="hidden" name="payment" value="1">
        <label for="amount">Valor:</label>
        <input type="text" id="amount" name="amount" required>
        <input type="submit" value="Pagar Produto">
    </form>
</body>
</html>
Este código PHP cria uma página da web com três formulários diferentes para registrar depósitos, levantamentos e pagamentos de produtos. Cada um deles envia uma solicitação POST para a mesma página, que lida com as transações e as insere no banco de dados.

Lembre-se de substituir as informações de conexão com o banco de dados (como $servername, $username, $password e $dbname) com as suas configurações específicas.

Além disso, este é um exemplo simples que não inclui validações, autenticação de usuários ou medidas de segurança adicionais. Em uma aplicação real, você deve considerar esses aspectos para garantir a segurança e a integridade das transações.






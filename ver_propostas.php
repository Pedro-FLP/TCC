<?php
session_start();

// Verifica se o cuidador está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$id_cuidador = $_SESSION['user_id'];

// Conexão com o banco de dados
$con = new mysqli("localhost", "root", "", "tcc");
if ($con->connect_error) {
    die("Falha na conexão: " . $con->connect_error);
}

// Escapar ID do cuidador
$id_cuidador = $con->real_escape_string($id_cuidador);

// Consulta propostas do cuidador
$sql = "
    SELECT preco, contato, periodo, data_envio 
    FROM propostas_preco 
    WHERE id_cuidador = '$id_cuidador' 
    ORDER BY data_envio DESC
";
$result = $con->query($sql);
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"/>
    <title>Minhas Propostas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 50px;
            background: url('fundo.png') no-repeat center center/cover;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f4f4f4;
        }
        .voltar {
            text-decoration: none;
            margin-top: 30px;
            padding: 10px 30px;
            font-size: 1.2em;
            background-color: rgba(23, 40, 199, 0.59);
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 30px;
            transition: background-color 0.3s ease;
            display: inline-block;
        }
        .voltar:hover {
            background-color: #3771aa;
        }
        p {
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Minhas Propostas</h1>

<?php if ($result && $result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Preço Proposto (R$)</th>
            <th>Contato</th>
            <th>Período</th>
            <th>Data de Envio</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['preco']) ?></td>
                <td><?= htmlspecialchars($row['contato']) ?></td>
                <td><?= htmlspecialchars($row['periodo']) ?></td>
                <td><?= htmlspecialchars($row['data_envio']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>Nenhuma proposta encontrada para você.</p>
<?php endif; ?>

<?php $con->close(); ?>

<p>
    <a href="pesquisa.php" class="voltar">Voltar</a>
</p>

</body>
</html>

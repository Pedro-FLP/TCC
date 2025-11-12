<?php
session_start();

// Verifica se usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Conexão com banco de dados
$con = new mysqli("localhost", "root", "", "tcc");
if ($con->connect_error) {
    die("Falha na conexão: " . $con->connect_error);
}

// Captura pesquisa
$pesquisa = "";
if (isset($_GET['pesquisa'])) {
    $pesquisa = $con->real_escape_string($_GET['pesquisa']);
}

// Inserção de proposta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cuidador'], $_POST['preco_proposta'], $_POST['contato'], $_POST['periodo'])) {
    $id_cuidador = $con->real_escape_string($_POST['id_cuidador']);
    $preco_proposta = $con->real_escape_string($_POST['preco_proposta']);
    $contato = $con->real_escape_string($_POST['contato']);
    $periodo = $con->real_escape_string($_POST['periodo']);

    $sql_insert = "INSERT INTO propostas_preco (id_cuidador, preco, contato, periodo, data_envio) 
                   VALUES ('$id_cuidador', '$preco_proposta', '$contato', '$periodo', NOW())";
    if ($con->query($sql_insert) === TRUE) {
        echo "<p style='color:green; text-align:center;'>Proposta enviada com sucesso!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Erro ao enviar proposta: " . $con->error . "</p>";
    }
}

// Consulta cuidadores
$sql = "SELECT id, nome, telefone, descricao, foto_perfil FROM cuidadores WHERE nome LIKE '%$pesquisa%'";
$result = $con->query($sql);
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Cuidadores Disponíveis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('fundo.png') no-repeat center/cover;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form#buscaForm {
            max-width: 600px;
            margin: 0 auto 20px auto;
            text-align: center;
        }
        input[type="text"], input[type="number"], select {
            width: 70%;
            padding: 12px;
            font-size: 15px;
            border: 2px solid #7278c4ff;
            border-radius: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        button {
            text-decoration: none;
            margin-top: 10px;
            padding: 12px 25px;
            font-size: 1em;
            background-color: rgba(23, 40, 199, 0.59);
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 10px;
        }
        button:hover {
            background-color: #3771aa;
        }
        .btn-negociar {
            background-color: #28a745;
        }
        .btn-negociar:hover {
            background-color: #1e7e34;
        }

        ul {
            list-style: none;
            padding-left: 0;
            max-width: 800px;
            margin: 0 auto;
        }
        li.card-cuidador {
            display: flex;
            align-items: flex-start;
            background: white;
            margin-bottom: 15px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
            max-width: 800px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        .perfil {
            flex: 0 0 120px;
            text-align: center;
        }
        .foto-perfil {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .info {
            flex: 1;
            margin-left: 20px;
        }
        .nome {
            font-weight: bold;
            font-size: 20px;
            color: #007bff;
            margin-bottom: 5px;
        }
        .detalhes {
            color: #555;
            margin-bottom: 10px;
        }
        .descricao {
            margin-bottom: 15px;
            color: #333;
            font-size: 15px;
            line-height: 1.4;
            white-space: pre-wrap;
            word-break: break-word;
        }
        .form-negociar {
            margin-top: 10px;
            display: none;
        }
    </style>
    <script>
        function toggleForm(id) {
            const form = document.getElementById('form-negociar-' + id);
            form.style.display = (form.style.display === 'block') ? 'none' : 'block';
        }
    </script>
</head>
<body>

<h1>Cuidadores Disponíveis</h1>

<form id="buscaForm" method="get" action="">
    <input type="text" name="pesquisa" placeholder="Pesquisar por nome" value="<?php echo htmlspecialchars($pesquisa); ?>" />
    <button type="submit">Buscar</button>
</form>

<form id="buscaForm" method="get" action="ver_propostas.php">
    <button type="submit">Propostas</button>
</form>

<ul>
<?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <li class="card-cuidador">
            <div class="perfil">
                <?php if (!empty($row['foto_perfil'])): ?>
                    <img src="<?php echo htmlspecialchars($row['foto_perfil']); ?>" alt="Foto de perfil" class="foto-perfil" />
                <?php else: ?>
                    <img src="caminho/para/imagem_padrao.jpg" alt="Foto padrão" class="foto-perfil" />
                <?php endif; ?>
            </div>
            <div class="info">
                <div class="nome"><?php echo htmlspecialchars($row['nome']); ?></div>
                <div class="detalhes">Telefone: <?php echo htmlspecialchars($row['telefone']); ?></div>
                <div class="descricao"><b>Descrição:</b> <?php echo nl2br(htmlspecialchars($row['descricao'])); ?></div>
                
                <button class="btn-negociar" type="button" onclick="toggleForm(<?php echo $row['id']; ?>)">Negociar Preço</button>
                
                <!-- 🔹 Formulário de negociação com seleção de período -->
                <form class="form-negociar" id="form-negociar-<?php echo $row['id']; ?>" method="post" action="">
                    <input type="hidden" name="id_cuidador" value="<?php echo $row['id']; ?>" />
                    <input type="number" name="preco_proposta" min="0" step="0.01" placeholder="Digite seu preço (R$)" required />
                    <input type="text" name="contato" placeholder="Seu telefone ou contato" required />
                    
                    <!-- 🔹 Campo novo: seleção de período -->
                    <select name="periodo" required>
                        <option value="">Selecione o período</option>
                        <option value="Manhã">Manhã</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Noite">Noite</option>
                        <option value="Dia">Dia</option>
                        <option value="Semana">Semana</option>
                    </select>

                    <button type="submit">Enviar Proposta</button>
                </form>
            </div>
        </li>
        <?php
    }
} else {
    echo "<li>Nenhum cuidador encontrado.</li>";
}
$con->close();
?>
</ul>

</body>
</html>

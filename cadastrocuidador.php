<?php
session_start();

$con = new mysqli("localhost", "root", "", "tcc");
if ($con->connect_error) {
    die("Falha na conexão: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'cadastro') {
            $nome = $con->real_escape_string($_POST['nome']);
            $email = $con->real_escape_string($_POST['email']);
            $cpf = $con->real_escape_string($_POST['cpf']);
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $telefone = $con->real_escape_string($_POST['telefone']);
            $descricao = $con->real_escape_string($_POST['descricao']);

            $foto_perfil = null;
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $pasta = "uploads/";
                if (!is_dir($pasta)) {
                    mkdir($pasta, 0755, true);
                }
                $nomeArquivo = time() . '_' . basename($_FILES['foto']['name']);
                $caminhoCompleto = $pasta . $nomeArquivo;

                $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
                $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
                if (in_array($extensao, $extensoes_permitidas)) {
                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoCompleto)) {
                        $foto_perfil = $caminhoCompleto; 
                    } else {
                        echo "Erro ao enviar a foto de perfil.";
                        exit();
                    }
                } else {
                    echo "Tipo de arquivo da foto não permitido.";
                    exit();
                }
            }

            $sql = "INSERT INTO cuidadores (nome, email, cpf, senha, telefone, descricao, foto_perfil)
                    VALUES ('$nome', '$email', '$cpf', '$senha', '$telefone', '$descricao', " . 
                    ($foto_perfil ? "'$foto_perfil'" : "NULL") . ")";

            if ($con->query($sql) === TRUE) {
                header("Location: loginCP.php?msg=sucesso");
                exit();
            } else {
                echo "Erro no cadastro: " . $con->error;
            }

        } elseif ($_POST['action'] == 'login') {
            $cpf = $con->real_escape_string($_POST['cpf']);
            $senha = $_POST['senha'];

            $sql = "SELECT * FROM cuidadores WHERE cpf = '$cpf'";
            $result = $con->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($senha, $row['senha'])) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_nome'] = $row['nome'];
                    $_SESSION['user_foto'] = $row['foto_perfil']; 
                    header('Location: pesquisa.php');
                    exit();
                } else {
                    echo "Senha incorreta.";
                }
            } else {
                echo "Usuário não encontrado.";
            }
        }
    }
}

$con->close();
?>

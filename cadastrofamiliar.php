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

            $sql = "INSERT INTO contratantes (nome, email, cpf, senha, telefone)
                    VALUES ('$nome', '$email', '$cpf', '$senha', '$telefone')";
            if ($con->query($sql) === TRUE) {
                header("Location: loginFM.php?msg=sucesso");
                exit();
            } else {
                echo "Erro no cadastro: " . $con->error;
            }

        } elseif ($_POST['action'] == 'login') {
            $cpf = $con->real_escape_string($_POST['cpf']);
            $senha = $_POST['senha'];

            $sql = "SELECT * FROM contratantes WHERE cpf = '$cpf'";
            $result = $con->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($senha, $row['senha'])) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_nome'] = $row['nome'];
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

<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<title>Capa - LoginCP</title>
<style>
  body, html {
    margin: 0; padding: 0; height: 100%;
    font-family: Arial, sans-serif;
    background: url('fundo.png') no-repeat center center/cover;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .container {
    width: 900px;
    height: 500px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    display: flex;
    overflow: hidden;
  }
  .imagens {
    flex: 1;
    position: relative;
  }
  .imagens img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
    transition: opacity 1s ease-in-out;
    position: absolute;
    top: 0; left: 0;
  }
  .login {
    flex: 1;
    padding: 40px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  h2 {
    margin-bottom: 24px;
    color: #333;
    font-weight: bold;
    text-align: center;
  }
  form {
    display: flex;
    flex-direction: column;
    margin-bottom: 40px;
  }
  input {
    margin-bottom: 15px;
    padding: 12px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
  }
  button {
    text-decoration: none;
    margin-top: 30px;
    padding: 15px 30px;
    font-size: 1.2em;
    background-color: rgba(23, 40, 199, 0.59);
    border: none;
    color: rgb(255, 255, 255);
    cursor: pointer;
    border-radius: 30px;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color: #3771aaff;
  }
</style>
</head>
<body>

<div class="container">
  <div class="imagens">
    <img src="https://plataformasoi.com.br/wp-content/uploads/2022/02/shutterstock_1726021492.png" alt="Cuidador" style="opacity: 1">
    <img src="https://blogfisioterapia.com.br/wp-content/uploads/2020/03/cuidados-paliativos-capa.png" alt="Cuidado ao Idoso" style="opacity: 0">
    <img src="https://pronep.s3.amazonaws.com/wp-content/uploads/2024/05/08104735/cuidados-paliativos-2-1024x535.png" alt="Assistência" style="opacity: 0">
  </div>
  <div class="login">
    <h2>Login</h2>
    <form method="post" action="cadastrocuidador.php">
      <input type="hidden" name="action" value="login" />
      <input type="text" name="cpf" placeholder="CPF" required />
      <input type="password" name="senha" placeholder="Senha" required />
      <button type="submit">Entrar</button>
      </form>
      <form method="post" class="cadastro">
      <button class="botao" type="submit" name="botaoCadastro">Cadastrar-se</button>
      </form>
</div>

<script>
  let imagens = document.querySelectorAll('.imagens img');
  let atual = 0;
  setInterval(() => {
    imagens[atual].style.opacity = 0;
    atual = (atual + 1) % imagens.length;
    imagens[atual].style.opacity = 1;
  }, 5000);
</script>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['botaoCadastro'])) {
        header('Location: cadastroCP.php');
        exit();
    }
}
?>
</body>
</html>